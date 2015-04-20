<?php

//将数组转化为树形数组   
 function arrToTree($data,$pid){  
        foreach($data as $k => $v){  
            if($v['pid'] == $pid){  
                $id.=arrToTree($data,$v['id']);  
                $id.=$v['id'].',';                

            }  
        }  
         return $id;
 } 
//根据ID获得分类名
function getCategoryName($id){
	if (empty ( $id )) {
		return '顶级分类';
	}
	$Category = D ( "Category" );
	$list = $Category->getField ( 'id,title' );
	$name = $list [$id];
	return $name;
}
// 根据ID获取栏目英文名称
function getNavUrl($catid){
    $map['id'] = array('eq',$catid);
	return M('Category')->where($map)->getField('url');
}
//根据ID获得模型名
function getModuleById($id){
	$Category = D ( "Category" );
	$list = $Category->getField ( 'id,modelname' );
	$module = $list [$id];
	return $module;
}
// 左侧导航菜单
function getLeftMenu($id){
    $Model = D("Category");
	$list = $Model->where("pid=$id")->select();
	$url = D('Category')->where("id =$id")->find();
	$html = "";
	foreach($list as $vo){
	    $html.="<li><a href='/".$url['url'].$vo['id'].".html' title='".$vo['title']."'>".$vo['title']."</a></li>";
	}
	return $html;
}

//MD5
function pwdHash($password, $type = 'md5') {
	return hash ( $type, $password );
}

/**
 * 计算数组长度减一 一般用于栏目加载
 * @param type $var
 * @return type
 */
function toCount($var){
    return count($var)-0;
}

// 根据ID获取内容中的图片
function getContentImg($content){
	$img_src = '/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg]))[\'|\"].*?[\/]?>/';
	if(preg_match_all($img_src,$content,$reg)) {
		return $reg[0][0];
	} else {
	    return "<img src='/Public/images/nopic.jpg' />";
	}
}

// 获取缩略图
function getImgThumb($modelname,$id){
    $model = M('Common_img');
	$map['catid'] = array('eq',$id);
	$map['modelname'] = array('eq',$modelname);
	$data = $model->where($map)->order('id desc')->limit('1')->find();
	if($data != false) {
	    return "__ROOT__/Uploads/".$data['thumb'];
	} else {
	    return "__ROOT__/Public/images/nopic.jpg";
	}
}