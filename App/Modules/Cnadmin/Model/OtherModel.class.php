<?php
class OtherModel extends CommonModel {
    // 自动验证设置
    protected $_validate =array(
        array('setname','require','名称必填！',1),
        array('settag','require','标签必填'),
        array('settag','','标签已经存在',0,'unique',self::MODEL_BOTH),
		array('setvalue','require','标签必填'),
    );

}