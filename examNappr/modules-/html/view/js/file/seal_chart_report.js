// JavaScript Document
/**
author:Hao xiaoqiang
date:2014-06-09
Modify by: Ma Jun wei
date:2015-03-19
*/
$(function(){
	$('body').css('display','none');
		$.get('../../../../php/action/page/jdgPge.act.php',function(data){
			if(data=='super'){
				$('body').css('display','block');
				column_type_comm();
			}else{
				if(data.indexOf('seal_report')<0){
					$('body').html('<h2>您没有操作权限</h2>');
					$('body').css('display','block');
				}else{
					$('body').css('display','block');
					column_type_comm();
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
	//column_type_comm();		//默认按文件类型 柱状图显示
	$('#count-btn').css({'height':'30px'});
	$('#print-btn').css({'height':'30px'});
	$('#back-btn').css({'height':'30px'});
});

function backManage(){
	window.location.href='sealmanage.html';
}

function count(){
	var radioValue=$('input[name="charType"]:checked').val();  //1柱状  3饼状
	var radioValue2=$('input[name="charClass"]:checked').val(); //1用章部门 2用章内容 3用章时间 4是否借出 
	if(radioValue=="1"&&radioValue2=="1"){
		column_type_comm();   //按用章部门 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="2"){
		column_dept_comm();		//按用章内容 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="3"){
		column_level_comm();   //按用章时间 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="4"){
		column_addedDate_comm();		//按是否借出 柱状图显示
	}	
	if(radioValue=="3"&&radioValue2=="1"){
		pie_type_comm();			//按用章部门   饼图显示
	}
	if(radioValue=="3"&&radioValue2=="2"){
		pie_dept_comm();		//按用章内容 饼图显示
	}
	if(radioValue=="3"&&radioValue2=="3"){
		pie_level_comm();			//按用章时间   饼图显示
	}
	if(radioValue=="3"&&radioValue2=="4"){
		pie_addedDate_comm();		//按是否借出 饼图显示
	}
}


var title='印章使用申请统计';

//按用章部门 柱状图显示
function column_type_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getDeptDataTotal',function(data){
		var data=eval('('+data+')');		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].cat_name;
			source[i]=parseInt(data[i].total);			
			}		
		column_chart(title,data,xline,source);
		})		
};

//按用章内容 柱状图显示
function column_dept_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getConDataTotal',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].content;
			source[i]=parseInt(data[i].total);			
			}		
		column_chart(title,data,xline,source);
		})		
};
//按用章时间 柱状图显示
function column_level_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getUseTimeDataTotal',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].use_time;
			source[i]=parseInt(data[i].total);			
			}		
		column_chart(title,data,xline,source);
		})		
};
//按是否借出 柱状图显示
function column_addedDate_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getBorrowDataTotal',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].way;
			source[i]=parseInt(data[i].total);			
			}		
		column_chart(title,data,xline,source);
		})		
};

/*-----------------------------------------------------------------------------------------------*/
//按用章部门 饼图显示
function pie_type_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getDeptDataTotal',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].cat_name+'",'+parseInt(data[i].total)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};
//按用章内容 饼图显示
function pie_dept_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getConDataTotal',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].content+'",'+parseInt(data[i].total)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};
//按用章时间 饼图显示
function pie_level_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getUseTimeDataTotal',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].use_time+'",'+parseInt(data[i].total)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})		
};
//按是否借出 饼图显示
function pie_addedDate_comm(){
	$.get('../../../../php/action/page/file/chart.act.php?action=getBorrowDataTotal',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].way+'",'+parseInt(data[i].total)+'],'
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