function showMsg(msg, title, focusEle) {
    appendToBody("show_msg", "<div>" + msg + "</div>");
    $("#show_msg div").dialog({
        resizable: false,
        modal: true,
        autoOpen:true,
        title: title || "提示",
        closeText: 'hide',
		close: function(ev, ui) { $(this).remove(); },
        buttons: {
	        "确定": function() {
	            $( this ).dialog( "close" );
			    if(focusEle && focusEle.length > 0) {
				    focusEle.select();
			    }
	        }
	    } 
    });
}

function wait(flag){
    if(flag) {
        $("#wait_img").removeClass("hidden");
    } else {
        $("#wait_img").addClass("hidden");
    }
}
function window_mask(mask){
	$(".window_mask_wait, .loading").remove();
	if(mask){
		$("<div class='window_mask_wait' style='display: block;'></div><div class='loading'></div>").appendTo("body");
	}
}

function appendToDest(dest_id, content, dest){
	if($("#" + dest_id).length == 0){
		$("<div id='" + dest_id + "' class='hidden'></div>").appendTo(dest);
	}
	$("#" + dest_id).html(content);
}

function appendToBody(dest_id, content){
	appendToDest(dest_id, content, document.body);
}

function do_template(params){
	var html = $.ajax({
		url:params.template_url,
		async:false, 
		dataType: 'text/html'
	}).responseText;
	
	if(!html){
		alert("与服务器同步数据发生异常，请联系管理员！");
	}

	do_formSubmit(html, params);
}

function do_formSubmit(html, params){
	if(html.indexOf("{") == 0){
		var error_json = eval("(" + html + ")");
		if(error_json.code == '你还未登录，请先登录'){
			login_form();
		} else {
			showMsg( error_json.code, "操作失败");
		}
		return;
	}
	appendToBody("hidn_content", html);
	
	params.fn && params.fn();
	
	var dialog_option = {
		resizable: true,
		autoOpen: true,
		width: params.width || 640,
		height: params.height || 450,
		modal: true,
		type:"post",
		dataType: "json",
		close: function(ev, ui) { $(this).remove(); },
		buttons: {
			"保存": function() {
				params.onsubmit && params.onsubmit();
				var form = $(this).find("form[name='formEdit']");
				if(form.attr('onsubmit')) {
					if(!validate(form.get(0))){
						return false;
					}
				}
				
				this_ = $(this);
				form.ajaxSubmit({
					type: "post",
					dataType: "json",
					beforeSubmit:function(){
						window_mask(true);
					},
					complete:function (XHR, TS){
						window_mask(false);
						params.oncomplete && params.oncomplete();
					},
					error: function(event,xhr,options,exc){
						window_mask(false);
						showMsg(params.error_text||"发生异常！", "错误" );
					},
					success: function(data) {
						handle_data(params, data, this_);
					}
				})
			}, 
			"取消": function() { 
				$(this).dialog("close");
				$(this).dialog('destroy');
			} 
		}
	}
	
	$("#hidn_content > div").dialog(dialog_option);
}

function do_confirm_submit(params){
	appendToBody("hidn_content", "<div>" + params.confirm_text + "</div>");

	var dialog_option = {
		resizable: true,
		autoOpen: true,
		width: params.width || 240,
		height: params.height || 300,
		modal: true,
		close: function(ev, ui) { $(this).remove(); },
		buttons: {
			"确定": function() {
				do_submit(params, $(this));
			}, 
			"取消": function() {
				$(this).dialog("close");
				$(this).dialog('destroy');
			} 
		}
	}

	$("#hidn_content > div").dialog(dialog_option);
}

function do_submit(params, dialog_form){
	$.ajax({
		url:params.post_url,
		type: "post",
		dataType: "json",
		data:params.post_params?params.post_params : {},
		timeout:20000,
		beforeSend : function(){
			window_mask(true);
		},
		complete:function (XHR, TS){
			window_mask(false);
			params.oncomplete && params.oncomplete();
		},
		error: function(data){
			showMsg(params.error_text||"发生异常！", "错误" );
		},
		success: function(data) {
			handle_data(params, data, dialog_form);
		}
	})
}

