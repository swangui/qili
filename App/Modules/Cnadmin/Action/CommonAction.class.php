<?php
class CommonAction extends Action {

    function _initialize() {
        import("ORG.Util.Cookie");
		// 用户权限检查
        if (C('USER_AUTH_ON') && !in_array(MODULE_NAME, explode(',', C('NOT_AUTH_MODULE')))) {
           
            import('ORG.Util.RBAC');
            if (!RBAC::AccessDecision()) {
                //检查认证识别号
                if (!$_SESSION [C('USER_AUTH_KEY')]) {
                    //跳转到认证网关
                    redirect(U(C('USER_AUTH_GATEWAY')));
                }
                // 没有权限 抛出错误
                if (C('RBAC_ERROR_PAGE')) {
                    // 定义权限错误页面
                    redirect(C('RBAC_ERROR_PAGE'));
                } else {
               
                    if (C('GUEST_AUTH_ON')) {
            
                        $this->assign('jumpUrl', U(C('USER_AUTH_GATEWAY')));
                    }
                    // 提示错误信息
                    $this->error(L('_VALID_ACCESS_'));
                }              
            }
         
        }
    }

    public function index() {
        
        //列表过滤器，生成查询Map对象
        $map = $this->_search();
        if (method_exists($this, '_filter')) {
            $this->_filter($map);
        }
    
        $name = $this->getActionName();

        $model = D($name);
        if (!empty($model)) {
           
            $this->_list($model, $map);
        }
        $this->display();
        return;
    }

