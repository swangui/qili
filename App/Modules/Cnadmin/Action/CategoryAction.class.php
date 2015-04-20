<?php

class CategoryAction extends CommonAction{
	public function index() {        
        $cate=new CategoryModel();
        $menu =$cate->getMyCategory(); //加载栏目
        $menu = arrToMenu($menu,0);  
        $this->list=$menu;
        Cookie::set('_currentUrl_', __SELF__);
        $this->display();  
    }
    public function _before_add() {
        if(isset($_GET['id'])){
            $current_pid=$_GET['id'];
        }
        if(isset($_GET['model'])){
            $current_modelname=$_GET['model'];
        }
        $cate=new CategoryModel();
        $menu =$cate->getMyCategory(); //加载栏目
        $menu = arrToMenu($menu,0);  
        $this->list=$menu;
        $this->mdldata=$cate->getMyModel();//加载模型
        
        $this->current_pid=$current_pid;
        $this->current_modelname=$current_modelname;
    }
    public function _before_edit() {
        $cate=new CategoryModel();
        $menu =$cate->getMyCategory(); //加载栏目
        $menu = arrToMenu($menu,0);  
        $this->list=$menu;
        $this->mdldata=$cate->getMyModel();//加载模型
        
    }
    function insert() {
        
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        $map['id'] = $_POST['pid'];
        $level=$model->where($map)->getField('level');
        $model->level = $level+1;
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
    function update() {
        
        $name = $this->getActionName();
        $model = D($name);
        if (false === $model->create()) {
            $this->error($model->getError());
        }
        $map['id'] = $_POST['pid'];
        $level=$model->where($map)->getField('level');
        $model->level = $level+1;
        // 更新数据
        $list = $model->save();
        if (false !== $list) {
            //成功提示
            $this->assign('jumpUrl', Cookie::get('_currentUrl_'));
            $this->success('编辑成功!');
        } else {
            //错误提示
            $this->error('编辑失败!');
        }
    }
   
  
}