function handle_data(params, data, dialog_form){
	if(params.not_show_result && params.not_show_result == 1){
		return;
	}
	if(data.code=='success'){
		dialog_form && dialog_form.dialog("close");
		dialog_form && dialog_form.dialog('destroy');
		showMsg( params.success_text || "操作成功！", "提示");
		params.onsuccess && params.onsuccess();
	} else {
		if(data.code == '你还未登录，请先登录'){
			login_form();
		} else {
			showMsg( data.code, "操作失败");
		}
	}
}

function login_form(){
	var params = {width: 300,height: 230};
	params.template_url = base_url_index + "/view_html/login_view/";
	params.success_text = "登录成功";
	do_template(params);
}
function check_rows(o, field) {
	for (i = 0; i < field.length; i++) {
		field[i].checked = o.checked; 
	}
}

function checkOnSelectRow($row){
	$row.siblings().removeClass('selected').find("input[name='ids']").attr('checked', false);
	if($row.hasClass("slide_next")){
		return;
	}
	$row.siblings().find("table tr").removeClass('selected');
	
	$row.addClass('selected');
	$("input[name='ids']", $row).attr('checked', true);
}


/*
 *图片的操作
*/
function previewImage(fileObj, divPreviewId, w, h){
    var allowExtention=".jpg,.bmp,.gif,.png";//允许上传文件的后缀名document.getElementById("hfAllowPicSuffix").value;
    var extention=fileObj.value.substring(fileObj.value.lastIndexOf(".")+1).toLowerCase();            
    var browserVersion= window.navigator.userAgent.toUpperCase();
    if(allowExtention.indexOf(extention)>-1){ 
        if(fileObj.files){//兼容chrome、火狐7+、360浏览器5.5+等，应该也兼容ie10，HTML5实现预览
            if(window.FileReader){
                var reader = new FileReader(); 
                reader.onload = function(e){
                    document.getElementById(divPreviewId).innerHTML="<img src='"+e.target.result+"' width='"+w+", height='"+h+"'  onload=\"imgAdjust(this, "+w+", "+h+")\">";
                }  
                reader.readAsDataURL(fileObj.files[0]);
            }else if(browserVersion.indexOf("SAFARI")>-1){
                alert("不支持Safari浏览器6.0以下版本的图片预览!");
            }
        }else if (browserVersion.indexOf("MSIE")>-1){//ie、360低版本预览
            if(browserVersion.indexOf("MSIE 6")>-1){//ie6
                document.getElementById(divPreviewId).innerHTML="<img src='"+fileObj.value+"' width='"+w+", height='"+h+"'  onload=\"imgAdjust(this, "+w+", "+h+")\">";
            }else{//ie[7-9]
                fileObj.select();
                if(browserVersion.indexOf("MSIE 9")>-1)
                    fileObj.blur();//不加上document.selection.createRange().text在ie9会拒绝访问
                var newPreview =document.getElementById(divPreviewId+"New");
                if(newPreview==null){
                    newPreview =document.createElement("div");
                    newPreview.setAttribute("id", divPreviewId+"New");
                    newPreview.style.width = "150px";
                    newPreview.style.height = "150px";
                    newPreview.style.border="solid 1px #d2e2e2";
                }
                newPreview.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale',src='" + document.selection.createRange().text + "')";                            
                var tempDivPreview=document.getElementById(divPreviewId);
                tempDivPreview.parentNode.insertBefore(newPreview,tempDivPreview);
                tempDivPreview.style.display="none";                    
            }
        }else if(browserVersion.indexOf("FIREFOX")>-1){//firefox
            var firefoxVersion= parseFloat(browserVersion.toLowerCase().match(/firefox\/([\d.]+)/)[1]);
            if(firefoxVersion<7){//firefox7以下版本
                document.getElementById(divPreviewId).innerHTML="<img src='"+fileObj.files[0].getAsDataURL()+"'width='"+w+", height='"+h+"'  onload=\"imgAdjust(this, "+w+", "+h+")\">";
            }else{//firefox7.0+ 
                document.getElementById(divPreviewId).innerHTML="<img src='"+window.URL.createObjectURL(fileObj.files[0])+"'width='"+w+", height='"+h+"'  onload=\"imgAdjust(this, "+w+", "+h+")\">";
            }
        }else{
            document.getElementById(divPreviewId).innerHTML="<img src='"+fileObj.value+"'>";
        }         
    }else{
        alert("仅支持"+allowExtention+"为后缀名的文件!");
        fileObj.value="";//清空选中文件
        if(browserVersion.indexOf("MSIE")>-1){                        
            fileObj.select();
            document.selection.clear();
        }                
        fileObj.outerHTML=fileObj.outerHTML;
    }
}

