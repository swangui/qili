<?php

class OtherAction extends CommonAction {
    //过滤查询字段
    function _filter(&$map){
        $map['setname'] = array('like',"%".$_POST['name']."%");
    }

}