    /**
      +----------------------------------------------------------
     * 取得操作成功后要返回的URL地址
     * 默认返回当前模块的默认操作
     * 可以在action控制器中重载
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    function getReturnUrl() {
        return __URL__ . '?' . C('VAR_MODULE') . '=' . MODULE_NAME . '&' . C('VAR_ACTION') . '=' . C('DEFAULT_ACTION');
    }

    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param string $name 数据对象名称
      +----------------------------------------------------------
     * @return HashMap
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _search($name = '') {
        //生成查询条件
        if (empty($name)) {
            $name = $this->getActionName();
        }
        $name = $this->getActionName();
        $model = D($name);
        $map = array();
        foreach ($model->getDbFields() as $key => $val) {
            if (isset($_REQUEST [$val]) && $_REQUEST [$val] != '') {
                $map [$val] = $_REQUEST [$val];
            }
        }
        return $map;
    }

    /**
      +----------------------------------------------------------
     * 根据表单生成查询条件
     * 进行列表过滤
      +----------------------------------------------------------
     * @access protected
      +----------------------------------------------------------
     * @param Model $model 数据对象
     * @param HashMap $map 过滤条件
     * @param string $sortBy 排序
     * @param boolean $asc 是否正序
      +----------------------------------------------------------
     * @return void
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    protected function _list($model, $map, $sortBy = '', $asc = false) {
        //排序字段 默认为主键名
        if (isset($_REQUEST ['_order'])) {
            $order = $_REQUEST ['_order'];
        } else {
            $order = !empty($sortBy) ? $sortBy : $model->getPk();
        }
        //排序方式默认按照倒序排列
        //接受 sost参数 0 表示倒序 非0都 表示正序
        if (isset($_REQUEST ['_sort'])) {
            $sort = $_REQUEST ['_sort'] ? 'asc' : 'desc';
        } else {
            $sort = $asc ? 'asc' : 'desc';
        }
        //取得满足条件的记录数
        $count = $model->where($map)->count('id');
        
        if ($count > 0) {
            import("ORG.Util.Page");
            //创建分页对象
            if (!empty($_REQUEST ['listRows'])) {
                $listRows = $_REQUEST ['listRows'];
            } else {
                $listRows = '10';
            }
            $page = new Page($count, $listRows);
            //分页查询数据
            $voList = $model->where($map)->order("`" . $order . "` " . $sort)->limit($page->firstRow . ',' . $page->listRows)->select();

            //分页跳转的时候保证查询条件
            foreach ($map as $key => $val) {
                if (!is_array($val)) {
                    $page->parameter .= "$key=" . urlencode($val) . "&";
                }
            }
            //分页显示
            $theme = "<ul class='pagination'><li>%upPage%</li><li>%linkPage%</li><li>%downPage%</li></ul>";
			$page->setConfig('prev', "«");
            $page->setConfig('next', "»");
			$page->setConfig('theme',$theme);
			$page = $page->show();
            //列表排序显示
            $sortImg = $sort; //排序图标
            $sortAlt = $sort == 'desc' ? '升序排列' : '倒序排列'; //排序提示
            $sort = $sort == 'desc' ? 1 : 0; //排序方式
            //模板赋值显示
            $this->assign('list', $voList);
            $this->assign('sort', $sort);
            $this->assign('order', $order);
            $this->assign('sortImg', $sortImg);
            $this->assign('sortType', $sortAlt);
            $this->assign("page", $page);
        }
        Cookie::set('_currentUrl_', __SELF__);
        return;
    }

    function insert() {
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        //保存当前数据对象
        $list = $model->add();
        if ($list !== false) { //保存成功
            $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
            $this->success('新增成功!');
        } else {
            //失败提示
            $this->error('新增失败!');
        }
    }

    public function add() {
        $this->display();
    }

    function edit() {
        $name = $this->getActionName();
        $model = M($name);
        $id = $_REQUEST [$model->getPk()];
        $vo = $model->getById($id);
        $this->assign('vo', $vo);
        $this->display();
    }

    function update() {
		$name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        // 更新数据
        $list = $model->save();
        if (false !== $list) {
            // 修改时是否删除了图片
			$content = $_POST['content'];
			$map['catid'] = array('eq',$_POST['id']);
			$map['modelname'] = array('eq',$name);
			$list = M('Common_img')->where($map)->select();

			// 如果内容中有图片
			if($list != false) {
			    $dir = "./Uploads/";
				foreach($list as $vo){
					$img = $vo['name'];
					$img2 = preg_quote($img,'/');
					$thumb = $vo['thumb'];
					if(!preg_match_all("/$img2/",$content,$att)){
						if(is_file("$dir/$img")) {
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
            $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
            $this->success('编辑成功!');
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
    }

    /**
      +----------------------------------------------------------
     * 默认删除操作
      +----------------------------------------------------------
     * @access public
      +----------------------------------------------------------
     * @return string
      +----------------------------------------------------------
     * @throws ThinkExecption
      +----------------------------------------------------------
     */
    public function delete() {
        //删除指定记录
        $name = $this->getActionName();
        $model = M($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
                $list = $model->where($condition)->setField('status', - 1);
                if ($list !== false) {
                    $this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
    }

    // 批量删除及单条删除
	public function foreverdelete() {
		$name = $this->getActionName();
        $model = D($name);
        if (!empty($model)) {
            $pk = $model->getPk();
            $id = $_REQUEST [$pk];
            if (isset($id)) {
                $condition = array($pk => array('in', explode(',', $id)));
				
				// 删除内容中的图片
				$map['catid'] = array('in',$id);
				$map['modelname'] = array('eq',$name);
				$list = M('Common_img')->where($map)->select();
				if($list != false) {
				    $dir = "./Uploads/";
					foreach($list as $vo){
					    $src = $dir.$vo['name'];
						$thumb = $dir.$vo['thumb'];
						if(is_file($src) || is_file($thumb['thumb'])) {
						    unlink($src);
							unlink($thumb);
						}
					}
					if(false == M('Common_img')->where($map)->delete()) {
					    $this->error('删除图片数据失败！');
					}
				}
				
				if (false !== $model->where($condition)->delete()) {
					$this->success('删除成功！');
                } else {
                    $this->error('删除失败！');
                }
            } else {
                $this->error('非法操作');
            }
        }
        //$this->forward();
    }

    //禁用操作 状态0
    public function forbid() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_REQUEST [$pk];
        $condition = array($pk => array('in', $id));
        $list = $model->forbid($condition);
        if ($list !== false) {
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('操作成功');
        } else {
            $this->error('操作失败！');
        }
    }
    //还原 状态1
    public function recycle() {
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->recycle($condition)) {

            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('操作成功！');
        } else {
            $this->error('操作失败！');
        }
    }

