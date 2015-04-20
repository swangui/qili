<?php
// 用户模型
class UserModel extends CommonModel {
	public $_validate=array(
		array('account','/^[a-z]\w{3,}$/i','帐号格式错误'),
		array('password','require','请填写您的密码！'),
		array('nickname','require','请填写您的昵称！'),
		array('repassword','require','请再次确认密码！'),
		array('repassword','password','两次输入的密码不一致！',self::EXISTS_VALIDATE,'confirm'),
		array('account','','帐号已经存在',self::EXISTS_VALIDATE,'unique',self::MODEL_INSERT),
		);

	public $_auto=array(
		array('password','pwdHash',self::MODEL_BOTH,'callback'),
		array('create_time','time',self::MODEL_INSERT,'function'),
		array('update_time','time',self::MODEL_UPDATE,'function'),
		);

	protected function pwdHash() {
		if(isset($_POST['password'])) {
			return pwdHash($_POST['password']);
		}else{
			return false;
		}
	}
}