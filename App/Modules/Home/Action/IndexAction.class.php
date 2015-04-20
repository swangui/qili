<?php

class IndexAction extends CommonAction {
    public function _before_index(){
	    // 品牌列表
		$partners = D('Partners')->where("catid = 7")->order('listorder DESC,id DESC')->limit(20)->select();
		$this->partners = $partners;
	}
}