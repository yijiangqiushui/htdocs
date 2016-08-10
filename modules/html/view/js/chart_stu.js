// JavaScript Document
/**
author:Hao xiaoqiang
date:2014-05-14
*/
$(function () {
column_edu_stu()		//默认按教育程度 柱状图显示

});
function count(){
	var radioValue=$('input[name="charType"]:checked').val();  //1教育程度 2年龄段 3男女比例
	var radioValue2=$('input[name="charClass"]:checked').val(); //1柱状 2趋势 3饼状
	if(radioValue=="1"&&radioValue2=="1"){
		column_edu_stu()   //按教育程度 柱状图显示
	}
	if(radioValue=="2"&&radioValue2=="1"){
		column_age_stu();		//按年龄段 柱状图显示
	}
	if(radioValue=="3"&&radioValue2=="1"){
		column_scale_stu();		//按男女比例 柱状图显示
	}

	if(radioValue=="1"&&radioValue2=="2"){
		line_edu_stu()   		//按教育程度 趋势图显示
	}
	if(radioValue=="2"&&radioValue2=="2"){
		line_age_stu()			//按年龄段   趋势图显示
	}
	if(radioValue=="3"&&radioValue2=="2"){
		line_scale_stu();		//按男女比例 趋势图显示
	}
	
	if(radioValue=="1"&&radioValue2=="3"){
		pie_edu_stu()   		//按教育程度 饼状图显示
	}
	if(radioValue=="2"&&radioValue2=="3"){
		pie_age_stu()			//按年龄段   饼状图显示
	}
	if(radioValue=="3"&&radioValue2=="3"){
		pie_scale_stu();		//按男女比例 饼状图显示
	}
}



//各个教育程度的人数(柱状图显示)
function column_edu_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=edu_stu',function(data){
	var data=eval('('+data+')');	
	var title='教育程度';
	var xline=[];
	var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].age;
			source[i]=parseInt(data[i].count);			
			}	
	column_chart(title,data,xline,source)
	});
}
//各个教育程度的人数(趋势图显示)
function line_edu_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=edu_stu',function(data){
	var data=eval('('+data+')');	
	var title='教育程度';
	var xline=[];
	var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].age;
			source[i]=parseInt(data[i].count);			
			}	
	line_chart(title,data,xline,source)
	});
}	
//各个教育程度的人数（饼图显示）
function pie_edu_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=edu_stu',function(data){
	var data=eval('('+data+')');	
	var title='教育程度';
	var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].age+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		alert(source);
		source=eval('('+source+')');
	pie_chart(title,data,source)
	});
}
//各个年龄段的人数(柱状图)
function column_age_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=age_stu',function(data){
	var data=eval('('+data+')');	
	var title='各个年龄段';
	var xline=[];
	var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].age;
			source[i]=parseInt(data[i].count);			
			}	
	alert(xline);		
	alert(source);
	column_chart(title,data,xline,source)
	});
}
//各个年龄段的人数(趋势图)
function line_age_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=age_stu',function(data){
	var data=eval('('+data+')');	
	var title='各个年龄段';
	var xline=[];
	var source=[];
		for(var i=0;i<data.length;i++){
			xline[i]=data[i].age;
			source[i]=parseInt(data[i].count);			
			}	line_chart(title,data,xline,source)
	});
}
// 各个年龄段的人数(饼图)
function pie_age_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=age_stu',function(data){
	var data=eval('('+data+')');	
	var title='各个年龄段';
	var source='[';		
		for(var i=0;i<data.length;i++){
			source=source+'["'+data[i].age+'",'+parseInt(data[i].count)+'],'
		}		
		source=source.substr(0,source.length-1);
		source=source+']';
		source=eval('('+source+')');
	pie_chart(title,data,source)
	});
}
//男女学生比例(柱状图)
function column_scale_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=scale_stu',function(data){
		var data=eval('('+data+')');
		var title='男女学生比例';
		var xline=['男','女'];
		var source=[data.boy,data.girl];
		column_chart(title,data,xline,source)
		
	});
}
//男女学生比例(趋势图)
function line_scale_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=scale_stu',function(data){
		var data=eval('('+data+')');
		var title='男女学生比例';
		var xline=['男','女'];
		var source=[data.boy,data.girl];
		line_chart(title,data,xline,source)
		
	});
}
//男女学生比例(饼图)
function pie_scale_stu(){
	$.get('../../../php/action/page/chart/chart.act.php?action=scale_stu',function(data){
		var data=eval('('+data+')');
		var title='男女学生比例';
		var source=[['男',data.boy],['女',data.girl]];
		pie_chart(title,data,source);
	});
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
//趋势图
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
                name: '学生数据',
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
