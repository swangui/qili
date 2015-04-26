<?php

class OrderAction extends CommonAction{
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
        $map['shopname'] = array('like',"%".$_POST['shopname']."%");
    }
    public function _before_index() {
        if(isset($_GET['catid'])){
            $this->catid=$_GET['catid'];
        }
        if(isset($_POST['catid'])){
            $this->catid=$_POST['catid'];
        }
    }
	// 商品信息列表
    public function _before_edit(){
	    $orderid = I('id');
		$orderlist_model = D('Orderlist');
		$orderlist_map['orderid'] = array('eq',$orderid);
		// 取得商品信息列表
		$list = $orderlist_model->where($orderlist_map)->select();
		//取得满足条件的记录数
        $count = $orderlist_model->where($orderlist_map)->count('id');
		$count = $count + 1;
		$this->assign('list', $list);
		$this->assign('count',$count);
	}
	// 删除商品信息列表
	public function _before_foreverdelete() {
		$orderlist_model = D('Orderlist');
		$orderid = I('get.id');
		$orderlist_map['orderid'] = array('in',$orderid);
		if(false === $orderlist_model->where($orderlist_map)->delete()){
		    $this->error('删除商品信息失败！');
		}

	}
}
