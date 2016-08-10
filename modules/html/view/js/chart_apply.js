// JavaScript Document
/**
author:Hao xiaoqiang
date:2014-06-09
*/
$(function(){
	column_address_app();		//默认按类型 柱状图显示
});
function count(){
	var radioValue=$('input[name="charType"]:checked').val();  //1柱状 2趋势图 3饼状
	var radioValue2=$('input[name="charClass"]:checked').val(); //1地域 
	if(radioValue=="1"&&radioValue2=="1"){
		column_address_app();   //按地域 柱状图显示
	}
	if(radioValue=="2"&&radioValue2=="1"){
		line_address_app();		//按地域 趋势图显示
	}
	
	if(radioValue=="3"&&radioValue2=="1"){
		pie_address_app();		//按地域  饼图显示
	}	
	
}


var title='申报单位统计';


//按地域 柱状图显示
function column_address_app(){
	$.get('../../../php/action/page/chart/chart.act.php?action=address_app',function(data){
		var data=eval('('+data+')');
		
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].address;
			source[i]=parseInt(data[i].count);			
			}		
		column_chart(title,data,xline,source);
		})		
};

//按地域 趋势图显示
function line_address_app(){
	$.get('../../../php/action/page/chart/chart.act.php?action=address_app',function(data){
		var data=eval('('+data+')');	
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].address;
			source[i]=parseInt(data[i].count);			
			}		
		line_chart(title,data,xline,source);
		})		
};

//按地域 饼图显示
function pie_address_app(){
	$.get('../../../php/action/page/chart/chart.act.php?action=address_app',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].address+'",'+parseInt(data[i].count)+'],'
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
                name: '申报单位数据',
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
                    return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
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
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage +' %';
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
