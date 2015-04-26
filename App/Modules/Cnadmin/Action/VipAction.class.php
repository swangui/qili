<?php

class VipAction extends CommonAction{
    function _initialize() {
        import('ORG.Util.Cookie');
        //检查认证识别号
		if (!$_SESSION [C('USER_AUTH_KEY')]) {
            //跳转到认证网关
           redirect(U(C('USER_AUTH_GATEWAY')));
        }
    }
    //过滤查询字段
    function _filter(&$map){
		if(isset($_GET['catid'])){
            $map['catid']=  array('eq',$_GET['catid']);
        }     
        $map['shopname'] = array('like',"%".$_POST['name']."%");
    }
    public function _before_index() {
        if(isset($_GET['catid'])){
            $this->catid=$_GET['catid'];
        }
        if(isset($_POST['catid'])){
            $this->catid=$_POST['catid'];
        }
    }
    // 前置删除图片
	public function _before_foreverdelete() {
	    $name = $this->getActionName();
		$id = I('get.id');
		$map['id'] = array('in',$id);
		$list = M($name)->where($map)->getField('transaction-img,shopimg');
        $dir = './Uploads/';
		foreach($list as $key=>$value) {
			$src = $dir.$key;
			$src2 = $dir.$value;
			if(is_file($src) || is_file($src2)) {
			    unlink($src);
				unlink($src2);
			}
		}
	}
    // 下载文件
	public function download(){
	    $file_name = $_GET['file'];
		$file_dir = 'Uploads/';
		if(!file_exists($file_dir.$file_name)){
		    $this->error("找不到文件！");
		} else {
		    $file = fopen($file_dir.$file_name,"r");
			Header("Content-type:application/octet-stream");
			Header("Accept-Ranges:bytes");
			Header("Accept-Length:".filesize($file_dir.$file_name));
			Header("Content-Disposition:attachment;filename=".$file_name);
			echo fread($file,filesize($file_dir.$file_name));
			fclose($file);
			exit;
		}
	}

}
