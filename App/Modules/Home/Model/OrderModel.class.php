<?php
class OrderModel extends CommonModel {
	// 自动验证设置
	protected $_validate	 =	 array(
			array('shopname','require','请填写您的淘宝ID！'),
            array('name','require','请填写您的姓名！'),
			array('tel','require','请填写您的电话！'),
			array('qq','require','请填写您的QQ！'),
			array('verify','require','请填写验证码！'),
    );
	// 自动填充设置
	protected $_auto=array(
            array('ip','get_client_ip',self::MODEL_INSERT,'function'),
			array('create_time','time',self::MODEL_INSERT,'function'),
			array('update_time','time',self::MODEL_INSERT,'function'),
    );

}
?>