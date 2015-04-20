<?php
//import('TagLib');
class TagLibKaifu extends TagLib {
   //标签定义
   protected $tags=array(
       'category'=>array('attr'=>'catid,result,order','level'=>1),
       'content'=>array('attr'=>'catid,result','level'=>1),
       'article'=>array('attr'=>'catid,field,order,num,result','level'=>1),
	   'product'=>array('attr'=>'catid,field,order,num,result','level'=>1),
       'other'=>array('attr'=>'settag,result','close'=>0),
       'set'=>array('attr'=>'settag,result','close'=>0),
       'slide'=>array('attr'=>'catid,field,order,num,result','level'=>1),
	   'link'=>array('attr'=>'field,order,result','level'=>1),
   );
    //定义查询数据库标签
   public function _category($attr,$content) {
        $tag=$this->parseXmlAttr($attr, 'category');
       
        $result= !empty($tag['result'])?$tag['result']: 'category';

        $catlist = D('Category')->where('status=1')->select();	
        
        $idlist = arrToTree($catlist,$tag['catid']);  
        $idlist= substr($idlist, 0, strlen($idlist)-1);

        $map.="'status=1";
        $map.=($tag['catid'])?" and id in ($idlist)'":"'";

        $sql ='D(\'Category\')->where('.$map.')->field("*,concat(path,\'-\',id) as bpath")->order(\'bpath\')->select()';
        
        //下面拼接输出语句
        $parsestr  = '<?php $_list='.$sql.';';
        $parsestr .= 'foreach($_list as $key=>$value):';
        $parsestr .= '$_list[$key][\'count\']=count(explode(\'-\',$value[\'bpath\']));';
        $parsestr .= 'endforeach;';
        $parsestr .= '$_result=$_list;';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;?>';
        return  $parsestr;

   }
   //定义查询数据库标签
   public function _content($attr,$content) {
        $tag=$this->parseXmlAttr($attr, 'content');
       
        $result= !empty($tag['result'])?$tag['result']: 'content';
        
        $map.="'status=1";
        $map.=($tag['catid'])?" and id={$tag['catid']}'":"'";
        
        $sql ="M('Category')->";
        $sql.="where({$map})->";
        $sql.="find()";

        //下面拼接输出语句
        $parsestr  = '<?php $'.$result.'=$_result='.$sql.';?>';
        $parsestr .= $content;//解析在article标签中的内容
        return  $parsestr;

   }
   //定义查询数据库标签
   public function _article($attr,$content) {
        $tag=$this->parseXmlAttr($attr, 'article');
       
        $result= !empty($tag['result'])?$tag['result']: 'article';
        
        $catlist = D('Category')->where('status=1')->select();	
        $idlist = $tag['catid'].','.arrToTree($catlist,$tag['catid']);  
        $idlist= substr($idlist, 0, strlen($idlist)-1);
        
        $map=($tag['catid'])?"'catid in ($idlist)'":"";
        
        $sql ="M('Article')->";
        $sql.="where({$map})->";
        $sql.=($tag['field'])?"field('{$tag['field']}')->":"";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"";
        $sql.=($tag['num'])?"limit({$tag['num']})->":"";
        $sql.="select()";

        //下面拼接输出语句
        $parsestr  = '<?php $_result='.$sql.';';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;?>';
        return  $parsestr;

   }
   
   //定义查询数据库标签
   public function _product($attr,$content) {
        $tag=$this->parseXmlAttr($attr, 'product');
       
        $result= !empty($tag['result'])?$tag['result']: 'product';
        
        $catlist = D('Category')->where('status=1')->select();	
        $idlist = $tag['catid'].','.arrToTree($catlist,$tag['catid']);  
        $idlist= substr($idlist, 0, strlen($idlist)-1);     

        $map=($tag['catid'])?"'catid in ($idlist)'":"";
        
        $sql ="M('Product')->";
        $sql.="where({$map})->";
        $sql.=($tag['field'])?"field('{$tag['field']}')->":"";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"";
        $sql.=($tag['num'])?"limit({$tag['num']})->":"";
        $sql.="select()";

        //下面拼接输出语句
        $parsestr  = '<?php $_result='.$sql.';';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;?>';
        return  $parsestr;

   }
  
   //扩展-定义查询数据库标签
   public function _other($attr) {

        $tag=$this->parseXmlAttr($attr, 'other');
       
        $result= !empty($tag['result'])?$tag['result']: 'other';

        $map=($tag['settag'])?"settag=\"{$tag['settag']}\" and ifshow=1":"";
        
        $sql ="M('Other')->";
        $sql.="where('{$map}')->";
        $sql.="find()";

        //下面拼接输出语句
        $parsestr  = '<?php $'.$result.'=$_result='.$sql.'; echo $'.$result.'[\'setvalue\'];?>';
        //$parsestr .= $content;//解析在article标签中的内容
        return  $parsestr;

   }

   //定义查询数据库标签
   public function _set($attr) {

        $tag=$this->parseXmlAttr($attr, 'set');
       
        $result= !empty($tag['result'])?$tag['result']: 'set';

//        $map.=($tag['settag'])?"settag=\"{$tag['settag']}\"":"'";
        $Field=($tag['settag'])?"{$tag['settag']}":"id";
        
        $sql ="M('Set')->";
        $sql.="getField('{$Field}',1)";
        //下面拼接输出语句
        $parsestr  = '<?php $'.$result.'=$_result='.$sql.'; echo $'.$result.';?>';
        //$parsestr .= $content;//解析在article标签中的内容
        return  $parsestr;

   }
   
   //幻灯片-定义查询数据库标签
   public function _slide($attr,$content) {
        $tag=$this->parseXmlAttr($attr, 'slide');
       
        $result= !empty($tag['result'])?$tag['result']: 'slide';
		
		$map=($tag['catid'])?"'catid={$tag['catid']}'":"'catid=0'";

        $sql ="M('Slide')->";
		$sql.="where({$map})->";
        $sql.=($tag['field'])?"field('{$tag['field']}')->":"";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"";
        $sql.=($tag['num'])?"limit({$tag['num']})->":"";
        $sql.="select()";

        //下面拼接输出语句
        $parsestr  = '<?php $_result='.$sql.';';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;?>';
        return  $parsestr;

   }
  
     //友情链接-定义查询数据库标签
    public function _link($attr,$content) {
        $tag=$this->parseXmlAttr($attr, 'slide');     
        $result= !empty($tag['result'])?$tag['result']: 'link';

        $sql ="M('Link')->";
        $sql.=($tag['field'])?"field('{$tag['field']}')->":"";
        $sql.=($tag['order'])?"order('{$tag['order']}')->":"";
        $sql.="select()";

        //下面拼接输出语句
        $parsestr  = '<?php $_result='.$sql.';';
        $parsestr .= 'foreach($_result as $key=>$'.$result.'):?>';
        $parsestr .= $content;//解析在article标签中的内容
        $parsestr .= '<?php endforeach;?>';
        return  $parsestr;
    }
}

?>
