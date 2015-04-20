<?php

class VipAction extends CommonAction{
public function insert() {
        
		$this->seo("页面提示信息", C(SITE_KEYWORDS), C(SITE_DESCRIPTION));
		
		if($_SESSION['verify'] != md5(strtolower($_POST['verify']))) {
			$this->error('验证码输入错误，请重新填写验证码！');
        }

		// 过滤数据
		$_POST['shopname'] = $this->normalization($_POST['shopname']);
		$_POST['contactperson'] = $this->normalization($_POST['contactperson']);
		$_POST['tel'] = $this->normalization($_POST['tel']);
		$_POST['qq'] = $this->normalization($_POST['qq']);
		$_POST['address'] = $this->normalization($_POST['province']).$this->normalization($_POST['city']).$this->normalization($_POST['district']);
		$_POST['businessage'] = $this->normalization($_POST['businessage']);
		$_POST['monthlyquota'] = $this->normalization($_POST['monthlyquota']);
		
		// 图片上传
		if(is_uploaded_file($_FILES['transaction-img']['tmp_name'])){
		    $shopimgType =  substr($_FILES['transaction-img']['type'],0,5);
			if($shopimgType != 'image') {
				$this->error('请确保您上传的采购记录图片类型格式为jpg/png/gif!');
			}
			$this->upload();
		}
		if(is_uploaded_file($_FILES['shopimg']['tmp_name'])) {
		    $shopimgType =  substr($_FILES['shopimg']['type'],0,5);
			if($shopimgType != 'image') {
				$this->error('请确保您上传的店铺照片的类型为jpg/png/gif!');
			}
			$this->upload();
		}
		
		$name = $this->getActionName();
		$model = D($name);
		
		if(false !== $model->create()) {
			if(false !== $model->add()) {
				$subject = "您的网站有了新的提交信息！";
				$shopname = I("post.shopname");
				$contactperson = I("post.contactperson");
				$tel = I("post.tel");
				$body = "淘定ID：".$shopname."<br>姓名：".$contactperson."<br>电话：".$tel;
				@sendmail('',$subject,$body,0); // 用户提交信息后邮件通知我
				$message= "您提交的信息我们已经收到，我们会在3-5个工作日内给您回复，祝您工作顺利！";
				$this->success('恭喜留言成功，'.$message);
			}else{
				$this->error('提交失败，请联系管理员！');
			}
		}else{
			$this->error($model->getError());
		}
    }
	
	// 过滤数据
    public function normalization($string)
	{
		$replace=array(
		'<'  => '&lt;',
		'>'  => '&gt;',  
		"'"  => '&#039;',
		'"'  => '&quot;',
		' '  => '&nbsp;',
		);
		$string = strtr($string,$replace);
		return $string;
	}
	
	// 单图片上传
    public function upload(){
        $name = $this->getActionName();
        if(!empty($_FILES))
        {
			import("ORG.Util.Image");
            import("ORG.Net.UploadFile");
            //导入上传类
            $upload = new UploadFile();
            //设置上传文件类型
            $upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
			//设置上传文件的尺寸
			$upload->imageMaxWidth = '5000';
		    $upload->imageMaxHeight = '5000';
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
            $upload->savePath =$dir;
            $upload->saveRule = uniqid;
			
            if (!$upload->upload()) {
                //捕获上传异常
                $strerror=$upload->getErrorMsg();
                if($strerror!="没有选择上传文件"){
                    $this->error($strerror);
                }
                
            } else {
                //取得成功上传的文件信息
                $uploadList = $upload->getUploadFileInfo();
                foreach ($uploadList as $key => $value) {
                    foreach ($_FILES as $key1 => $value1) {
                        if($value['name']===$value1['name']){
							$_POST[$key1] = $y.'/'.$m.'/'.$d.'/'.$value['savename'];
                        }
                    }   
                }              
            }      
        }
    }

}
