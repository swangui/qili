<?php

class PublicAction extends IndexAction {
    public function main() {
        $this->checkUser();
        //流量统计
        $tjdate=D('Tjdate');
        $tjmap['create_date']=array('eq',date('Ymd',time()));
        $tjmap1['create_date']=array('eq',date('Ymd',time())-1);
        $tjmap2['create_date']=array('like',date('Ym',time()).'%');
        
        $tjnum=$tjdate->where($tjmap)->getField('create_num');//今日流量数
        $tjnum1=$tjdate->where($tjmap1)->getField('create_num');//昨日流量数
        $tjnum2=$tjdate->where($tjmap2)->sum('create_num');//当月流量数

		
        $this->tjnum=$tjnum==null ? 0:$tjnum;
        $this->tjnum1=$tjnum1==null ? 0:$tjnum1;
        $this->tjnum2=$tjnum2==null ? 0:$tjnum2;
        
	    $info = array(
			'本机IP'     => $_SERVER['REMOTE_ADDR'],
			'服务器IP'   => $_SERVER['SERVER_ADDR'],
			'网站根目录'  => $_SERVER['DOCUMENT_ROOT'],
			'已使用空间'    => $this->_getRealSize($this->_getDirSize($_SERVER['DOCUMENT_ROOT'])),
			'现在时间'    => date('Y-m-d H:i:s'),
			'上次登录时间' => toDate($_SESSION['lastLoginTime']),
			'操作系统'    => PHP_OS,
			'PHP运行方式' => PHP_SAPI	,
			'PHP运行环境' => $_SERVER['SERVER_SOFTWARE'],			
		);
		$this->info = $info;
        $this->display();
    }
    // 顶部页面
    public function top() {
        $this->checkUser();
        $model=M("Node");
        $list=$model->where('status=1 and pid=0')->order('sort asc')->getField('id,title');
        $this->assign('nodeGroupList',$list);
        $this->display();
    }
    // 菜单页面
    public function menu() {
        $this->checkUser();
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu  = array();
            
                //读取数据库模块列表生成菜单项
                $node=M("Node");
                $map['level']=2;
                $map['status']=1;
                $list=$node->where($map)->field('id,name,pid,title')->order('sort asc')->select();
                $accessList = $_SESSION['_ACCESS_LIST'];
                
                foreach($list as $key=>$module) {
                    if(isset($accessList[strtoupper(APP_NAME)][strtoupper($module['name'])]) || $_SESSION['administrator']) {
                        //设置模块访问权限
                        $module['access'] =   1;
                        $menu[$key]  = $module;
                    }
                }
                //缓存菜单访问
                $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]	=$menu;
           
            if(isset($_GET['tag'])){
                
                $tag=$_GET['tag'];
                if(0==$tag){
                   $this->assign('menuTitle','扩展功能'); 
                }else{
                    $mapid['id']=array('eq',$tag);
                    $node=M("Node");
                    $title=$list=$node->where($mapid)->getField('title');
                    $this->assign('menuTitle',$title);
                }
                $this->assign('menuTag',$tag);
                
                
            }else{
                $this->assign('menuTitle','内容管理');
            }
            
