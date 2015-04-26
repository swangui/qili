<?php

class SurveyAction extends CommonAction{
    //过滤查询字段
    function _filter(&$map){
        $map['shopname'] = array('like',"%".$_POST['name']."%");
    }
}
