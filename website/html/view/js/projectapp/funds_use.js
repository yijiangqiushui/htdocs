/**
 author:Gao Xue
 date:2014-05-23
 */

/** *申请项目*** */

function submit_data() {
    $('#total_funds').form('submit', {
        url: '../../../../../../extends/Table/api.php?action=save&subtable_id=42',
        success: function (result) {
            $.messager.alert('提示', '信息保存成功！', 'info', function () {

                var complete = completeInput();
                if (complete) {
                    window.parent.save_stage('project_budget');
                } else {
                    window.parent.update_stage('project_budget');
                }
                window.parent.setStep('project_budget', complete);
            });
        }
    });
}

$(function () {
    loadApplyInfo();
	$('textarea').blur(function() {
		var self = this;
		var txt = $(this).val();
		if(!$(self).attr('readonly')) {
			$(self).after('<div class="error">此项不得为空</div>');
			var timer = setTimeout(function() {
				$(self).next().remove();
				},1000); 
		} 
	});
    $('input').blur(function () {
        var self = this;
        var txt = $(this).val();
        //返回被选元素的属性值
        var type = $(this).attr('datatype');
        var filter;
        if (!txt) {
            if (!$(self).attr('readonly')) {
                $(self).after('<div class="error">此项不得为空</div>');
                var timer = setTimeout(function () {
                    $(self).next().remove();
                }, 1000);
            } else {
                $(self).after('<div class="error1">此项不需要用户输入</div>');
                var timer = setTimeout(function () {
                    $(self).next().remove();
                }, 1000);
            }

        } else if (type) {
            if (type == 'email') {
                filter = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
            } else if (type == 'number') {
                filter = /^\d+$/;
            } else if (type == 'phone') {
                filter = /^\d{2,4}-?\d{5,8}$/;
            } else if (type == 'telephone') {
                filter = /^1\d{10}$/;
            } else if (type == 'sex') {
                filter = /['男','女']/;
            }
            if (!filter.test(txt)) {
                alert('填写格式不正确,请重新填写');
                $(this).focus();
            }
        }
    });
    $('#back').click(function () {
        $(window.parent.parent.document).find('iframe').attr('src', "../template/user_project.php");
    })
});

function getQueryStringByName(name) {
    var result = location.search.match(new RegExp("[\?\&]" + name + "=([^\&]+)", "i"));
    if (result == null || result.length < 1) {
        return "";
    }
    return result[1];
}

function loadApplyInfo() {
    $.get('../../../../../../extends/Table/api.php?action=get&subtable_id=42',
        function (result) {
            if (result != '0') {
                var res = eval("(" + result + ")");
                $('#total_funds').form('load', res);
            }
        });


    $('.save').bind('click', function () {
        submit_data();
    });
    $('.reset').bind('click', function () {
        window.location.reload();
    });

    var user_type = decodeURI(getQueryStringByName('user_type'));
    var table_status = decodeURI(getQueryStringByName('table_status'));

    if (user_type == 1 || user_type == 2 || user_type == 3) {
        $('.button_wrapper').css('display', 'block');
    }

    if (user_type == 0) {
        if (table_status == 1 || table_status == 3) {
            $('.button_wrapper').css('display', 'block');
        }
    }
}


function resetInfo() {
    alert('重置');
}



function completeInput() {
    var returnValue = true;
    $('input').each(function () {
        if (!$(this).val()) {
            returnValue = false;
        }
    })
    $('textare').each(function () {
        if (!$(this).val()) {
            returnValue = false;
        }
    })
    return returnValue;
}
