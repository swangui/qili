<?php

class OrderAction extends CommonAction{
public function insert() {
        
		$this->seo("页面提示信息", C(SITE_KEYWORDS), C(SITE_DESCRIPTION));
		
		$arrayToJs = array();
		if($_SESSION['verify'] != md5(strtolower($_POST['verify']))) {
	        $arrayToJs[0] = false;
			$arrayToJs[1] = '验证码错误，请重新输入验证码';
	        echo json_encode($arrayToJs);	
			return;
        }

		// 过滤数据
		$_POST['shopname'] = $this->normalization($_POST['shopname']);
		$_POST['name'] = $this->normalization($_POST['name']);
		$_POST['tel'] = $this->normalization($_POST['tel']);
		$_POST['qq'] = $this->normalization($_POST['qq']);
		$_POST['content'] = $this->normalization($_POST['content']);
		
		$name = $this->getActionName();
		$model = D($name);
		
		if(false !== $model->create()) {
			if(false !== $model->add()) {
				
				// 获取商品id
				$data3['orderid'] = mysql_insert_id();
				// 添加订单商品信息
				$model = D('Orderlist');
				$data['orderid'] = $_POST['orderid'];
				$data['order_name'] = $_POST['order_name'];
				$data['order_num'] = $_POST['order_num'];
		
				foreach($data as $key=>$value){
				   foreach($value as $key2=>$value2){
					  $data2[$key2][$key] = $this->normalization($value2);
				   }
				}
				foreach($data2 as $key=>$value){
					foreach($value as $key2=>$value2){
					  $data3[$key2] = $value2;
					}
					if(false == $model->add($data3)){
					    $arrayToJs[0] = false;
						$arrayToJs[1] = $model->getError();
						echo json_encode($arrayToJs);	
						return;
					}
				}
				
			    $arrayToJs[0] = false;
			    $arrayToJs[1] = 'ok';
			    echo json_encode($arrayToJs);	
			    return;
			}else{
				$arrayToJs[0] = false;
				$arrayToJs[1] = '提交失败，请联系网站管理员！';
				echo json_encode($arrayToJs);	
				return;
			}
		}else{
		    $arrayToJs[0] = false;
			$arrayToJs[1] = $model->getError();
			echo json_encode($arrayToJs);	
			return;
		}
    }
	
	// 过滤数据
    public function normalization($string)
	{
		$replace=array(
		'<'  => '&lt;',
		'>'  => '&gt;',  
		"'"  => '&#039;',
		'"'  => '&quot;',
		' '  => '&nbsp;',
		);
		$string = strtr($string,$replace);
		return $string;
	}

}
