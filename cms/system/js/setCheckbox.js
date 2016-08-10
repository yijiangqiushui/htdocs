<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
* 设置选项状态
**/
function setCheckbox(state){
	var $oCheckbox=document.myForm.itemArr;
	var $arrLen=$oCheckbox.length;
	if($arrLen){
		for(var i=0;i<$oCheckbox.length;i++){
			if(!$oCheckbox[i].disabled)
				if(state<0){
					$oCheckbox[i].checked=!$oCheckbox[i].checked;
				}
				else
					$oCheckbox[i].checked=state;
		}
	}
	else{
		if(state<0)
			$oCheckbox.checked=!$oCheckbox.checked;
		else
			$oCheckbox.checked=state;
	}
}

//-->