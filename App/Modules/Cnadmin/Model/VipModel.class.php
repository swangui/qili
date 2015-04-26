<?php
class VipModel extends CommonModel {
    // 自动填充设置
    protected $_auto=array(
		array('update_time','time',self::MODEL_UPDATE,'function'),
    );

}