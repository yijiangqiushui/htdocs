//$(function(){
function validation() {
    $("body").delegate("textarea", "blur", function () {
        var textarea_self = $(this);
        var textarea_txt = $(this).val();
        var length = textarea_txt.length;
        var maxlength = $(this).attr('title');
        if (maxlength != 0) {
            if (maxlength < length) {
                $.messager.alert('提示', '输入长度不得大于' + maxlength + "个字！", 'info', function () {
                    textarea_self.focus();
                });
            }
        }

    });
    $("body").delegate("input", "blur", function () {
        var self = this;
        var txt = $(this).val();
        //返回被选元素的属性值
        var type = $(this).attr('datatype');
        var filter;
        var filter1;
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
            var message = "填写格式不正确,请重新填写!";
            var placeholder = "";
            if (type == 'email') {//邮箱
                filter = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
                placeholder = "格式要求：XXXX@XX.com";
                message = "请输入正确的邮箱：XXXX@XX.com";
            } else if (type == 'number') {//整数
                filter = /^\d+$/;

                placeholder = "请输入整数";
                message = "请输入整数";
            } else if (type == 'chinese_characters') {//汉字
                filter = /^[\u4e00-\u9fa5]*$/;
            } else if (type == 'num4year') {//四位整数，年份
                filter = /^\d{4}$/;
                message = "请输入正确年份";
            } else if (type == 'phone') {//固话
                //filter =  /^\d{2,4}-?\d{5,8}$/;
                filter = /^(?:(?:0\d{2,3})-)?(?:\d{6,8})(-(?:\d{3,}))?$/;
                message = "请输入正确的电话号码！";
            } else if (type == 'telephone') {//手机
                filter = /^1[3|5|7|8|][0-9]{9}$/;
                message = "请填写正确的手机号";
            } else if (type == 'fax') {//传真
//					filter =  /(\d{3,4})?(\-)?\d{7,8}/;
                //filter = /^[0-9]{3}-[0-9]{8}$/;
                filter = /^(?:(?:0\d{2,3})-)?(?:\d{6,8})(-(?:\d{3,}))?$/;
                message = "填写格式不正确,请按照：xxxx-12345678  格式填写！";
            } else if (type == 'newfax') {//传真
//				filter =  /(\d{3,4})?(\-)?\d{7,8}/;
                //filter = /^[0-9]{3}-[0-9]{8}$/;
                filter = /^(?:(?:0\d{2,3})-)?(?:\d{6,8})(-(?:\d{3,}))?$/;
                message = "填写格式不正确,请按照：12345678-0000 格式填写！";
            }
            else if (type == 'postcode') {//6位的邮政编码
                filter = /^\d{6}$/;
                message = "请输入6位数字!";
            } else if (type == 'chinese_characters') {//汉字
                filter = /^[\u4e00-\u9fa5]*$/;
            } else if (type == 'date') {//日期
                filter = /^2[0-3][0-9]{2}-[0-1][1-9]-[0-3][1-9]$/;
            } else if (type == 'phandtel') {//手机和固话
                filter1 = /^(?:(?:0\d{2,3})-)?(?:\d{7,8})(-(?:\d{3,}))?$/;
                var filter2 = /^1[3|5|7|8|][0-9]{9}$/;
                if (!((filter1.test(txt)) || (filter2.test(txt)))) {
                    message = "请填写正确的手机号或固定电话";
                    alert(message);
                    $(this).focus();
                }
            } else if (type == 'float') {
                filter = /^(-?\d+)(\.\d+)?$/;
                message = '请输入整数或者小数';
            } else if (type == 'float2') {//小数点后两位数字

              /*  filter = /^(-?\d+)(\.\d{1}|\.\d{2})?$/;
                 message = '请输入不超过两位小数的数字';
                 placeholder = "请保留两位小数";*/
                filter = /^(-?\d+)(\.\d+)?$/;
                message = '请输入整数或者小数';

            }
            else if (type == 'float1') {//小数点后一位数字

             /*   filter = /^(-?\d+)(\.\d{1})?$/;
                message = '请输入不超过一位小数的数字';
                placeholder = "请保留一位小数";
                */
                filter = /^(-?\d+)(\.\d+)?$/;
                message = '请输入整数或者小数';
            } else if(type == 'float3'){
            	filter = /(?:^(?:[1-9][\d]?)(?:\.[\d]{1,2})?$)|(?:^100(?:\.0{1,2})?$)/;
                message = '请输入百分比数字，小数点后不超过两位';
                placeholder = "请输入百分比数字，小数点后不超过两位";
            } 
            else if (type == 'website') {//网址
                //filter = /^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/;
                filter = /^((https?|ftp|news):\/\/)?([a-z]([a-z0-9\-]*[\.。])+([a-z]{2}|aero|arpa|biz|com|coop|edu|gov|info|int|jobs|mil|museum|name|nato|net|org|pro|travel)|(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5]))(\/[a-z0-9_\-\.~]+)*(\/([a-z0-9_\-\.]*)(\?[a-z0-9+_\-\.%=&]*)?)?(#[a-z][a-z0-9_]*)?$/;
            } else if (type == 'idcard') {//身份证号
                filter = /^(\d{15}$|^\d{18}$|^\d{17}(\d|X|x))$/;
                message = "请输入18位有效证件号码！";
            } else if (type == 'birth') {//出身年月
                filter = /^[12]\d{3}(0[1-9]|1[0-2])$/;
            } else if (type == 'year') {
                filter = /^[12]\d{3}$/;
                message = '请输入4位的年份';
            }

            if (filter) {
                if (!filter.test(txt)) {
                    alert(message);
                    $(this).prop("placeholder", placeholder);
                    $(this).focus();
                } else {
                    if (type == 'float1') {
                        var num = parseFloat($(this).val());
                        $(this).val(num.toFixed(1));
                    } else if (type == 'float2') {
                        var num = parseFloat($(this).val());
                        $(this).val(num.toFixed(2));
                    } else {

                    }
                }
            }
        }
    });

    //用来控制输入的字数
    $("textarea").blur(function () {
        var txt = $(this).val();
        var length = $(this).attr('datalength');
        if (length != "") {
            if (length < txt.length) {
                alert("字数超过限制");
                $(this).focus();
            }

        }
    });

}


$(function () {
    validation();
});