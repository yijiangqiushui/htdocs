document.write('<script type="text/javascript" src="/common/html/js/common.js"></script>');




var table_status;
var user_type;
var table_id;
var iscomplete;
$(function() {
	init();
});

$(window).resize(function() {
	resetWNH();
});

function init() {
	resetWNH();

	bindEvents();
}
function bindEvents() {
	$('.my-project').bind('click', function() {
		$('.iframe iframe').attr('src', 'userlist.php');
	});
	$('.menu').each(function(i) {
		$(this).bind('click', function() {
			$('.menu').removeClass('menu-selected');
			$('.menu').addClass('menu-unselected');
			$(this).removeClass('menu-unselected');
			$(this).addClass('menu-selected');
		});
	});
/*	$('#swich2')
			.bind('click',
					function() {
						var iframe_width = $("#iframe2").width();
						if ($('.menus-scroll-hidden').css('display') != 'none') {
							$('.menus-scroll-hidden').css('display', 'none');
							$('.menu-bar').css('display', 'none');
							$('.menu-bar').css('background-image',
									'url(../../url)');
							$('#iframe2').css('width', iframe_width + 200);
						} else {
							$('.menus-scroll-hidden').css('display', 'block');
							$('.menu-bar').css('display', 'block');
							$('.menu-bar')
									.css('background-image',
											'url(/website/html/view/img/main-xmsbxt/manage.png)');
							$('#iframe2').css('width', iframe_width - 200);
						}
					});*/
	
	
	
	$('.genious_info').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/org_info.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.work_product').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/work_product.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.honor_title').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/honor_title.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.situation').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/situation.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.statement').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/statement.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.unit_opinion').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/unit_opinion.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.first_opinion').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/first_opinion.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.review_opinion').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/review_opinion.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	$('.final_opinion').bind(
			'click',
			function() {
				$('.iframe iframe').attr(
						'src',
						'../../../template/apply/genious_award/final_opinion.php?table_status='
								+ table_status + '&user_type=' + user_type);
			});
	
	$('.genious_info').click();
}

/*function resetWNH() {
	$('.menusNiframe').height($(window).height());
	$('.iframe iframe').width($(window).width() - 214);
	$('.iframe iframe').height($('.menusNiframe').height());

}*/


$(function() {

	clickEffect();// 设置单击效果

	setATarget();// 设置链接显示到iframe中

});

function setATarget() {
	$('.home a').attr({
		'target' : 'layout_right'
	});
	$('.information a').attr({
		'target' : 'layout_right'
	});
	$('.apply a').attr({
		'target' : 'layout_right'
	});
}


function setSuccess(classname, complete) {
	if (complete) {
		$('.' + classname).children('.pic').show();
	} else {
		$('.' + classname).children('.pic').hide();
	}
}

function clickEffect() {
	$('.menus a').each(function() {
		$(this).bind('click', function() {
			$('.menus li').css({
				'background-color' : ''
			});
			$('.menus li').find('a').css({
				'color' : ''
			});
			$(this).parent().css({
				'background-color' : '#0066ff'
			});
			$(this).parent().find('a').css({
				'color' : '#fff'
			});
		});
	});
}

function RGBToHex(rgb) {
	var re = rgb.replace(/(?:\(|\)|rgb|RGB)*/g, "").split(",");// 利用正则表达式去掉多余的部分，将rgb中的数字提取
	var hexColor = "#";
	var hex = [ '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b',
			'c', 'd', 'e', 'f' ];
	for (var i = 0; i < re.length; i++) {
		var hexint = parseInt(re[i]);
		if (hexint > 16) {
			hexColor += hex[(hexint - hexint % 16) / 16] + hex[hexint % 16];
		} else {
			hexColor += '0' + hex[hexint % 16];
		}
	}
	return hexColor;
}

function back2main() {
	window.location.href = 'main.html';
}

