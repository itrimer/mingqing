function InitAjax() {
	var ajax = false;
	try {
		ajax = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			ajax = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			ajax = false;
		}
	}
	if (!ajax && typeof XMLHttpRequest != 'undefined') {
		ajax = new XMLHttpRequest();
	}
	return ajax;
}
function isEmail(v) {
	return /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(v);
}

function getElementsByClassName(outbox, className, tagName) {
	var children = outbox.getElementsByTagName(tagName || '*'); // 获取页面所有元素
	var elements = new Array(); // 定义一个数组，用于存储所得到的元素
	// 获取元素的class为className的所有元素
	for ( var i = 0; i < children.length; i++) {
		var child = children[i];
		var classNames = child.className.split(' ');
		for ( var j = 0; j < classNames.length; j++) {
			if (classNames[j] == className) {
				elements.push(child);// 如果class存在，则存入elements
				break;
			}
		}
	}
	return elements;
}

function getElementByName(outbox, eName) {
	var children = outbox.childNodes; // 获取页面所有元素
	var elements = new Array(); // 定义一个数组，用于存储所得到的元素
	for ( var i = 0; i < children.length; i++) {
		var child = children[i];
		alert(child.name + "==" + (child.name == eName));
		if (child.name && (child.name == eName)) {
			elements.push(child);// 如果class存在，则存入elements
		}
	}
	return elements;
}

function validate(form, isEng) {
	var m1 = ["不能为空","必须为数字","不是正确的邮箱地址","值不能大于","值不能小于","长度不能大于","长度不能小于","不相等"];
	if(isEng && isEng == 1){
		m1 = [" can't be empty"," must be number"," is not a valid email"," can't bigger then "," can't smaller then "," length can't bigger then "," length can't smaller then ", " not equal"];
	}
	var msg = [];
	var os = getElementsByClassName(form, "required", "input");
	for ( var i = 0; i < os.length; i++) {
		if (!os[i].value) {
			msg.push("【" + os[i].title + "】"+m1[0]);
		}
	}
	var os = getElementsByClassName(form, "required", "textarea");
	for ( var i = 0; i < os.length; i++) {
		if (!os[i].value) {
			msg.push("【" + os[i].title + "】"+m1[0]);
		}
	}
	var os = getElementsByClassName(form, "required", "select");
	for ( var i = 0; i < os.length; i++) {
		if (!os[i].value) {
			msg.push("【" + os[i].title + "】"+m1[0]);
		}
	}
	var os = getElementsByClassName(form, "number", "input");
	for ( var i = 0; i < os.length; i++) {
		if (!os[i].value || isNaN(os[i].value)) {
			msg.push("【" + os[i].title + "】"+m1[1]);
		}
	}
	var os = getElementsByClassName(form, "email", "input");
	for ( var i = 0; i < os.length; i++) {
		if (!isEmail(os[i].value)) {
			msg.push("【" + os[i].title + "】"+m1[2]);
		}
	}
	var os = getElementsByClassName(form, "maxValue", "input");
	for ( var i = 0; i < os.length; i++) {
		var o = os[i];
		var mv = o.getAttribute("maxValue");
		var v = o.value;
		if (mv && (!v || !/^[0-9]+$/.test(v) || parseInt(v, 10) > mv)) {
			msg.push("【" + o.title + "】"+ m1[3] + mv);
		}
	}
	var os = getElementsByClassName(form, "minValue", "input");
	for ( var i = 0; i < os.length; i++) {
		var o = os[i];
		var mv = o.getAttribute("minValue");
		var v = o.value;
		if (mv && (!v || !/^[0-9]+$/.test(v) || parseInt(v, 10) < mv)) {
			msg.push("【" + o.title + "】" + m1[4]+ mv);
		}
	}
	var os = getElementsByClassName(form, "maxLength", "input");
	for ( var i = 0; i < os.length; i++) {
		var o = os[i];
		var mv = o.getAttribute("maxLength");
		var v = o.value;
		if (mv && v.length > mv) {
			msg.push("【" + o.title + "】" +m1[5]+ mv);
		}
	}
	var os = getElementsByClassName(form, "minLength", "input");
	for ( var i = 0; i < os.length; i++) {
		var o = os[i];
		var mv = o.getAttribute("minLength");
		var v = o.value;
		if (mv && v.length < mv) {
			msg.push("【" + o.title + "】"+m1[6] + mv);
		}
	}

	if (msg.length == 0) {
		return true;
	} else {
		alert(msg.join("\n"));
		return false;
	}
}

