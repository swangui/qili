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


// 发送邮件
function sendmail($to,$subject,$body,$type){
	require_once("Data/email.class.php");
	$config = M("Set")->find();
	$smtpserver = $config['mail_server'];                        // SMTP服务器
	$smtpserverport =25;                                         // SMTP服务器端口
	$smtpusermail = $config['mail_usermail'];                    // SMTP服务器的用户邮箱
	$smtpuser = $config['mail_user'];                            // SMTP服务器的用户帐号
	$smtppass = $config['mail_password'];                        // SMTP服务器的用户密码
	$smtpemailto = ($type == 0) ? $config['mail_usermail'] : $to;// 发送给谁,0自已,1用户
	$mailsubject = $subject;                                     // 邮件主题
	$mailbody = $body;                                           // 邮件内容
	$mailtype = "HTML";                                          // 邮件格式（HTML/TXT）,TXT为文本邮件
	$smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass); // 这里面的一个true是表示使用身份验证,否则不使用身份验证.
	$smtp->debug = false; // 是否显示发送的调试信息
	$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);
}
