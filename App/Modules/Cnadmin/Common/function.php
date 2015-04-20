<?php

// 根据ID获取栏目栏目名称
function getNavName($catid){
    $map['id'] = array('eq',$catid);
	$title = M('Category')->where($map)->getField('title');
	return $title  ? $title : '首页';
}

//将数组转化为树形数组   
 function arrToTree($data,$pid){  
        $tree = array();  
        foreach($data as $k => $v){  
            if($v['pid'] == $pid){  
                $v['pid'] = arrToTree($data,$v['id']);  
                $tree[] = $v;  
            }  
        }     

        return $tree;  
 } 
 
 //使用递归将多维数组转化为一维数组
 function arrToMenu($data,$pid){  
    static $menu = array();  
    foreach($data as $k => $v){  
        if($v['pid'] == $pid){  
            $menu[] = $v; 
            $v['pid'] = arrToMenu($data,$v['id']);  
            
        }  
    }
    return $menu;  
 }
 
//根据树形数组生成select控件
 function outNodeSelect($tree,$currentid){
     $html = '';  
    foreach($tree as $t){    
        if(empty($t['pid'])){
            if($currentid==$t['id']){
                $html.='<option value="'.$t['id'].'" selected="selected">';
            }else{
                $html.='<option value="'.$t['id'].'">';
            }
            
            for($i=1; $i<$t['level']; $i++) {
               $html.='&nbsp;&nbsp;&nbsp;&nbsp;';
               if($i==$t['level']-1){
                   $html.='|-'; 
               }
            }
            $html.=$t['title'];
            $html.='</option>';
        }else{
            if($currentid==$t['id']){
                $html.='<option value="'.$t['id'].'" selected="selected">';
            }else{
                $html.='<option value="'.$t['id'].'">';
            }
            
            for($i=1; $i<$t['level']; $i++) {
               $html.='&nbsp;&nbsp;&nbsp;&nbsp;'; 
               if($i==$t['level']-1){
                   $html.='|-'; 
               }
            }
            $html.=$t['title'];
            $html.='</option>';
            $html.=outNodeSelect($t['pid'],$currentid);
        }
    }   
    return $html;  
 }
 //输出菜单
 function outNode($tree){
     $html = ''; 
     
    foreach($tree as $t){ 
        $editurl=U('Node/edit',array('id'=>$t['id']));//__URL__/edit/id/'.$t['id'].'
        $addurl=U('Node/add',array('id'=>$t['id']));//__URL__/add/id/'.$t['id'].'
        $delurl=U('Node/foreverdel',array('id'=>$t['id']));//__URL__/foreverdel/id/'.$t['id'].'
        if(empty($t['pid'])){
            $html.='<tr>';
            $html.='<td><input type="checkbox" name="key" value="'.$t['id'].'"></td>';
            $html.='<td>'.$t['id'].'</td>';
            if($t['level']==1){               
                 $html.='<td style="text-align:left;"><a style="padding-left: '.(($t['level']-1)*20).'px; font-weight: bold;" href="'.$editurl.'" title="修 改">'.$t['title'].'</a></td>';
           
            }  else {
                 $html.='<td style="text-align:left;"><a style="padding-left: '.(($t['level']-1)*20).'px;" href="'.$editurl.'" title="修 改">|-'.$t['title'].'</a></td>';
           
            }
            $html.='<td>'.$t['name'].'</td>';
			$html.='<td>'.$t['sort'].'</td>';
			$html.='<td>'.$t['status'].'</td>'; 
            $html.='<td align="center"> &nbsp;&nbsp;<a style="margin-left: 20px;" href="'.$addurl.'" title="添加子菜单">添加子菜单</a>&nbsp;&nbsp;<a style="margin-left: 10px;" href="'.$editurl.'" title="修 改">修改</a>&nbsp;&nbsp;<a style="margin-left: 10px;" href="'.$delurl.'" title="删 除" onclick="foreverdel('.$t['id'].'); return false;">删除</a></td>';
            $html.='</tr>';
        }else{
            $html.='<tr>';
            $html.='<td><input type="checkbox" name="key" value="'.$t['id'].'"></td>';
            $html.='<td>'.$t['id'].'</td>';
            if($t['level']==1){
                 $html.='<td style="text-align:left;"><a style="padding-left: '.(($t['level']-1)*20).'px; font-weight: bold;" href="'.$editurl.'" title="修 改">'.$t['title'].'</a></td>';
           
            }  else {
                 $html.='<td style="text-align:left;"><a style="padding-left: '.(($t['level']-1)*20).'px;" href="'.$editurl.'" title="修 改">|-'.$t['title'].'</a></td>';
            
            }
            $html.='<td>'.$t['name'].'</td>';
			$html.='<td>'.$t['sort'].'</td>';  
			$html.='<td>'.$t['status'].'</td>';   
            $html.='<td align="center"> &nbsp;&nbsp;<a style="margin-left: 20px;" href="'.$addurl.'" title="添加子菜单">添加子菜单</a>&nbsp;&nbsp;<a style="margin-left: 10px;" href="'.$editurl.'" title="修 改">修改</a>&nbsp;&nbsp;<a style="margin-left: 10px;" href="'.$delurl.'" title="删 除" onclick="foreverdel('.$t['id'].'); return false;">删除</a></td>';
            $html.='</tr>';
            $html.=outNode($t['pid']);
        }
    }   
    return $html;  
 }
 //输出栏目
  function outMenuNode($tree){
    $html = '';  
    foreach($tree as $t){    
        if(empty($t['pid'])){ 
            $url=U($t['modelname'].'/index',array('catid'=>$t['id']));
            $html .= "<li><a href=\"".$url."\" class=\"nav-top-item\">{$t['title']}</a></li>";
        }else{  
            $html .="<li><a href=\"javascript:void(0)\" class=\"nav-top-item\">{$t['title']}</a><ul>";   
            $html .=outMenuNode2($t['pid']);
            $html  = $html.'</ul></li>';  
        }  
       
    } 
	$html .= "<li><a href=".U('Clearcache/index')." class='nav-top-item'>清除缓存</a></li>" ;
    return $html;  
 }
 // 二级栏目
 function outMenuNode2($tree){
     $html = '';  
    foreach($tree as $t){    
            $url=U($t['modelname'].'/index',array('catid'=>$t['id']));
            $html .= "<li><a href=\"".$url."\">{$t['title']}</a></li>"; 
       
    }   
    return $html;  
 }
 
 //权限组菜单输出
 function outMenu($tree,$nodeRoleList){  
    $html = '';  
    foreach($tree as $t){  
        if(in_array($t['id'],$nodeRoleList)){
            if(empty($t['pid'])){  
                $html .= '<li><span class="zjj"></span><input class="J_checkitem" type="checkbox" name="menu_id[]" value="'.$t['id'].'" checked=true class="J_checkitem" level="'.$t['level'].'">&nbsp;'.$t['title'].'</li>';
            }else{  
                $html .= '<li class="m-expanded"><span class="zj"></span><input class="J_checkitem" type="checkbox" name="menu_id[]" value="'.$t['id'].'" checked=true class="J_checkitem" level="'.$t['level'].'"><span>&nbsp;'.$t['title'].'</span><ul>';   
                $html .=outMenu($t['pid'],$nodeRoleList);  
                $html  = $html.'</ul></li>';  
            }  
        }else{
            if(empty($t['pid'])){  
                $html .= '<li><span class="zjj"></span><input class="J_checkitem" type="checkbox" name="menu_id[]" value="'.$t['id'].'" class="J_checkitem" level="'.$t['level'].'">&nbsp;'.$t['title'].'</li>';
            }else{  
                $html .='<li class="m-expanded"><span class="zj"></span><input class="J_checkitem" type="checkbox" name="menu_id[]" value="'.$t['id'].'" class="J_checkitem" level="'.$t['level'].'"><span>&nbsp;'.$t['title'].'</span><ul>';   
                $html .=outMenu($t['pid'],$nodeRoleList);  
                $html  = $html.'</ul></li>';  
            } 
        }
    }   
    return $html;  
 }

