<?php
return array(
  'APP_AUTOLOAD_PATH'   =>'@.TagLib',
  'TAGLIB_PRE_LOAD'     => 'kaifu',
  'TMPL_ACTION_ERROR'   => 'Public:error',
  'TMPL_ACTION_SUCCESS' => 'Public:success',
  'TMPL_PARSE_STRING'=>array(
		  '__PUBLIC__'=>__ROOT__.'/Public',
		  '__UPLOADS__'=>__ROOT__.'/Uploads',
	  ),      
);
?>