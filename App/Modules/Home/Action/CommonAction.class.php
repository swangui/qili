<?php
/*前台动作基类*/
class CommonAction extends Action {
    //初始化
    function _initialize(){
        header("Content-Type:text/html; charset=utf-8");
        //import('@.ORG.Util.Cookie');
        
        //栏目导航
        $nav_list = M('Category')->where('pid=0 AND status=1')->order('listorder DESC')->select();
        if(is_array($nav_list)){
            
            foreach ($nav_list as $key=>$val){
                $nav_list[$key]['sub_nav'] = D('Category')->where('pid='.$val['id'].' AND status=1')->select();
            }
        }        
        $this->assign('nav_list',$nav_list);
        
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
    public function seo($title,$keywords,$description,$positioin){
    	$title = $title ? $title.'-'.C('SITE_TITLE') : C('SITE_TITLE');
		$this->assign('title',$title);
    	$this->assign('keywords',$keywords);
		$this->assign("author",C("SITE_AUTHOR"));
    	$this->assign('description',$description);
    	$this->assign('position',$positioin);
       
    }
    //URL转换
    public function changurl($ary){
    	if(is_array($ary)){
            if(key_exists('modelname', $ary)){
				$url = M('Category')->where("id =".$ary['pid'])->find();
				$ary['url'] = $url['url'].$ary['id'];
            }
            return  $ary;
        }		
    }
    
    public function index() {
        $name = $this->getActionName();
        if(method_exists($this, '_filter')){
            $this->_filter($map);
        }
        
        $id = I('id');
        
        //获取所有子类id
        $catlist = M('Category')->where('status=1')->select();	
        $idlist = $id.','.arrToTree($catlist,$id);  
        $idlist= substr($idlist, 0, strlen($idlist)-1);
        $map['catid'] = array('in',$idlist);

		// SEO and Hr URL
		$catdata = M('Category')->where('status=1')->find($id);	
		        
		// 获取URL
		$url = $catdata['url'];
        
        //获取分页设置
        $Model = M('Model');
        $map['table'] = array('eq',$name);
        $pageinfo=$Model->where($map)->find();

        $Form = M($name);
        import("ORG.Util.Page");       //导入分页类
        $count  = $Form->where($map)->count();    //计算总数
        $Page = new Page($count, $pageinfo['listrows']);
		$Page->url = $url; // 获取分页URL
        $list   = $Form->where($map)->limit($Page->firstRow. ',' . $Page->listRows)->order('listorder desc,id desc')->select();

        // 设置分页显示
        $Page->setConfig('header', $pageinfo['header']);
        $Page->setConfig('first', $pageinfo['first']);
        $Page->setConfig('last', $pageinfo['last']);
        $Page->setConfig('prev', $pageinfo['prev']);
        $Page->setConfig('next', $pageinfo['next']);
        $Page->setConfig('theme',$pageinfo['theme']);
        $page = $Page->show();

        $position = D('Common')->getPosition($id);
        foreach ($position as $value) {
            $title=$value['catname']."_".$title;
        }
        $title=  substr($title, 0, strlen($title)-1);
        $this->seo(($catdata['title'])?$catdata['title']:$title, ($catdata['keywords'])?$catdata['keywords']:C(SITE_KEYWORDS), ($catdata['description'])?$catdata['description']:C(SITE_DESCRIPTION), $position);
        $this->assign("data", $catdata);
        $this->assign("page", $page);
        $this->assign("list", $list);
		$this->url = $url; // 获取URL
        $this->display(); 
    }
	
    public function show()
    {
        $id = I('id');
        $name = $this->getActionName();
		
		// 获取栏目标题及URL
		$map['id']=array('eq',$id);
		$catid = M($name)->where($map)->getField('catid');
		$catdata = M('Category')->getById($catid);
		$this->catdata = $catdata;
        
       // D($name)->where('id='.$id)->setInc('hits',1);//浏览次数
       
        $model = M($name);

        //当前记录
        $data=$model->find($id);
        
        //上一条记录
		$prevmap['catid'] = array('eq',$catid);
		$prevmap['id'] = array('gt',$id);
        $prevdata = $model->where($prevmap)->order('id asc')->limit('1')->find();
        
        //下一条记录
		$nextmap['catid'] = array('eq',$catid);
		$nextmap['id'] = array('lt',$id);
        $nextdata=$model->where($nextmap)->order('id desc')->limit('1')->find();
        
        //seo设置
        $position = D('Common')->getPosition($data['catid']);
        $this->seo($data['title'], $data['keywords'], $data['description'], $position);
        
		// 杨涛修改，将内链优化后的图片title换成alt.
        $img_title = htmlspecialchars($data['title'],ENT_QUOTES);
		$data['content'] = preg_replace('/title=[\'|\"](.*?)[\'|\"]/','alt="'.$img_title.'"',$data['content']);

        $this->data = $data;
        $this->prevdata = $prevdata;
        $this->nextdata = $nextdata;
        //Cookie::set('_currentUrl_', __SELF__);
        session('_currentUrl_', __SELF__);
        $this->display(); 
    }
	
    //更改并获取点击数字，适用文章
    public function checkHits() {
        $name = $this->getActionName();
		$id = (int) $_GET['id'];
		$map['id'] = array('eq',$id);
		M($name)->where($map)->setInc('hits');
		$hits = M($name)->where($map)->getField('hits');
		echo "document.write(".$hits.")";
    }
	
    //更改点击数字，产品
    public function setHits() {
        $name = $this->getActionName();
		$id = (int) $_GET['id'];
		$map['id'] = array('eq',$id);
		M($name)->where($map)->setInc('hits');
    }
    
    
}