//清空前台项目的缓存
function clearCache()
{
    
	import("ORG.Util.Dir");

    if (is_dir("App/Runtime")){
        Dir::delDir(APP_PATH."Runtime");
    }

    if (is_dir("App/Html")){
        Dir::delDir(APP_PATH."Html");
    }

}

// 缓存文件
function cmssavecache($name = '', $fields = '') {
	$Model = D ( $name );
	$list = $Model->select ();
	$data = array ();
	foreach ( $list as $key => $val ) {
		if (empty ( $fields )) {
			$data [$val [$Model->getPk ()]] = $val;
		} else {
			// 获取需要的字段
			if (is_string ( $fields )) {
				$fields = explode ( ',', $fields );
			}
			if (count ( $fields ) == 1) {
				$data [$val [$Model->getPk ()]] = $val [$fields [0]];
			} else {
				foreach ( $fields as $field ) {
					$data [$val [$Model->getPk ()]] [] = $val [$field];
				}
			}
		}
	}
	$savefile = cmsgetcache ( $name );
	// 所有参数统一为大写
	$content = "<?php\nreturn " . var_export ( array_change_key_case ( $data, CASE_UPPER ), true ) . ";\n?>";
	file_put_contents ( $savefile, $content );
}

function cmsgetcache($name = '') {
	return DATA_PATH . '~' . strtolower ( $name ) . '.php';
}
//根据ID获得栏目名
function getCategoryName($id){
    if(empty( $id )){
        return '顶级分类';
    }
    $Category = D ( "Category" );
    $list = $Category->getField ( 'id,title' );
    $name = $list [$id];
    return $name;
}
//根据ID获得模型名称
function getModelName($table){
    if(empty ( $table )){
        return '未知模块';
    }
    $Model= D ( "Model" );
    $list = $Model->getField ('table,name');
    $name = $list[$table];
    return $name;
}


