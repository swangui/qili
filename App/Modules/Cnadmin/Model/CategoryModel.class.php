<?php
class CategoryModel extends CommonModel {
    // 自动验证设置
    protected $_validate=array(
        array('title','require','栏目标题必填！',1),
    );
    
    // 自动填充设置
    protected $_auto=array(
        array('path','tclm',3,'callback')
    );
   function tclm(){
        $pid=isset($_POST['pid'])?(int)$_POST['pid']:0;
        if($pid==0){
            $data=0;
        }else{
            $list=$this->where("id=$pid")->find();
            $data=$list['path'].'-'.$list['id'];//子类的path为父类的path加上父类的id
        }
        return $data;
    }
    
    //获取栏目菜单
    public function getMyCategory() {
        //读取数据库模块列表生成菜单项   
        $node = D ( "Category" );  
        $map ['status'] =array("egt",0); 
        $list = $node->where($map)->order( 'level,listorder' )->select();  
        return $list;
    }
    //获取模型
    public function getMyModel(){
        
        $Model=D('Model');
        $mymodel=$Model->select();
        return $mymodel;
    }
    
}