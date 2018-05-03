<?php

if ( ! function_exists('create_pagination'))
{
	function create_pagination($url, $item_total, $page_size) {
		$url = preg_replace('/\&start=(\d*)/', '', $url);
		
		$config['base_url'] = base_url($url);
		$config['total_rows'] = $item_total;
		$config['per_page'] = $page_size;
		$config['uri_segment'] = 3;
		$config['num_links'] = 5;
		
		$config['page_query_string'] = FALSE;
		
		$config['query_string_segment'] = 'start';
		$config['full_tag_open'] = '<ul class="pagination float-right">';
		$config['full_tag_close'] = '</div>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
// 		“上一页”链接的打开标签。
		$config['prev_link'] = '&laquo;上一页';
		$config['prev_tag_open'] = '<li class="next">';
		$config['prev_tag_close'] = '</li>';
		
// 		“下一页”链接的打开标签。
		$config['next_link'] = '下一页 &raquo;';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		
		//当前页
		$config['cur_tag_open'] = ' <li class="active">'; // 当前页开始样式
		$config['cur_tag_close'] = '</li>';
		
		$config['last_link'] = '尾页';
		$config['last_tag_open'] = '<li>'; //“最后一页”链接的打开标签。
		$config['last_tag_close'] = '</li>';//“最后一页”链接的关闭标签。

		$config['first_link'] = '首页';
		$config['first_tag_open'] = '<li>'; //“最后一页”链接的打开标签。
		$config['first_tag_close'] = '</li>';//“最后一页”链接的关闭标签。
		
		$CI =& get_instance();
		$CI->load->library('pagination');
		$CI->pagination->initialize($config);
		
		return $CI->pagination->create_links();
	}
}

if ( ! function_exists('page_bar'))
{	
	function page_bar($url, $item_total, $page_no, $page_size) {
		$page_total = ceil ( $item_total / $page_size );
		if (! $page_no)
			$page_no = 1;
		$querystring = $_SERVER ['QUERY_STRING'];
		if ($querystring == "") {
			$url .= "?";
		} else {
			$temp = strpos ( $querystring, "page=" );
			if ($temp || substr ( $querystring, 0, 5 ) == "page=")
				$querystring = substr ( $querystring, 0, $temp );
			if ($querystring == "") {
				$url .= "?";
			} else {
				$url .= "?" . $querystring;
				if (substr ( strrev ( $url ), 0, 1 ) != "&")
					$url .= "&";
			}
		}
		$pageprev = $page_no - 1;
		$pagenext = $page_no + 1;
		$strout = "<div align=\"center\" style=\"font-size:14px;\">&nbsp;";
		if ($pageprev == 0) {
			$strout .= "第一页&nbsp;";
			$strout .= "上一页&nbsp;";
		} else {
			$strout .= "<a href=\"" . $url . "page=1\">第一页</a>&nbsp;";
			$strout .= "<a href=\"" . $url . "page=" . $pageprev . "\">上一页</a>&nbsp;";
		}
		if ($pagenext > $page_total) {
			$strout .= "下一页&nbsp;";
			$strout .= "最末页&nbsp;";
		} else {
			$strout .= "<a href=\"" . $url . "page=" . $pagenext . "\">下一页</a>&nbsp;";
			$strout .= "<a href=\"" . $url . "page=" . $page_total . "\">最末页</a>&nbsp;";
		}
		$page_bar = "第<select onchange=\"window.location.href='" . $url . "page='+this.value\">";
		for($i = 1; $i < $page_total + 1; $i ++) {
			if ($i == $page_no)
				$flag = " selected";
			else
				$flag = "";
			$page_bar .= "<option value='" . $i . "'" . $flag . ">" . $i . "</option>";
		}
		$page_bar .= "</select>页 共" . $item_total . "条";
		return $strout . $page_bar;
	}
}

if ( ! function_exists('get_dict_value'))
{
	function get_dict_value($dict_map, $map_key, $sub_map_key) {
		if(!$dict_map || !$map_key || !$sub_map_key){
			return '';
		}
		$sub_map = $dict_map[$map_key];
		if(!isset($sub_map)){
			return '';
		}
		if(!isset($sub_map[$sub_map_key])){
			return '';
		}
		return $sub_map[$sub_map_key];
	}
}


if ( ! function_exists('show_buttons'))
{
	function show_auth_buttons($page_buttons = array()) {
		$button_html = '';
		if($page_buttons) foreach ($page_buttons as $key => $button){
// 			$button_html .= "<button id=\"".$button['doc_id']."\" type=\"button\">".$button['menu_name']."</button>\n";
			$button_html .= "<input id=\"".$button['doc_id']."\" type=\"button\" value=\"".$button['menu_name']."\">\n";
		}
		return $button_html;
	}
}