//根据ID获取角色名称
function getRole($id){
    if($id==0){
        return '超级管理员';
    }else if(empty ( $id )){
        return '未知角色';
    }
    
    $Role = D ( "Role" );
    $list = $Role->getField ( 'id,name' );
    $name = $list [$id];
    return $name;
}

//获取状态
function getStatus($status, $imageShow = false) {
	switch ($status) {
		case 0 :
			$showText = '禁用';
			$showImg = '<img src="__PUBLIC__/Images/locked.gif" width="20" height="20" border="0" alt="禁用">';
			break;
		case 2 :
			$showText = '待审';
			$showImg = '<img src="__PUBLIC__/Images/prected.gif" width="20" height="20" border="0" alt="待审">';
			break;
		case - 1 :
			$showText = '删除';
			$showImg = '<img src="__PUBLIC__/Images/del.gif" width="20" height="20" border="0" alt="删除">';
			break;
		case 1 :
		default :
			$showText = '正常';
			$showImg = '<img src="__PUBLIC__/Images/ok.gif" width="20" height="20" border="0" alt="正常">';

	}
	return ($imageShow === true) ?  $showImg  : $showText;

}
function getMessageStatus($status, $imageShow = false) {
	switch ($status) {
		case 0 :
			$showText = '未审核';
			$showImg = '<img src="__PUBLIC__/Images/locked.gif" width="20" height="20" border="0" alt="未审核">';
			break;
		case 2 :
			$showText = '未审核';
			$showImg = '<img src="__PUBLIC__/Images/prected.gif" width="20" height="20" border="0" alt="未审核">';
			break;
		case - 1 :
			$showText = '删除';
			$showImg = '<img src="__PUBLIC__/Images/del.gif" width="20" height="20" border="0" alt="删除">';
			break;
		case 1 :
		default :
			$showText = '已审核';
			$showImg = '<img src="__PUBLIC__/Images/ok.gif" width="20" height="20" border="0" alt="显示">';

	}
	return ($imageShow === true) ?  $showImg  : $showText;

}

function getDefaultStyle($style) {
	if (empty ( $style )) {
		return 'blue';
	} else {
		return $style;
	}

}
function IP($ip = '', $file = 'UTFWry.dat') {
	$_ip = array ();
	if (isset ( $_ip [$ip] )) {
		return $_ip [$ip];
	} else {
		import ( "ORG.Net.IpLocation" );
		$iplocation = new IpLocation ( $file );
		$location = $iplocation->getlocation ( $ip );
		$_ip [$ip] = $location ['country'] . $location ['area'];
	}
	return $_ip [$ip];
}

function getNodeName($id) {
	if (Session::is_set ( 'nodeNameList' )) {
		$name = Session::get ( 'nodeNameList' );
		return $name [$id];
	}
	$Group = D ( "Node" );
	$list = $Group->getField ( 'id,name' );
	$name = $list [$id];
	Session::set ( 'nodeNameList', $list );
	return $name;
}

function get_pawn($pawn) {
	if ($pawn == 0)
		return "<span style='color:green'>没有</span>";
	else
		return "<span style='color:red'>有</span>";
}
function get_patent($patent) {
	if ($patent == 0)
		return "<span style='color:green'>没有</span>";
	else
		return "<span style='color:red'>有</span>";
}
function getNodeGroupName($id) {
        if (empty ( $id )) {
		return '未分组';
	}
	if (isset ( $_SESSION ['nodeGroupList'] )) {
		return $_SESSION ['nodeGroupList'] [$id];
	}
	$Group = D ( "Group" );
	$list = $Group->getField ( 'id,title' );
	$_SESSION ['nodeGroupList'] = $list;
	$name = $list [$id];
	return $name;
}

