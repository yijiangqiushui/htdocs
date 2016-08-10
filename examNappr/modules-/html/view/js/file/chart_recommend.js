// JavaScript Document
/**
author:Zhao Xiaogang
date:2015-03-23
*/
$(function(){
	$.get('../../../../php/action/page/jdgPge.act.php',function(data){
		$('body').css('display','block');
		if(data=='super'){
				column_type_comm();		//默认按文件类型 柱状图显示
		}else{
			if(data.indexOf('file_report')<0){
				$('body').html('<h2>您没有操作权限!</h2>');			
			}
			else{
				column_type_comm();		//默认按文件类型 柱状图显示
			}
		}
	});				   						
	$.post('../../../../../center/php/action/page/ukeyOption.act.php?action=getUsr',function(result){
		if(result==2){
			var browser = DetectBrowser();
			if(browser == "Unknown")
			{
				alert("不支持该浏览器， 如果您在使用傲游或类似浏览器，请切换到IE模式");
				return ;
			}
			//createElementIA300() 对本页面加入IA300插件
		   
			createElementNT199();
			//DetectActiveX() 判断IA300Clinet是否安装
			var create = DetectNT199Plugin();
			if(create == false)
			{
				alert("插件未安装,,请直接安装CD区的插件!");
				return false;
			}
			self.setInterval("findNT199()",1000);
		}
	});
	$('#count-btn').css({'height':'30px'});
	$('#print-btn').css({'height':'30px'});
	$('#back-btn').css({'height':'30px'});
});

function backManage(){
	window.location.href='filemanage.html';
}

function count(){
	var radioValue=$('input[name="charType"]:checked').val();  //1柱状 2趋势图 3饼状
	var radioValue2=$('input[name="charClass"]:checked').val(); //1类型 2单位 3级别 4日期 
	if(radioValue=="1"&&radioValue2=="1"){
		column_type_comm();   //按类型 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="2"){
		column_dept_comm();		//按单位 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="3"){
		column_level_comm();   //按级别 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="4"){
		column_addedDate_comm();		//按日期 柱状图显示
	}
	
	if(radioValue=="2"&&radioValue2=="1"){
		line_type_comm();		//按类型 趋势图显示
	}	
	if(radioValue=="2"&&radioValue2=="2"){
		line_dept_comm();   		//按单位 趋势图显示
	}
	if(radioValue=="2"&&radioValue2=="3"){
		line_level_comm();		//按级别 趋势图显示
	}	
	if(radioValue=="2"&&radioValue2=="4"){
		line_addedDate_comm();   		//按日期 趋势图显示
	}
	
	if(radioValue=="3"&&radioValue2=="1"){
		pie_type_comm();			//按类型   饼图显示
	}
	if(radioValue=="3"&&radioValue2=="2"){
		pie_dept_comm();		//按单位 饼图显示
	}
	if(radioValue=="3"&&radioValue2=="3"){
		pie_level_comm();			//按级别   饼图显示
	}
	if(radioValue=="3"&&radioValue2=="4"){
		pie_addedDate_comm();		//按日期 饼图显示
	}
}


var title='制发文件统计';

//按类型 柱状图显示
function column_type_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=type_comm',function(data){
		var data=eval('('+data+')');		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].types;
			source[i]=parseInt(data[i].count);			
			}		
		column_chart(title,data,xline,source);
		})		
};

//按单位 柱状图显示
function column_dept_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=dept_comm',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].department;
			source[i]=parseInt(data[i].count);			
			}		
		column_chart(title,data,xline,source);
		})		
};
//按级别 柱状图显示
function column_level_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=level_comm',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].file_level;
			source[i]=parseInt(data[i].count);			
			}		
		column_chart(title,data,xline,source);
		})		
};
//按日期 柱状图显示
function column_addedDate_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=addedDate_comm',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].addedDate;
			source[i]=parseInt(data[i].count);			
			}		
		column_chart(title,data,xline,source);
		})		
};

/*-----------------------------------------------------------------------------------------------*/
//按类型 趋势图显示
function line_type_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=type_comm',function(data){
		var data=eval('('+data+')');		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].types;
			source[i]=parseInt(data[i].count);			
			}		
		line_chart(title,data,xline,source);
		})		
};
//按单位 趋势图显示
function line_dept_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=dept_comm',function(data){
		var data=eval('('+data+')');	
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].department;
			source[i]=parseInt(data[i].count);			
			}		
		line_chart(title,data,xline,source);
		})		
};
//按级别 趋势图显示
function line_level_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=level_comm',function(data){
		var data=eval('('+data+')');	
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].file_level;
			source[i]=parseInt(data[i].count);			
			}		
		line_chart(title,data,xline,source);
		})		
};
//按日期 趋势图显示
function line_addedDate_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=addedDate_comm',function(data){
		var data=eval('('+data+')');	
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].addedDate;
			source[i]=parseInt(data[i].count);			
			}		
		line_chart(title,data,xline,source);
		})		
};

/*-----------------------------------------------------------------------------------------------*/
//按类型 饼图显示
function pie_type_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=type_comm',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].types+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};
//按单位 饼图显示
function pie_dept_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=dept_comm',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].department+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};
//按级别 饼图显示
function pie_level_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=level_comm',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].file_level+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};
//按日期 饼图显示
function pie_addedDate_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=addedDate_comm',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].addedDate+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};

//柱状图	
function column_chart(title,data,xline,source){
	 new Highcharts.Chart({
            chart: { 
                renderTo: 'container',
                type: 'column',
                margin: [ 50, 50, 100, 80]
            },
            title: {
                text: title
            },
            xAxis: {
                categories: xline,
                labels: {
                    rotation: -45,
                    align: 'right',
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: '数量'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        '个数: '+ Highcharts.numberFormat(this.y, 1);
                }
            },
			credits: {  
  				enabled: false  //去掉LOGO
				}, 
            series: [{
                name: 'Population',
				data: source,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    x: -3,
                    y: 10,
                    formatter: function() {
                        return this.y;
                    },
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
};

//折线图
function line_chart(title,data,xline,source){
	chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'line'
            },
            title: {
                text: title
            },
            
            xAxis: {
                categories: xline
            },
            yAxis: {
                title: {
                    text: '数量'
                }
            },
            tooltip: {
                enabled: false,
                formatter: function() {
                   
                }
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
			credits: {  
  				enabled: false  
				},  

            series: [{
                name: '制文文件数据',
                data: source
            }]
        });	
};

//饼图
function pie_chart(title,data,source){
	new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text:title
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },
			credits: {  
  				enabled: false  
				}, 
            series: [{
                type: 'pie',
                data: source
            }]
        });
};
//打印统计
function print_pic(){
	$('#container').printArea();
}