		//贺央央

		var url;
        var teacherId;
		var pridge;

		window.onresize=function(){		
			$('#grid').datagrid('resize',{
				width:$('#body').width()
			});
		
		}
	
		$(function() {
	        $('body').css('display','none');
			$.get('../../../php/action/page/jdgPge.act.php',function(data){
				pridge=data;
				$('body').css('display','block');
				if(data=='super'){
					loadPage();
				}else{
					if(data.indexOf('tea_query')<0){
						$('body').html('<h2>您没有操作权限</h2>');
						
					}else{
						if(data.indexOf('tea_del')<0){
								$("a[onclick='destroyTeacherlist()']").css('display','none');			
						}
						if(data.indexOf('tea_add')<0){
								$("a[onclick='newTeacher()']").css('display','none');			
						}
						loadPage();
					}	
				}
			});
	       
			
	    });
		
		function loadPage(){
			
			$('#grid').datagrid({
	       		title:'教师信息',
				//height:250,
	            nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	            striped : true,//设置为true将交替显示行背景。
	            collapsible : false,//显示可折叠按钮
				singleSelect:true,//为true时只能选择单行
				fitColumns:true,//允许表格自动缩放，以适应父容器
	            rownumbers : true,//行数
				pagination:true,//分页
				pageSize: 15,  
				pageList: [5,10,15,20,30], 
				checkOnSelect:false,
				selectOnCheck:false, 
				
			    remoteSort : false,
				toolbar:'#toolbar',
			   
	            url:'../../../php/action/page/teacher/tea.act.php?action=query',//url调用Action方法
	            loadMsg : '数据装载中......',
	            //sortName : 'xh',//当数据表格初始化时以哪一列来排序
	            //sortOrder : 'desc',//定义排序顺序，可以是'asc'或者'desc'（正序或者倒序）。
	          	columns:[[
				
					{field:'id',title:'id',checkbox:true},
					
					{field:'name',title:'姓名',width:100},
					{field:'sex',title:'性别',width:50},
					{field:'birth',title:'生日',width:100},
					{field:'age',title:'年龄',width:100},
					{field:'tel',title:'电话',width:150},
					{field:'email',title:'邮箱',width:200},
					{field:'degree',title:'学位',width:100},
					{field:'work',title:'职称',width:100},
					{field:'office',title:'就职单位',width:100},
					{field:'research',title:'研究方向',width:100},
					{field:'action',title:'操作',width:300,align:'center',
						formatter:function(value,row,index){
							var a='<a href="javascript:void(0)" onclick="editTeacher('+row.id+')" class="tea_edit">编辑</a>';
							var b='|'+'<a href="javascript:void(0)" onclick="destroyTeacher('+row.id+','+index+')" class="tea_del"> 删除</a>';
							var c='|'+'<a href="javascript:void(0)" onclick="showEduInfo('+row.id+')" class="tea_edu"> 教育经历</a>';
							var d='|'+'<a href="javascript:void(0)" onclick="showHorInfo('+row.id+')" class="tea_hor"> 曾获荣誉</a>';
							var e='|'+'<a href="javascript:void(0)" onclick="showComInfo('+row.id+')" class="tea_com"> 指导竞赛情况</a>';
							var rn='';
							if(pridge=='super'){
								rn=a+b+c+d+e;
							}else{
								if(pridge.indexOf('tea_edit')>=0){
									rn+=a;
								}
								if(pridge.indexOf('tea_del')>=0){
									rn+=b;
								}
								if(pridge.indexOf('tea_edu')>=0){
									rn+=c;
								}
								if(pridge.indexOf('tea_hor')>=0){
									rn+=d;
								}
								if(pridge.indexOf('tea_com')>=0){
									rn+=e;
								}
							}
							return rn;	
						}
					}							
				]]
	        });
			
			var p = $('#grid').datagrid('getPager');  
			$(p).pagination({  
				pageSize: 15,  
				pageList: [5,10,15,20,30],  
				beforePageText: '第', 
				afterPageText: '页    共 {pages} 页',  
				displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
			});   	
		}
		
		//查询教师信息
		function selectTeacher(){
			$('#show').dialog('open').dialog('setTitle','查询条件');	
			$('#show-form').form('clear');
			
		}
		function showSelectTeacher(){
		
			if(($('#search_degree').combobox('getValue')=='')&&($('#search_name').val()=='')){
				$('#show').dialog('close');
			}else{ 
			
				
				 $('#show-form').form('submit',{
					url:'../../../php/action/page/teacher/tea.act.php?action=query',
					onSubmit: function(){
					
					},
					success: function(result){
					
						$('#show').dialog('close'); 
						
						$('#grid').datagrid('load',{
							'degree':$('#search_degree').combobox('getValue'),
							'name':$('#search_name').val()	
						});
						
					}
				});	
			
			}
			
		}
	
		//显示所有教师信息
		function loadTeacher(){			
			location.reload();				
		}
		
		//添加教师信息
        function newTeacher(){
            $('#dlg').dialog('open').dialog('setTitle','添加教师信息');
            $('#fm').form('clear');
			url = '../../../php/action/page/teacher/tea.act.php?action=add';
        }
		//修改教师信息
        function editTeacher(a){
			
			$.get( '../../../php/action/page/teacher/tea.act.php?action=findbyid&id='+a,function(data){
			
				var res=eval("("+data+")");				
            	$('#dlg').dialog('open').dialog('setTitle','修改教师信息');
                $('#fm').form('load',res);
				
                url = '../../../php/action/page/teacher/tea.act.php?action=update&id='+a;
						                     
          });
        }
		
		function saveTeacher(){
            $('#fm').form('submit',{
                url:url,
                onSubmit: function(){
                },
                success: function(result){
					$('#dlg').dialog('close');        
                    $('#grid').datagrid('reload');	
                }
            });
        }
				
		//删除教师信息
        function destroyTeacher(id,index){
                $.messager.confirm('提示信息','确定删除吗？',function(r){
                    if (r){
                        $.get( '../../../php/action/page/teacher/tea.act.php?action=delete&id='+id,function(){						
                           $('#grid').datagrid('reload');                      
                        });					 
                    }
                });         
        }
		//批量删除
		function destroyTeacherlist(){
			
			var rows = $("#grid").datagrid("getChecked");
			
			if(rows.length==0){
				$.messager.alert('消息提示','请选择要删除的教师信息','info');	
			}else{
				var list=new Array();
				for(var i=0;i<rows.length;i++){
					list[i]=rows[i].id;	
				}
				
				$.messager.confirm('消息提示','确定删除吗？',function(r){
                    if (r){
                        $.get( '../../../php/action/page/teacher/tea.act.php?action=deletelist&idlist='+list,function(data){					
                           $('#grid').datagrid('reload');                
                        });					 
                    }
                });
					
			}
        }
		
		 //-----------------------------------------------教育经历-------------------------------------
		 
		function showEduInfo(tid){
			teacherId=tid;
			
			$('#edu').dialog('open').dialog('setTitle','教育经历'); 
			 
	        $('#edu_grid').datagrid({
	     
				height:250,
	            nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	            striped : true,//设置为true将交替显示行背景。
	            collapsible : false,//显示可折叠按钮
				singleSelect:true,//为true时只能选择单行
				fitColumns:true,//允许表格自动缩放，以适应父容器
	            rownumbers : true,//行数
				pagination:true,//分页
				pageSize: 5,  
				pageList: [5,10,15], 
				checkOnSelect:false,
				selectOnCheck:false, 
				
			    remoteSort : false,
				toolbar:'#edu_toolbar',
			   
	            url:'../../../php/action/page/teacher/tea.act.php?action=queryEdu&tid='+tid,//url调用Action方法
	            loadMsg : '数据装载中......',
	         
	          	columns:[[
					{field:'stage',title:'教育阶段',width:100},
					{field:'school',title:'学校',width:100},
					{field:'starttime',title:'开始时间',width:100},
					{field:'endtime',title:'结束时间',width:100},
					
					{field:'action',title:'操作',width:150,align:'center',
						formatter:function(value,row,index){
							var a='<a href="javascript:void(0)" onclick="showEduEdtForm('+row.id+')">编辑</a>';
							var b='<a href="javascript:void(0)" onclick="delEdu('+row.id+')"> 删除</a>';					
							return a+b;	
						}
					}
				]]  
	        });
			
			var p = $('#edu_grid').datagrid('getPager');  
			$(p).pagination({  
				pageSize: 5,  
				pageList: [5,10,15],  
				beforePageText: '第', 
				afterPageText: '页    共 {pages} 页',  
				displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
			});   
		}
		 
		function showEduAddForm(){
			$('#edu_dlg').dialog('open').dialog('setTitle','添加教育经历');
			$('#edu_form').form('clear');
			url='../../../php/action/page/teacher/tea.act.php?action=addEdu&tid='+teacherId;
		}
		
		function showEduEdtForm(id){
			
			$.get( '../../../php/action/page/teacher/tea.act.php?action=findEduById&id='+id,function(data){
					
				data=eval("("+data+")");				
            	$('#edu_dlg').dialog('open').dialog('setTitle','修改教育经历');
                $('#edu_form').form('load',data);
				
               url = '../../../php/action/page/teacher/tea.act.php?action=updateEdu&id='+id+'&tid='+teacherId;
						                     
          });
		 
		} 
		 
		function saveEdu(){
			$('#edu_form').form('submit',{
				url:url,
				onSubmit: function(){					
				},
				success: function(result){	        	
					$('#edu_dlg').dialog('close');
					$('#edu_grid').datagrid('reload');
					url=null;
				}
			});		
		} 
		
		function delEdu(id){
                $.messager.confirm('提示信息','确定删除吗？',function(r){
                    if (r){
                        $.get( '../../../php/action/page/teacher/tea.act.php?action=delEdu&id='+id,function(){						
                           $('#edu_grid').datagrid('reload');                      
                        });					 
                    }
                });         
        }
		function closeedu(){
			$('#edu_grid').datagrid('loadData',{total:0,rows:[]});
			teacherId=null;	
		} 
		
		
		 //-----------------------------------曾获荣誉--------------------------------------
		function showHorInfo(tid){
			teacherId=tid;
			
			$('#hor').dialog('open').dialog('setTitle','曾获荣誉'); 
			 
	        $('#hor_grid').datagrid({
	     
				height:250,
	            nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	            striped : true,//设置为true将交替显示行背景。
	            collapsible : false,//显示可折叠按钮
				singleSelect:true,//为true时只能选择单行
				fitColumns:true,//允许表格自动缩放，以适应父容器
	            rownumbers : true,//行数
				pagination:true,//分页
				pageSize: 5,  
				pageList: [5,10,15], 
				checkOnSelect:false,
				selectOnCheck:false, 
				
			    remoteSort : false,
				toolbar:'#hor_toolbar',
			   
	            url:'../../../php/action/page/teacher/tea.act.php?action=queryHor&tid='+tid,//url调用Action方法
	            loadMsg : '数据装载中......',
	         
	          	columns:[[
					{field:'overview',title:'荣誉概述',width:100},
					{field:'descrip',title:'详细描述',width:150},
					{field:'attname',title:'附件名称',width:100},
					{field:'savepath',title:'存储路径',width:150},
					
					{field:'action',title:'操作',width:100,align:'center',
						formatter:function(value,row,index){
							var a='<a href="javascript:void(0)" onclick="showHorEdtForm('+row.id+')">编辑</a>';
							var b='<a href="javascript:void(0)" onclick="delHor('+row.id+')"> 删除</a>';					
							return a+b;	
						}
					}
				]]  
	        });
			
			var p = $('#hor_grid').datagrid('getPager');  
			$(p).pagination({  
				pageSize: 5,  
				pageList: [5,10,15],  
				beforePageText: '第', 
				afterPageText: '页    共 {pages} 页',  
				displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
			});   
		}
		 
		function showHorAddForm(){
			$('#hor_dlg').dialog('open').dialog('setTitle','添加荣誉信息');
			//$('#hor_form').form('clear');
			
			$('#hor_form').each(function(){
				$(this).find('input').val('');
				$(this).find('textarea').val('');
			});
			
			
			url='../../../php/action/page/teacher/tea.act.php?action=addHor&tid='+teacherId;
		}
		
		function showHorEdtForm(id){
			
			$.get( '../../../php/action/page/teacher/tea.act.php?action=findHorById&id='+id,function(data){
					
				data=eval("("+data+")");				
            	$('#hor_dlg').dialog('open').dialog('setTitle','修改荣誉信息');
                $('#hor_form').form('load',data);
				
               url = '../../../php/action/page/teacher/tea.act.php?action=updateHor&id='+id+'&tid='+teacherId;
						                     
          });
		 
		} 
		 
		function saveHor(){
			$('#hor_form').form('submit',{
				url:url,
				onSubmit: function(){					
				},
				success: function(result){

					$('#hor_dlg').dialog('close');
					$('#hor_grid').datagrid('reload');
					url=null;
				}
			});		
		} 
		
		function delHor(id){
                $.messager.confirm('提示信息','确定删除吗？',function(r){
                    if (r){
                        $.get( '../../../php/action/page/teacher/tea.act.php?action=delHor&id='+id,function(){						
                           $('#hor_grid').datagrid('reload');                      
                        });					 
                    }
                });         
        } 
		
		function closehor(){
			$('#hor_grid').datagrid('loadData',{total:0,rows:[]});
			teacherId=null;	
		} 

	 //-----------------------------------指导竞赛情况--------------------------------------
		function showComInfo(tid){
			teacherId=tid;
			
			$('#com').dialog('open').dialog('setTitle','指导竞赛情况'); 
			 
	        $('#com_grid').datagrid({
	     
				height:250,
	            nowrap : true,//设置为true，当数据长度超出列宽时将会自动截取
	            striped : true,//设置为true将交替显示行背景。
	            collapsible : false,//显示可折叠按钮
				singleSelect:true,//为true时只能选择单行
				fitColumns:true,//允许表格自动缩放，以适应父容器
	            rownumbers : true,//行数
				pagination:true,//分页
				pageSize: 5,  
				pageList: [5,10,15], 
				checkOnSelect:false,
				selectOnCheck:false, 
				
			    remoteSort : false,
				toolbar:'#com_toolbar',
			   
	            url:'../../../php/action/page/teacher/tea.act.php?action=queryCom&tid='+tid,//url调用Action方法
	            loadMsg : '数据装载中......',
	         
	          	columns:[[
					{field:'name',title:'竞赛名称',width:100},
					{field:'address',title:'竞赛地址',width:100},
					{field:'time',title:'竞赛时间',width:100},
					{field:'result',title:'竞赛结果',width:150},
					
					{field:'action',title:'操作',width:100,align:'center',
						formatter:function(value,row,index){
							var a='<a href="javascript:void(0)" onclick="showComEdtForm('+row.id+')">编辑</a>';
							var b='<a href="javascript:void(0)" onclick="delCom('+row.id+')"> 删除</a>';					
							return a+b;	
						}
					}
				]]  
	        });
			
			var p = $('#com_grid').datagrid('getPager');  
			$(p).pagination({  
				pageSize: 5,  
				pageList: [5,10,15],  
				beforePageText: '第', 
				afterPageText: '页    共 {pages} 页',  
				displayMsg: '当前显示 {from} - {to} 条记录   共 {total} 条记录'  
			   
			});   
		}
		 
		function showComAddForm(){
			$('#com_dlg').dialog('open').dialog('setTitle','添加信息');
			$('#com_form').form('clear');
		
			url='../../../php/action/page/teacher/tea.act.php?action=addCom&tid='+teacherId;
		}
		
		function showComEdtForm(id){
			
			$.get( '../../../php/action/page/teacher/tea.act.php?action=findComById&id='+id,function(data){
					
				data=eval("("+data+")");				
            	$('#com_dlg').dialog('open').dialog('setTitle','修改信息');
                $('#com_form').form('load',data);
				
               url = '../../../php/action/page/teacher/tea.act.php?action=updateCom&id='+id+'&tid='+teacherId;
						                     
          });
		 
		} 
		 
		function saveCom(){
			$('#com_form').form('submit',{
				url:url,
				onSubmit: function(){					
				},
				success: function(result){

					$('#com_dlg').dialog('close');
					$('#com_grid').datagrid('reload');
					url=null;
				}
			});		
		} 
		
		function delCom(id){
                $.messager.confirm('提示信息','确定删除吗？',function(r){
                    if (r){
                        $.get( '../../../php/action/page/teacher/tea.act.php?action=delCom&id='+id,function(){						
                           $('#com_grid').datagrid('reload');                      
                        });					 
                    }
                });         
        }
		function closecom(){
			$('#com_grid').datagrid('loadData',{total:0,rows:[]});
			teacherId=null;	
		} 