function getCardStatus($status) {
	switch ($status) {
		case 0 :
			$show = '未启用';
			break;
		case 1 :
			$show = '已启用';
			break;
		case 2 :
			$show = '使用中';
			break;
		case 3 :
			$show = '已禁用';
			break;
		case 4 :
			$show = '已作废';
			break;
	}
	return $show;

}
function showStatus($status, $id) {
	switch ($status) {
            case 0 :
                //$info = '<a href="javascript:resume(' . $id . ')">恢复</a>';
                $url=U('User/resume',array('id'=>$id));
                $info ='<a style="margin-left: 20px;" href="'.$url.'">恢复</a>';
                break;
            case 2 :
                //$info = '<a href="javascript:pass(' . $id . ')">批准</a>';
                $url=U('User/pass',array('id'=>$id));
                $info ='<a style="margin-left: 20px;" href="'.$url.'">批准</a>';
                break;
            case - 1 :
                //$info = '<a href="javascript:recycle(' . $id . ')">还原</a>';
                $url=U('User/recycle',array('id'=>$id));
                $info ='<a style="margin-left: 20px;" href="'.$url.'">还原</a>';
                break;
            case 1 :
                //$info = '<a href="javascript:forbid(' . $id . ')">禁用</a>';
                $url=U('User/forbid',array('id'=>$id));
                $info ='<a style="margin-left: 20px;" href="'.$url.'">禁用</a>';
                break;
		
	}
	return $info;
}

/**
 +----------------------------------------------------------
 * 获取登录验证码 默认为4位数字
 +----------------------------------------------------------
 * @param string $fmode 文件名
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function build_verify($length = 4, $mode = 1) {
	return rand_string ( $length, $mode );
}


function getGroupName($id) {
	if ($id == 0) {
		return '无上级组';
	}
	if ($list = F ( 'groupName' )) {
		return $list [$id];
	}
	$dao = D ( "Role" );
	$list = $dao->select( array ('field' => 'id,name' ) );
	foreach ( $list as $vo ) {
		$nameList [$vo ['id']] = $vo ['name'];
	}
	$name = $nameList [$id];
	F ( 'groupName', $nameList );
	return $name;
}
function sort_by($array, $keyname = null, $sortby = 'asc') {
	$myarray = $inarray = array ();
	# First store the keyvalues in a seperate array
	foreach ( $array as $i => $befree ) {
		$myarray [$i] = $array [$i] [$keyname];
	}
	# Sort the new array by
	switch ($sortby) {
		case 'asc' :
			# Sort an array and maintain index association...
			asort ( $myarray );
			break;
		case 'desc' :
		case 'arsort' :
			# Sort an array in reverse order and maintain index association
			arsort ( $myarray );
			break;
		case 'natcasesor' :
			# Sort an array using a case insensitive "natural order" algorithm
			natcasesort ( $myarray );
			break;
	}
	# Rebuild the old array
	foreach ( $myarray as $key => $befree ) {
		$inarray [] = $array [$key];
	}
	return $inarray;
}

/**
 +----------------------------------------------------------
 * 产生随机字串，可用来自动生成密码
 * 默认长度6位 字母和数字混合 支持中文
 +----------------------------------------------------------
 * @param string $len 长度
 * @param string $type 字串类型
 * 0 字母 1 数字 其它 混合
 * @param string $addChars 额外字符
 +----------------------------------------------------------
 * @return string
 +----------------------------------------------------------
 */
function rand_string($len = 6, $type = '', $addChars = '') {
	$str = '';
	switch ($type) {
		case 0 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		case 1 :
			$chars = str_repeat ( '0123456789', 3 );
			break;
		case 2 :
			$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
			break;
		case 3 :
			$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
			break;
		default :
			// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
			$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
			break;
	}
	if ($len > 10) { //位数过长重复字符串一定次数
		$chars = $type == 1 ? str_repeat ( $chars, $len ) : str_repeat ( $chars, 5 );
	}
	if ($type != 4) {
		$chars = str_shuffle ( $chars );
		$str = substr ( $chars, 0, $len );
	} else {
		// 中文随机字
		for($i = 0; $i < $len; $i ++) {
			$str .= msubstr ( $chars, floor ( mt_rand ( 0, mb_strlen ( $chars, 'utf-8' ) - 1 ) ), 1 );
		}
	}
	return $str;
}
function pwdHash($password, $type = 'md5') {
	return hash ( $type, $password );
}
//随机产生数字和字母
function randstrletters($num){
    
    $strarray=array('a','b','c','d','e','f','g','h','i','g','k','l','m','n','o','p','q','i','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
    for($i=0;$i<$num;$i++){
        $strlettes.=$strarray[mt_rand(0,36)];
    }
    return $strlettes;
}