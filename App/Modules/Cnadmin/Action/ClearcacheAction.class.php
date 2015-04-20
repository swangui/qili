<?php

class ClearcacheAction extends CommonAction {
    public function index() {
        //清除缓存
        clearCache();
        $this->home = "前台";
        $this->admin = "后台";
        $this->display();
    }
    
}