function selectall(ischecked){
	var objs=document.getElementsByName("ids");
	for(var i=0; i<objs.length;i++){
		 if(objs[i].type == "checkbox") objs[i].checked=ischecked;
	}
}
function delCheck(){
	return confirm("你确定要删除选择数据?");
}

function ajaxCarsData(){
	var car_form = $("#car_form");
	car_form.find("td span").click(function(){
		chooseSpanClick($(this));
	})
}

function chooseSpanClick(span){
	var parentTD = span.parent("td");
	parentTD.find("span").removeClass("choosed");
	span.addClass("choosed");
	
	var param = carsDate(span.parents("table"), 1);
	chooseSpanLoad(param);
}

function chooseSpanLoad(param){
	$.ajax({
		url:"carsearch.php?"+param,
		type: "post",
		dataType: "text/html",
		timeout: 60000,
		error: function(){
			alert("获取数据异常");
		},
		success: function(data){
			$("#car_dest").html(data);
			$("#car_dest").find("#pagebar a").click(function(){
				var pageNo = $(this).attr("page");
				if(pageNo) {
					var param = carsDate($(this).parents("table"), pageNo);
				}
			})
		}
	});
}
function imgAdjBase(img,w,h){
	img.removeAttribute("width");
	img.removeAttribute("height"); 
	if(img.width/img.height>w/h){
		img.width=w;
		img.height*=w/img.width;
	}else{
		img.height=h;
		img.width*=h/img.height;
	}
	img.style.marginTop=img.style.marginBottom=(h-img.height)/2;
}
function imgAdjust(img,w,h){
	imgAdjustBase(img, false, true, w, h);
}
function imgAdjustBase(img,zout,nov,w,h){
	if(!w) w=img.width,h=img.height;
	var sizeImg=new Image();
	sizeImg.src=img.src;
	var rate=sizeImg.width/sizeImg.height,hok,wok;//hok to avoid awkard img.height=0
	if(rate>w/h) wok=img.width=zout || sizeImg.width>w?w:sizeImg.width,hok=img.height=wok/rate;
	else hok=img.height=zout || sizeImg.height>h?h:sizeImg.height,img.width=hok*rate;
	//care must use Math.floor(...), because firefox support decimal, that may cause disaster of a pixel.
	if(!nov && h>hok) img.style.marginBottom=Math.floor((h-hok)/2),img.style.marginTop=h-hok-Math.floor((h-hok)/2);
}

function carsDate(table, pageNo){
	var param = "xx";
	var priceId = table.find("#price span.choosed").attr("pid");
	if("all" != priceId){
		param += "&price_id="+priceId;
	}

	var categoryId = table.find("#category span.choosed").attr("pid");
	if("all" != categoryId){
		param += "&category_id="+categoryId;
	}

	var countryId = table.find("#country span.choosed").attr("pid");
	if("all" != countryId){
		param += "&country_id="+countryId;
	}
	var is_new = table.attr("is_new");
	if(is_new){
		param += "&is_new="+is_new;
	}
	if(pageNo){
		param += "&page_no="+pageNo;
	}
	return param.replace("xx&", "");
}

//flashvars=file=video_src&image=video_img
function playVideo(id,flashvars,isEng){
	var s1 = new SWFObject((isEng==1?"../":"")+"js/player.swf", "ply", "450", "400", "9", "#000");
	s1.addParam("allowfullscreen", "true");
	s1.addParam("allowscriptaccess", "always");
	s1.addParam("flashvars", flashvars);
	s1.write(id);
}


