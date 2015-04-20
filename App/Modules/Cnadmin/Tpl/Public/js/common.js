$(function(){
    //全选/取消
    $("#check").click(function(){
		if($(this).attr("checked")=="checked"){
            $('input[name=key]').attr("checked","checked");
        }else{
            $('input[name=key]').removeAttr ("checked");
        }
    });   
});
function cleara(str){ //删除左右两端的空格
    return str.replace(/&a=.*/g, "");
}
//删除左右两端的空格
function trim(str){ 
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
//添加
function add(id){  
    if (id){
        location.href  = cleara(SELF)+"&a=add&catid="+id;
    }else{
        location.href  = cleara(SELF)+"&a=add";
    }
}

//批量删除，通用
function foreverdel(id){
    var keyValue;
    if (id){
        keyValue = id;
    }else {
        keyValue = getSelectCheckboxValues();
    }

    if (!keyValue){
        $(".modal-body").html('请选择删除项！');
		$('#myModal').modal("show")
        return false;
    }
    // 删除
    location.href =  cleara(SELF)+"&a=foreverdelete&id="+keyValue;

}
// 获取选择项
function getSelectCheckboxValues(){
	var obj = document.getElementsByName('key');
	var result ='';
	var j= 0;
	for (var i=0;i<obj.length;i++){
            if (obj[i].checked===true){
//                selectRowIndex[j] = i+1;
                result += obj[i].value+",";
                j++;
            }
	}
	return result.substring(0, result.length-1);
}