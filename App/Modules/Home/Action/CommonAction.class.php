<?php
/*前台动作基类*/
class CommonAction extends Action {
    //初始化
    function _initialize(){
        header("Content-Type:text/html; charset=utf-8");
        //import('@.ORG.Util.Cookie');
        
        //每日流量统计
        $tjdate = M('Tjdate');
        $map['create_date'] = array('eq',date('Ymd',time()));
        $vl = $tjdate->where($map)->find();
        if($vl){
            $tjdate->id = $vl['id'];
            $tjdate->create_num = $vl['create_num']+1;
            $tjdate->save();
        }else{
            $tjdate->create_date = date('Ymd',time());
            $tjdate->create_num = 1;
            $tjdate->add();
        }
        
        //页面流量统计
        $tjurl = M('Tjurl');
        $map['create_url'] = __SELF__;
        $vla = $tjurl->where($map)->find();
        if($vla){
            $tjurl->id = $vla['id'];
            $tjurl->create_num = $vla['create_num']+1;
            $tjurl->save();
        }else{
            $tjurl->create_url = __SELF__;
            $tjurl->create_num =1 ;
            $tjurl->add();
        }
        
    }
   
    //SEO赋值
    public function seo($title,$keywords,$description){
    	$title = $title ? $title.'-'.C('SITE_TITLE') : C('SITE_TITLE');
		$this->assign('title',$title);
    	$this->assign('keywords',$keywords);
		$this->assign("author",C("SITE_AUTHOR"));
    	$this->assign('description',$description);       
    }
    
    public function index() {
        $name = $this->getActionName();
        $id = I('id');
		// SEO 
		$catdata = M('Category')->where('status=1')->find($id);
        $this->seo(($catdata['title']), $catdata['keywords'], $catdata['description']);
        $this->assign("data", $catdata);
        $this->display(); 
    }
	
	// Ajax验证码检测
	public function checkVerify() {
        $verify  = strtolower($_REQUEST['fieldValue']);
		$validateId=$_REQUEST['fieldId'];
	    $arrayToJs = array();
		$arrayToJs[0] = $validateId;

		if($_SESSION['verify'] != md5($verify)) {
           $arrayToJs[1]=false;
		   echo json_encode($arrayToJs);
		   return;
        } else {
           $arrayToJs[1]=true;
		   echo json_encode($arrayToJs);
		}
	}    
    
}