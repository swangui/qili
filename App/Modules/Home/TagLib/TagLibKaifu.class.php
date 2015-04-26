<?php
//import('TagLib');
class TagLibKaifu extends TagLib {
   //标签定义
   protected $tags=array(
       'other'=>array('attr'=>'settag,result','close'=>0),
       'set'=>array('attr'=>'settag,result','close'=>0),
   );
  
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
}

?>