$(document).ready(function() { 
	// Navigation menu
	$('ul#navigation').superfish({ 
		delay:       1000,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast',
		autoArrows:  true,
		dropShadows: false
	});
	
	$('ul#navigation li').hover(function(){
		$(this).addClass('sfHover2');
	}, function(){
		$(this).removeClass('sfHover2');
	});

	// Accordion
	$("#accordion, #accordion2").accordion({ header: "h3" });

	// 高级搜索窗口弹出触发事件
	$('#advance_search').click(function(){
		$('#search_block').dialog('open');
		return false;
	});
	// 高级搜索窗			
	$('#search_block').dialog({
		autoOpen: false,
		width: 600,
		bgiframe: false,
		modal: false,
		buttons: {
			"搜索": function() { 
				$(this).dialog("close"); 
			}, 
			"取消": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	//跟踪回访窗口弹出触发事件
	$('#track_visit').click(function(){
		$('#track_visit_block').dialog('open');
		return false;
	});
	//跟踪回访窗			
	$('#track_visit_block').dialog({
		autoOpen: false,
		width: 860,
		bgiframe: false,
		modal: false,
		buttons: {
			"保存": function() { 
				$(this).dialog("close"); 
			}, 
			"取消": function() { 
				$(this).dialog("close"); 
			} 
		}
	});

	
	// 查看民情窗口弹出触发事件
	$('#view_exception').click(function(){
		$('#view_exception_block').dialog('open');
		return false;
	});
	// 查看民情窗			
	$('#view_exception_block').dialog({
		autoOpen: false,
		width: 860,
		bgiframe: false,
		modal: false,
		buttons: {
			"处理异常": function() { 
				$(this).dialog("close"); 
				$('#Handling_exception_block_1').dialog("open"); 
			}, 
			"多次处理未果，挂起": function() { 
				$(this).dialog("close"); 
			}, 
			"取消": function() { 
				$(this).dialog("close"); 
			}
		}
	});
	
	
	// 处理异常民情窗			
	$('#Handling_exception_block_1').dialog({
		autoOpen: false,
		width: 860,
		bgiframe: false,
		modal: false,
		buttons: {
			"下一步": function() { 
				$(this).dialog("close");
				$('#Handling_exception_block_2').dialog("open"); 
			}, 
			"上一步": function() { 
				$(this).dialog("close"); 
				$('#view_exception_block').dialog("open"); 
			} 
		}
	});
	
	$('#Handling_exception_block_2').dialog({
		autoOpen: false,
		width: 860,
		bgiframe: false,
		modal: false,
		buttons: {
			"保存": function() { 
				$(this).dialog("close");
			}, 
			"上一步": function() { 
				$(this).dialog("close");
				$('#Handling_exception_block_1').dialog("open"); 
			} 
		}
	});

	// 弹出新增信息窗口
	$('#add_info').click(function(){
		$('#add_info_block').dialog('open');
		return false;
	});
	// 新增信息窗口			
	$('#add_info_block').dialog({
		autoOpen: false,
		width: 860,
		bgiframe: false,
		modal: false,
		buttons: {
			"保存": function() { 
				$(this).dialog("close"); 
			}, 
			"取消": function() { 
				$(this).dialog("close"); 
			} 
		}
	});
	
	//*****************************系统设置开始************************************//
	// Login Dialog Link
	$('#login_dialog').click(function(){
		$('#login').dialog('open');
		return false;
	});
	

	// Login Dialog			
	$('#login').dialog({
		autoOpen: false,
		width: 300,
		height: 230,
		bgiframe: true,
		modal: true,
		buttons: {
			"Login": function() { 
				$(this).dialog("close"); 
			}, 
			"Close": function() { 
				$(this).dialog("close"); 
			} 
		}
	});

	// Dialog auto open			
	$('#welcome').dialog({
		autoOpen: true,
		width: 470,
		height: 180,
		bgiframe: true,
		modal: true,
		buttons: {
			"View Admintasia V1.0": function() { 
				$(this).dialog("close"); 
			}			
		}
	});

	// Dialog auto open			
	$('#welcome_login').dialog({
		autoOpen: true,
		width: 370,
		height: 430,
		bgiframe: true,
		modal: true,
		buttons: {
			"Proceed to demo !": function() {
				window.location = "index.php";
			}
		}
	});

	// Datepicker
	$('#datepicker').datepicker({
		inline: true
	});
	
	//Hover states on the static widgets
	$('#dialog_link, ul#icons li').hover(
		function() { $(this).addClass('ui-state-hover'); }, 
		function() { $(this).removeClass('ui-state-hover'); }
	);
	
	//Sortable

	$(".column").sortable({
		connectWith: '.column'
	});

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header").addClass("ui-widget-header")
			.prepend('<span class="ui-icon ui-icon-circle-arrow-s"></span>')
			.click(function() {
		$(this).toggleClass("ui-icon-circle-arrow-n");
		$(this).parents(".portlet:first").find(".portlet-content").slideToggle();
	});

	$(".column").disableSelection();
});

/* Theme changer - set cookie */
$(function() {
	/* Tooltip */
	$('.tooltip').tooltip({
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - ",
		fade: 250
	});
   
	$("link[title='style']").attr("href","css/ui/styles/default/ui.css");
    $('a.set_theme').click(function() {
       	var theme_name = $(this).attr("id");
		$("link[title='style']").attr("href","css/ui/styles/" + theme_name + "/ui.css");
		$.cookie('theme', theme_name );
		$('a.set_theme').css("fontWeight","normal");
		$(this).css("fontWeight","bold");
    });
	
	var theme = $.cookie('theme');
    
	if (theme == 'default') {
        $("link[title='style']").attr("href","css/ui/styles/default/ui.css");
    };
    
	if (theme == 'light_blue') {
        $("link[title='style']").attr("href","css/ui/styles/light_blue/ui.css");
    };


/* Layout option - Change layout from fluid to fixed with set cookie */
   
   $("#fluid_layout a").click (function(){
		$("#fluid_layout").hide();
		$("#fixed_layout").show();
		$("#page-wrapper").removeClass('fixed');
		$.cookie('layout', 'fluid' );
   });

   $("#fixed_layout a").click (function(){
		$("#fixed_layout").hide();
		$("#fluid_layout").show();
		$("#page-wrapper").addClass('fixed');
		$.cookie('layout', 'fixed' );
   });

    var layout = $.cookie('layout');
    
	if (layout == 'fixed') {
		$("#fixed_layout").hide();
		$("#fluid_layout").show();
        $("#page-wrapper").addClass('fixed');
    };

	if (layout == 'fluid') {
		$("#fixed_layout").show();
		$("#fluid_layout").hide();
        $("#page-wrapper").addClass('fluid');
    };

});

function calaMainWrapperWidth(){
	var screenWidth = document.body.clientWidth ;
	var siderWidth = document.getElementById("sidebar").clientWidth;
	var v = screenWidth - siderWidth - 2;
	document.getElementById("main-wrapper").style.width= v + "px";
}


function get_selected_id(checked_ids){
	var ref = "";
	checked_ids.each(function(){
	    if(ref.length > 0){
	    	ref += ",";
	    }
	    ref += $(this).val();
	});
	return ref;
}

function refresh_time(){
	var now = new Date();
	var content = "现在是"+now.getFullYear() + "年" + (now.getMonth()+1) + "月" + now.getDate() + "日"
		+ now.getHours() + "时" + now.getMinutes() + "分" +now.getSeconds()+"秒";
    
    //替换div内容 
    document.getElementById('showtime').innerHTML = content;

    //等待一秒钟后调用time方法，由于settimeout在time方法内，所以可以无限调用
   	setTimeout(refresh_time,1000);
}
