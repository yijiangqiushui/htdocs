<?php

require_once __DIR__ . '/pdf.php';

// datatopdf('demo', array
//   (
//   'target'=>array("id"=>"id","document"=>"document","author"=>"author","range"=>"range"),
//   'result'=>array("BMW",15,13),
//   'article'=>array("article1","article2"),
//   'article1'=>array("Land Rover",17,15),
//   'article2'=>array("Land Rover2",171,151),
//   ));
datatopdf('demo', array(
	array("id"=>"id","document"=>"原文本标题","author"=>"author","range"=>"range","num1"=>22,"num2"=>15,"num3"=>13),
	array(
		array("原文本分段1标题","17%",2345),
		array(
			array("相似文章1","13%","相似文章的来源","true"),
			array("相似文章2","13%","相似文章的来源","true")
		),
		array(
			array("相似段落1","相似文章的段落1"),
			array("相似段落2","相似文章的段落1")
		)
	),
	array(
		array("原文本分段2标题","17%",2345),
		array(
			array("相似文章1","13%","相似文章的来源","true"),
			array("相似文章2","13%","相似文章的来源","true")
		),
		array(
			array("相似段落1","相似文章的段落1"),
			array("相似段落2","相似文章的段落1")
		)
	),
	array(
		array("原文本分段3标题","17%",2345),
		array(
			array("相似文章1","13%","相似文章的来源","true"),
			array("相似文章2","13%","相似文章的来源","true")
		),
		array(
			array("相似段落1","相似文章的段落1"),
			array("相似段落2","相似文章的段落1")
		)
	),
	array(
		array("原文本分段4标题","17%",2345),
		array(
			array("相似文章1","13%","相似文章的来源","true"),
			array("相似文章2","13%","相似文章的来源","true")
		),
		array(
			array("相似段落1","相似文章的段落1"),
			array("相似段落2","相似文章的段落1")
		)
	)
)
);
//第一维 0 原文本资料；其他 分段文本资料
//第二维 0 原文本资料；其他 分段文本资料
//第三维 0 原文本资料；其他 分段文本资料
// datatopdf('demo', array(
// 	array("id"=>"id","document"=>"原文本标题","author"=>"author","range"=>"range","num1"=>22,"num2"=>15,"num3"=>13),
// 	array(
// 		array("原文本分段1标题","17%",2345),
// 		array(
// 			array(
// 				array("相似文章1","13%","相似文章的来源","true"),
// 				array("相似文章1段落1","相似文章1段落2")),
// 			array(
// 				array("相似文章2","13%","相似文章的来源","true"),
// 				array("相似文章2段落1","相似文章2段落2"))),
// 	array(
// 		array("原文本分段2标题","17%",2345),
// 		array(
// 			array(
// 				array("相似文章1","13%","相似文章的来源","true"),
// 				array("相似文章1段落1","相似文章1段落2")),
// 			array(
// 				array("相似文章2","13%","相似文章的来源","true"),
// 				array("相似文章2段落1","相似文章2段落2"))),
// 	array(
// 		array("原文本分段3标题","17%",2345),
// 		array(
// 			array(
// 				array("相似文章1","13%","相似文章的来源","true"),
// 				array("相似文章1段落1","相似文章1段落2")),
// 			array(
// 				array("相似文章2","13%","相似文章的来源","true"),
// 				array("相似文章2段落1","相似文章2段落2"))),
// 	array(
// 		array("原文本分段4标题","17%",2345),
// 		array(
// 			array(
// 				array("相似文章1","13%","相似文章的来源","true"),
// 				array("相似文章1段落1","相似文章1段落2")),
// 			array(
// 				array("相似文章2","13%","相似文章的来源","true"),
// 				array("相似文章2段落1","相似文章2段落2")))
// 	));