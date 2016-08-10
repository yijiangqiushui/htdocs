<!--
/************************************************************************************************************
#	PHP Version 1.2   MySQL  JavaScript
#	Copyright (c) 2009 http://www.cnalog.com
#	Author: Li Zhixiao <English Name: Hawking E-mail:lzxbit2008@yahoo.com.cn QQ:578731186>
#	Date: 2009/10/10
************************************************************************************************************/

/**
*身份证验证函数
*checkIdcard(IDNO)start   
*入口参数：IDNO:身份证号码字符串。   
*返回值：false:失败，身份证号码错误。   
* true:成功，身份证号码正确。   
*作用：判断身份证号码是否符合规则。
*！声明：该函数非原创
**/   
function checkIdcard(IDNO){
	var   iSum=0;   
	var aCity={11:"北京",12:"天津",13:"河北",14:"山西",15:"内蒙古",21:"辽宁",22:"吉林",23:"黑龙江",31:"上海",32:"江苏",33:"浙江",34:"安徽",35:"福建",36:"江西",37:"山东",41:"河南",42:"湖北",43:"湖南",44:"广东",45:"广西",46:"海南",50:"重庆",51:"四川",52:"贵州",53:"云南",54:"西藏",61:"陕西",62:"甘肃",63:"青海",64:"宁夏",65:"新疆",71:"台湾",81:"香港",82:"澳门",91:"国外"};   
	if(IDNO.length==15){
		if(!/^\d{15}$/i.test(IDNO)){
			return false;
		}
		sBirthday=IDNO.substr(6,2)+"-"+Number(IDNO.substr(8,2))+"-"+Number(IDNO.substr(10,2));
	}   
	else{
		if(!/^\d{17}(\d|x)$/i.test(IDNO)){
			return false;
		}
		IDNO=IDNO.replace(/x$/i,"a");
		sBirthday=IDNO.substr(6,4)+"-"+Number(IDNO.substr(10,2))+"-"+Number(IDNO.substr(12,2));   
		for(var i=17;i>=0;i--)
			iSum+=(Math.pow(2,i)%11)*parseInt(IDNO.charAt(17-i),11);   
		if(iSum%11!=1){
			return false;
		}   
	}   
	if(aCity[parseInt(IDNO.substr(0,2))]==null){
		return false;
	}   
	var d=new Date(sBirthday.replace(/-/g,"/"))   
	if(sBirthday!=(d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate())){
		return false;
	}
	return true;
}   
//checkIdcard(IDNO)   end

/**
* 验证用户名中是否含有特殊字符：只能包含汉字，英文，数字，下划线
* 正则：/^([\u4E00-\u9FA5]|[\uFE30-\uFFA0]|[_\a-zA-Z]|[\s])*$/gi,第一部分：汉字 第二部分：半角 第三部分：数字和英文
**/
function isUserName(str){
	var Expression=/^([\u4E00-\u9FA5]|[\uFE30-\uFFA0]|[_\a-zA-Z0-9]|[\s])*$/gi;   
	var objExp=new RegExp(Expression);
	if(objExp.test(str)){
		return true;
	}
	return false;
}

/**
* 验证E-MAIL格式,0表示正确 1表示长度过大 2表示不合法
**/
function isNotEmail(str){
	if (str.length>50){
		return 1;
	}
	//格式字符串
	 var regu = "^(([_0-9a-zA-Z]+)|([0-9a-zA-Z]+[_.0-9a-zA-Z-]*[0-9a-zA-Z]+))@([a-zA-Z0-9-]+[.])+([a-zA-Z]{2}|net|NET|com|COM|gov|GOV|mil|MIL|org|ORG|edu|EDU|int|INT)$";
	 var re = new RegExp(regu);
	 if(str.search(re) != -1){
		return 0;
	 } 
	 else{
		return 2;
	 }
}

/**
* 验证网址格式
**/
/*function checkURL(urlVal){
	if(/^http://([\w-]+\.)+[\w-]+(/[\w-./?%&=]*)?.exec(urlVal)==null){   
		return false;
	}
	return true;
}*/

/**
* 验证邮政编码
**/
function isPostalcode(str){
	if(isDigit(str)){
		if(str.length==6)
			return true;
		else
			return false;
	}
	return false;
}

/**
* 验证手机号码
**/
function isMobile(str){
	var Expression=/^(130|131|133|134|135|137|138|139|159|158|153)(\d){8}$/; 
	var objExp=new RegExp(Expression);
	if(objExp.test(str)){
		return true;
	}
	return false;
}

/**
* 验证手机号码
**/
function isPhone(str){
//全国通用：	var Expression=/(\d{3}-)(\d{8})$|(\d{4}-)(\d{7})$/;
	var Expression=/(\d{8})$/;//北京通用
	var objExp=new RegExp(Expression);
	if(objExp.test(str)){
		return true;
	}
	return false;
}

/**
* 验证日期格式
**/
function isDate(dateVal){
    arr = dateVal.split("-");
    if(arr.length==3){
        intYear=parseInt(arr[0],10);
        intMonth=parseInt(arr[1],10);
        intDay=parseInt(arr[2],10);
        if(isNaN(intYear) || isNaN(intMonth) || isNaN(intDay)){
            return false;
        }
        if(intYear>2100 || intYear<1900 || intMonth>12 || intMonth<0 || intDay>31 || intDay<0){
            return false;
        }
        if((intMonth==4 || intMonth==6 || intMonth==9 || intMonth==11) && intDay>30){
            return false;
        }
		if(intMonth==2){
			if(intYear%400==0 || (intYear%100!=0 && intYear%4==0)){
				if(intDay>29)
					return false;
			}
			else{
				if(intDay>28)
					return false;
			}
		}
		return true;
    }
	return false;
} 

/**
* 判断是否数字
**/
function isDigit(getVal){
	if(!getVal)
		return false;
	var strP=/^\d+(\.\d+)?$/;
	if(!strP.test(getVal))
		return false;
	try{
		if(parseFloat(getVal)!=getVal)
			return false;
	}
	catch(ex){
		return false;
	}
	return true;
}
/**
* 验证用户名是否合
**/
function isValidUsrName(str){
	var re=/^[0-9a-z][\w-.]*[0-9a-z]$/i;
	if(re.test(str))
		return true;
	else
		return false;
}

//-->