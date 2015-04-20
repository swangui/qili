<?php
class VipModel extends CommonModel {
    // 自动填充设置
    protected $_auto=array(
        array('ifshow',1,self::MODEL_UPDATE),
		array('update_time','time',self::MODEL_UPDATE,'function'),
    );

}