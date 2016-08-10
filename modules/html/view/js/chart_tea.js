// JavaScript Document
/**
author:Hao xiaoqiang
date:2014-05-14
*/
$(function () {
column_degree_tea()		//默认按学位 柱状图显示

});
function count(){
	var radioValue=$('input[name="charType"]:checked').val();  //1柱状 2趋势图 3饼状
	var radioValue2=$('input[name="charClass"]:checked').val(); //1学位 2职称 3研究方向 4男女比例
	if(radioValue=="1"&&radioValue2=="1"){
		column_degree_tea()   //按学位 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="3"){
		column_research_tea();		//按研究方向 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="4"){
		column_scale_tea();		//按男女比例 柱状图显示
	}
	if(radioValue=="1"&&radioValue2=="2"){
		column_work_tea();		//按职称 柱状图显示
	}

	if(radioValue=="2"&&radioValue2=="1"){
		line_degree_tea()   		//按学位 趋势图显示
	}
	if(radioValue=="2"&&radioValue2=="3"){
		line_research_tea()			//按研究方向   趋势图显示
	}
	if(radioValue=="2"&&radioValue2=="4"){
		line_scale_tea();		//按男女比例 趋势图显示
	}
	if(radioValue=="2"&&radioValue2=="2"){
		line_work_tea();		//按职称 趋势图显示
	}
	
	if(radioValue=="3"&&radioValue2=="1"){
		pie_degree_tea()   		//按学位 饼状图显示
	}
	if(radioValue=="3"&&radioValue2=="3"){
		pie_research_tea()			//按研究方向   饼状图显示
	}
	if(radioValue=="3"&&radioValue2=="4"){
		pie_scale_tea();		//按男女比例 饼状图显示
	}
	if(radioValue=="3"&&radioValue2=="2"){
		pie_work_tea();		//按职称 饼状图显示
	}
}

var title='教师图表统计';
//按学位 柱状图显示
function column_degree_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=degree_tea',function(data){
		var data=eval('('+data+')');
		var title='教师图表统计';
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].degree;
			source[i]=parseInt(data[i].count);			
			}	
		column_chart(title,data,xline,source);
		})	
	
	
}
//按学位 趋势图显示
function line_degree_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=degree_tea',function(data){
		var data=eval('('+data+')');
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].degree;
			source[i]=parseInt(data[i].count);			
			}	
		line_chart(title,data,xline,source);
		})	
}
//按学位 饼图显示
function pie_degree_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=degree_tea',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].degree+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})
	
}
//按职称 柱状图显示
function column_work_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=work_tea',function(data){
		var data=eval('('+data+')');
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].work;
			source[i]=parseInt(data[i].count);			
			}	
		column_chart(title,data,xline,source);
		})	
	
	
}
//按职称 趋势图显示
function line_work_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=work_tea',function(data){
		var data=eval('('+data+')');
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].work;
			source[i]=parseInt(data[i].count);			
			}	
		line_chart(title,data,xline,source);
		})	
}
//按职称 饼图显示
function pie_work_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=work_tea',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].work+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})
	
}
//按研究方向 柱状图显示
function column_research_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=research_tea',function(data){
		var data=eval('('+data+')');
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].research;
			source[i]=parseInt(data[i].count);			
			}	
		column_chart(title,data,xline,source);
		})	
	
	
}
//按研究方向 趋势图显示
function line_research_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=research_tea',function(data){
		var data=eval('('+data+')');
		var xline=[];
		var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].research;
			source[i]=parseInt(data[i].count);			
			}	
		line_chart(title,data,xline,source);
		})	
}
//按研究方向 饼图显示
function pie_research_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=research_tea',function(data){
		var data=eval('('+data+')');
		var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].research+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
		pie_chart(title,data,source);
		})
	
}
//按性别比例 柱状图显示
function column_scale_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=scale_tea',function(data){
		var data=eval('('+data+')');
		var xline=['男','女'];
		var source=[data.boy,data.girl];
		column_chart(title,data,xline,source);
		})	
	
	
}
//按性别比例 趋势图显示
function line_scale_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=scale_tea',function(data){
		var data=eval('('+data+')');
		var xline=['男','女'];
		var source=[data.boy,data.girl];
		line_chart(title,data,xline,source);
		})	
}
//按性别比例 饼图显示
function pie_scale_tea(){
	$.get('../../../php/action/page/chart/chart.act.php?action=scale_tea',function(data){
		var data=eval('('+data+')');
		var source=[['男',data.boy],['女',data.girl]];
		pie_chart(title,data,source);
		})
}






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
                    text: '人数'
                }
            },
            legend: {
                enabled: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        '数据: '+ Highcharts.numberFormat(this.y, 1);
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
}

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
                    text: '人数'
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
                name: '教师数据',
                data: source
            }]
        });	
}

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
