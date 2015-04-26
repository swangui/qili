<?php

class SetAction extends CommonAction {
    public function index() {
        //加载用户配置文件信息
        $user_config = F('set','',CONF_PATH);
        
        //登录安全设置
        $set=D('Set')->find();
        $this->set=$set;
        $this->user_config=$user_config;
        $this->display();  
    }
    public function save() {
        if(is_uploaded_file($_FILES['icon']['tmp_name'])) {
			if($_FILES['icon']['name'] != 'favicon.ico'){
			    $this->error('favicon.ico名称或格式不符！');
			}else{
				//设置附件上传目录
				$y = date('Y',time());
				$m = date('n',time());
				$d = date('j',time());
				
				$dir='./Uploads/'.$y;
				if (!is_dir($dir)) {
					mkdir($dir, 0777);
				}
				$dir.='/'.$m;
				if (!is_dir($dir)) {
					mkdir($dir, 0777);
				}
				$dir.='/'.$d;
				if (!is_dir($dir)) {
					mkdir($dir, 0777);
				}
				$dir.='/';
				$path = $dir.'favicon.ico';
				if(!move_uploaded_file($_FILES['icon']['tmp_name'],$path)){
				    $this->error('favicon图标上传失败！');
				} else {
				    $_POST['icon'] = $y.'/'.$m.'/'.$d.'/favicon.ico';
				}
				unset($_FILES['icon']['name']); // 消毁icon变量，避免logo上传报错！
			}
		}
        
        $config = array(
            "SITE_URL"     => $_POST["SITE_URL"],
            "SITE_TITLE"    => $_POST["SITE_TITLE"],
            "SITE_KEYWORDS" => $_POST["SITE_KEYWORDS"],
            "SITE_DESCRIPTION" => $_POST["SITE_DESCRIPTION"],
			"SITE_AUTHOR" => $_POST["SITE_AUTHOR"]
	    );
		
        $model = D('Set');
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
        if(F("set",$config,CONF_PATH)){
            $this->success("设置成功");
		}
    }
}
