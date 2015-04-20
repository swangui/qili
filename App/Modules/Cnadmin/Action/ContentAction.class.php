<?php

class ContentAction extends CommonAction{
    function _initialize() {
        import('ORG.Util.Cookie');
        //检查认证识别号
		if (!$_SESSION [C('USER_AUTH_KEY')]) {
            //跳转到认证网关
           redirect(U(C('USER_AUTH_GATEWAY')));
        }
    }
    public function index() {

		if(IS_POST){
			$model = D('Category');
			$validate=array(
                array('content','require','内容必填！',1),
            );
            if (false === $model->validate($validate)->create()) {
                $this->error($model->getError());
            }
            // 更新数据
            $list = $model->save();
            if (false !== $list) {
				$name = $this->getActionName();
				$map['catid'] = array('eq',$_POST['id']);
				$map['modelname'] = array('eq',$name);
				$list = M('Common_img')->where($map)->select();
	
				// 如果内容中有图片
				if($list != false) {
					$dir = "./Uploads/";
					foreach($list as $vo){
						$img = $vo['name'];
						$thumb = $vo['thumb'];
						$img2 = preg_quote($img,'/');
						$content = $_POST['content']; // 内容
						if(!preg_match_all("/$img2/",$content,$att)){
							if(is_file("$dir/$img") || is_file("$dir/$thumb")) {
								unlink("$dir/$img");
								unlink("$dir/$thumb");
								if(!M("Common_img")->where(array('id' => $vo['id']))->delete()){
								  $this->error("修改失败！");
								}	
							}
						}
					}
				}
				//成功提示
                $this->success('编辑成功!');
            } else {
                //错误提示
                $this->error('编辑失败!');
            }
        }else{
            if(isset($_GET['catid'])){
                $map['id']=array('eq',$_GET['catid']);
            }
            $cate=D('Category');
            $this->data=$cate->where($map)->find(); 
			$_GET['id'] = $_GET['catid']; // 获取百度编辑器上传图片用ID
            $this->display();  
        }   
    }  
}
