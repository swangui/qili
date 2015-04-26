<?php

// 显示时间
function toDate($time, $format = 'Y-m-d H:i:s') {
	if (empty ( $time )) {
		return '';
	}
	$format = str_replace ( '#', ':', $format );
	return date ($format, $time );
}

//字符串截取，支持中文和其他编码
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true) {
 
	$str = strip_tags($str); // 去除html标签
	$str_original = $str;    // 获取原始内容
	$replace=array(
		  '&lt;'   => '<',
		  '&gt;'   => '>',  
		  '&nbsp;' => ' ',
		  '&quot;' => '"',
		  "&#39;"  => "'",
		  "&amp;"  => '&'
    );
	$replace2=array(
		  '<' => '&lt;',
		  '>' => '&gt;',  
		  ' ' => '&nbsp;',
		  '"' => '&quot;',
		  '"' => "&#39",
		  "&" => '&amp;'
    );
	$str=strtr($str,$replace); 
	
	// 如果参数数字小于内容字符数
	$str_length=mb_strlen($str,$charset);
	if($length < $str_length) {
		if(function_exists("mb_substr"))
		  $slice = mb_substr($str, $start, $length, $charset);
		elseif(function_exists('iconv_substr')) {
		  $slice = iconv_substr($str,$start,$length,$charset);
		}else{
		  $re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
		  $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
		  $re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
		  $re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
		  preg_match_all($re[$charset], $str, $match);
		  $slice = join("",array_slice($match[0], $start, $length));
		}
		$slice = strtr($slice,$replace2);
		return $suffix ? $slice.'...' : $slice;
	} else {
	    return $str_original;
	}

}
