<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

document.onreadystatechange =function(){
	for(var tableNo=0;tableNo<3;tableNo++){
		if(document.getElementById("table_showData_"+tableNo)){
			var oTable=document.getElementById("table_showData_"+tableNo);//注意名称
			var oTBody=oTable.getElementsByTagName("tbody");
			var oTBodyTr=oTBody[0].getElementsByTagName("tr");
			
			var oTBodyA;
			for(var i=0;i<oTBodyTr.length;i++){
				oTBodyTr[i].onmouseover=function(){
					this.className="td_mouseover";
					oTBodyA=this.getElementsByTagName("a");
					for(var j=0;j<oTBodyA.length;j++){
						oTBodyA[j].style.color="#FFF";
					}
				}
				oTBodyTr[i].onmouseout=function(){
					this.className="td_mouseout";
					oTBodyA=this.getElementsByTagName("a");
					for(var j=0;j<oTBodyA.length;j++){
						oTBodyA[j].style.color="#000";
					}
				}
			}
		}
	}
}

//-->