    //恢复 状态1
    function resume() {
        //恢复指定记录
        $name = $this->getActionName();
        $model = D($name);
        $pk = $model->getPk();
        $id = $_GET [$pk];
        $condition = array($pk => array('in', $id));
        if (false !== $model->resume($condition)) {
            $this->assign("jumpUrl", $this->getReturnUrl());
            $this->success('操作成功！');
        } else {
            $this->error('操作失败！');
        }
    }

     // 删除图片
    public function delfile(){
        if(isset($_GET['id'])&&isset($_GET['file'])){
            $id = $_GET['id'];	
            $file=$_GET['file'];
            $name = $this->getActionName();
            $model = D($name);
            $src = './Uploads/'.$model->where('id='.$id)->getField($file);
            $model->where('id='.$id)->setField($file,'');
            if(is_file($src))unlink($src);
            $this->success('操作成功');
        }
    }
	
	// 单图片上传
    public function _upload(){
        $name = $this->getActionName();
        if(!empty($_FILES))
        {
            import("ORG.Util.Image");
            import("ORG.Net.UploadFile");
            //导入上传类
            $upload = new UploadFile();
            //设置上传文件类型
            $upload->allowExts = explode(',', 'jpg,gif,png,jpeg');
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
			
			// 幻灯片
			if($name == 'Slide') {
				$upload->imageMaxWidth = '1920';
				$upload->imageMaxHeight = '450';
			}
			
			// 品牌
			if($name == 'Partners') {
				$upload->imageMaxWidth = '200';
				$upload->imageMaxHeight = '80';
			}
			
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
    
	
	// 百度编辑器上传图片
    public function ueditorUpload(){
		$name = $this->getActionName();
        if(!empty($_FILES))
        {
            import("ORG.Util.Image");
            import("ORG.Net.UploadFile"); //导入上传类
            
            $upload = new UploadFile();
			
			// 生成缩略图
			$upload->thumb = true; // 生成缩略图
			$upload->thumbPrefix =''; // 缩略图前缀
			$upload->thumbMaxWidth = 250; // 缩略图宽度
			$upload->thumbMaxHeight = 150; // 缩略图高度
			
			// 产品缩略图
			if($name == 'Product'){
			    $upload->thumbMaxWidth = 340; // 缩略图宽度
			    $upload->thumbMaxHeight = 210; // 缩略图高度			
			}

           
			// 设置附件上传目录
            $y = date('Y',time());
            $m = date('n',time()); // 数字表示的月份，没有前导零
            $d = date('j',time()); // 月份中的第几天，没有前导零
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
			$thumb_dir=$dir.'/thumb';
			if(!is_dir($thumb_dir)) {
				mkdir($thumb_dir,0777);
			}
			$upload->savePath =$dir;           // 原图保存路径
			$upload->thumbPath=$thumb_dir."/"; // 缩略图保存路径
			
            if (!$upload->upload()) {
                //捕获上传异常
                echo json_encode(array('state' => $upload->getErrorMsg()));                
            } else {
                $uploadInfo = $upload->getUploadFileInfo();
				$catid = (int) $_GET['catid'];
				if($catid != "") { // 如果是编辑方法
				    $data['catid'] = $catid;
				} else { //如果是新增方法
				    $model = new Model();
		            $dbname = 'my_'.strtolower($name);
	                $array = $model->query("show table status where Name = '$dbname'");
                    $data['catid'] = $array[0]['Auto_increment']; // 获取表下一下自增ID
				}
				$data['modelname'] = $name; // 获取模型名称
				$data['name'] = $y.'/'.$m.'/'.$d.'/'.$uploadInfo[0]['savename']; // 图片名称为：Uploads/年/月/日
				$data['thumb'] = $y.'/'.$m.'/'.$d.'/thumb/'.$uploadInfo[0]['savename']; // 缩略图名称
				if(false !== M("Common_img")->add($data)){
				    echo json_encode(array(
						     'url'      => $uploadInfo[0]['savename'],
						     'title'    => htmlspecialchars($_POST['pictitle'],ENT_QUOTES),
						     'original' => $uploadInfo[0]['name'],
						     'state'    => 'SUCCESS'
						));
			    }
            }      
        }
    }
}