            $this->assign('menu',$menu);
        }
        
        //显示站点栏目
        $cate=new CategoryModel();
        $menu=$cate->getMyCategory();//加载栏目
        $menu=  arrToTree($menu, 0);
        $tree=outMenuNode($menu);
        $this->assign('tree', $tree); 
        
        $this->display();
    }


    // 用户登录页面
    public function login() {
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
			$this->display();
        }else{
            $this->redirect('Index/index');
        }
    }

    public function index() {
        //如果通过认证跳转到首页
        redirect(__APP__);
    }

    // 用户登出
    public function logout() {
        if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            unset($_SESSION[C('USER_AUTH_KEY')]);
            unset($_SESSION);
            session_destroy();
            $this->success('登出成功！',U('Public/login'));
        }else {
            $this->error('已经登出！');
        }
    }

    // 登录检测
    public function checkLogin() {
        
        if(empty($_POST['account'])) {
            $this->error('请填写您的登录用户名！');
        }elseif (empty($_POST['password'])){
            $this->error('请填写密码！');
        }elseif (empty($_POST['verify'])){
            $this->error('请填写验证码！');
        }
        if(!extension_loaded('curl')){    
            $this->error('抱歉，您的服务器，还不支持curl扩展，请配置后登录，如有问题，请咨询www.phptao.com！');
        }
        //生成认证条件
        $map=array();
        // 支持使用绑定帐号登录
        $map['account']	= $_POST['account'];
        $map["status"]=array('gt',0);
        if($_SESSION['verify'] != md5(strtolower($_POST['verify']))) {
			$this->error('验证码输入错误，请重新填写验证码！');
        }
        import ( 'ORG.Util.RBAC' );
        $authInfo = RBAC::authenticate($map);
        
        //使用用户名、密码和状态的方式进行认证
        if(false == $authInfo) {
            $this->error('用户名或密码错误！');
        }else {
            $error=D('Set')->find();
            $errorcount=$error['errorcount'];
            $errorinterval=$error['errorinterval'];

            $ip=get_client_ip();
            $time=time();
            $error_count=$authInfo['error_count'];
            //ip相同
            if($authInfo['last_login_ip']==$ip && ($authInfo['error_count']>$errorcount-1)){
               
                if(($time-$authInfo['error_login_time'])<$errorinterval){
                    $this->error('用户名或密码错误超过'.$errorcount.'次，请'.($errorinterval/60).'分钟后再试！');
                }  else {
                    D('User')->where($map)->setField('error_count',0);
                    $error_count=0;
                }
            }
            if($authInfo['password'] != md5($_POST['password'])) {
                D('User')->where($map)->setInc('error_count',1);//密码错误次数
                D('User')->where($map)->setField('error_login_time',$time);
                $this->error('用户名或密码错误，您还有'.($errorcount-$error_count).'次尝试机会！');
            }
            
            $_SESSION[C('USER_AUTH_KEY')]=$authInfo['id'];
            $_SESSION['email']=$authInfo['email'];
            $_SESSION['loginUserName']=$authInfo['nickname'];
            $_SESSION['lastLoginTime']=$authInfo['last_login_time'];
            $_SESSION['login_count']=$authInfo['login_count'];
            if($authInfo['role_id']==0) {
                $_SESSION['administrator']=true;
            }
            //保存登录信息
            $User=M('User');
            $data = array();
            $data['id']=$authInfo['id'];
            $data['last_login_time']=$time;
            $data['login_count']=array('exp','login_count+1');
            $data['error_count']=0;
            $data['last_login_ip']=$ip;
            $User->save($data);

            // 缓存访问权限
            RBAC::saveAccessList();
            
            $this->success('登录成功！');
			
            
        }
    }
    // 检查用户是否登录
    protected function checkUser() {
        if(!isset($_SESSION[C('USER_AUTH_KEY')])) {
            $this->assign('jumpUrl',U('Public/login'));
            $this->error('您没有登录！');
        }
    }
    // 更换密码
    public function changePwd() {
	    $this->checkUser();
        //对表单提交处理进行处理或者增加非表单数据
        if($_SESSION['verify'] != md5(strtolower($_POST['verify']))) {
            $this->error('验证码错误！');
        }
        $map=array();
        $map['password']= pwdHash($_POST['oldpassword']);
        if(isset($_POST['account'])) {
            $map['account']=$_POST['account'];
        }elseif(isset($_SESSION[C('USER_AUTH_KEY')])) {
            $map['id']=$_SESSION[C('USER_AUTH_KEY')];
        }
        //检查用户
        $User=M("User");
        if(!$User->where($map)->field('id')->find()) {
            $this->error('旧密码输入错误！');
        }else {
            $User->password=pwdHash($_POST['password']);
            $User->save();
            $this->success('密码修改成功！');
         }
    }
    
    public function profile() {
        $this->checkUser();
        $User=M("User");
        $vo=$User->getById($_SESSION[C('USER_AUTH_KEY')]);
        $this->assign('vo',$vo);
        $this->display();
    }
    // 修改资料
    public function change() {
        $this->checkUser();
        $User=D("User");
        if(!$User->create()) {
            $this->error($User->getError());
        }
        $result	=$User->save();
        if(false !== $result) {
            $this->success('资料修改成功！');
        }else{
            $this->error('资料修改失败!');
        }
    }
	
	// 获取文件夹大小
	private function _getDirSize($dir){ 
		$handle = opendir($dir);
		$sizeResult = '';
		while (false !== ($folderOrFile = readdir($handle))){ 
		    if($folderOrFile != "." && $folderOrFile != ".."){ 
				$src = $dir.'/'.$folderOrFile;
				if(is_dir($src)){ 
				    $sizeResult += $this->_getDirSize($src); 
				} else { 
				    $sizeResult += filesize($src); 
				}
	        }    
        }
	  closedir($handle);
	  return $sizeResult;
	}
	
	// 单位自动转换函数
	private function _getRealSize($size){ 
		$kb = 1024;         // Kilobyte
		$mb = 1024 * $kb;   // Megabyte
		$gb = 1024 * $mb;   // Gigabyte
		$tb = 1024 * $gb;   // Terabyte
		if($size < $kb){ 
		    return $size." B";
		} else if ($size < $mb){ 
		    return round($size/$kb,2)." KB";
		} else if ($size < $gb){ 
		    return round($size/$mb,2)." MB";
		} else if ($size < $tb){ 
		    return round($size/$gb,2)." GB";
		} else { 
		    return round($size/$tb,2)." TB";
		}
	}
}
