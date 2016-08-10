<?php
/**
author:Gao Xue
date:2014-08-01
*/
header("Content-Type:textml;charset=utf-8");
require_once('../../../../common/php/plugin/tcpdf/config/lang/eng.php');
require_once('../../../../common/php/plugin/tcpdf/tcpdf.php');

include '../../../../center/php/config.ini.php';
include '../../../../common/php/config.ini.php';
include '../../../../common/php/lib/db.cls.php';


$action=$_GET['action'];
//$id=$_GET['id'];
$id=$_GET['id'];

switch($action){
	case 'printPdf':
		printPdf($id);
		break;
	default:;
}

function printPdf($id){
	$db=new DB();
	$result=$db->GetInfo($id,'application');
	$sql='SELECT * FROM recommend_org where id='.$result['rec_org'];
	$resRec=$db->Select($sql);
	
	$appJSON=array('id'=>$result['id'],'aname'=>$result['aname'],'impPerson'=>$result['impPerson'],'completeOrg'=>$result['completeOrg'],'completeAdress'=>$result['completeAdress'],'completeCode'=>$result['completeCode'],'completePerson'=>$result['completePerson'],'completeTel'=>$result['completeTel'],'completePhone'=>$result['completePhone'],'completeFax'=>$result['completeFax'],'completeEmail'=>$result['completeEmail'],'rec_org'=>$resRec[0]['id'],'recOrg'=>$resRec[0]['name'],'recAdress'=>$resRec[0]['address'],'recCode'=>$resRec[0]['postcode'],'recPerson'=>$resRec[0]['linkman'],'recTel'=>$resRec[0]['tel'],'recPhone'=>$resRec[0]['phone'],'recFax'=>$resRec[0]['fax'],'recEmail'=>$resRec[0]['email'],'economic'=>$result['economic'],'science'=>$result['science'],'scienceCat'=>$result['scienceCat'],'source'=>$result['source'],'planID'=>$result['planID'],'proStart'=>$result['proStart'],'proEnd'=>$result['proEnd'],'isCheck'=>$result['isCheck'],'isSave'=>$result['isSave'],'checkAdvice'=>$result['checkAdvice'],'org_id'=>$result['org_id'],'isRefer'=>$result['isRefer'],'advice_award'=>$result['advice_award'],'isCheck_award'=>$result['isCheck_award'],'advice_unit'=>$result['advice_unit'],'isCheck_unit'=>$result['isCheck_unit'],'advice_peo'=>$result['advice_peo'],'isCheck_peo'=>$result['isCheck_peo'],'advice_proof'=>$result['advice_proof'],'isCheck_proof'=>$result['isCheck_proof']);
	
	$sqlTwo='select * from application_brief where app_id= '.$id;
	$resultTwo=$db->Select($sqlTwo);
	$briefJSON=array('id'=>$resultTwo[0]['id'],'proBrief'=>$resultTwo[0]['proBrief'],'app_id'=>$resultTwo[0]['app_id'],'isSave'=>$resultTwo[0]['isSave'],'isCheck'=>$resultTwo[0]['isCheck'],'checkAdvice'=>$resultTwo[0]['checkAdvice']);
	
	$sqlThree='select * from application_create where app_id= '.$id;
	$resultThree=$db->Select($sqlThree);
	$createJSON=array('id'=>$resultThree[0]['id'],'proCreat'=>$resultThree[0]['proCreat'],'app_id'=>$resultThree[0]['app_id'],'isSave'=>$resultThree[0]['isSave'],'isCheck'=>$resultThree[0]['isCheck'],'checkAdvice'=>$resultThree[0]['checkAdvice']);
	
	$sqlFore='select * from application_detail where app_id='.$id;
	$resultFore=$db->Select($sqlFore);	
	$detailJSON=array('id'=>$resultFore[0]['id'],'background'=>$resultFore[0]['background'],'scienceCon'=>$resultFore[0]['scienceCon'],'extend'=>$resultFore[0]['extend'],'effect'=>$resultFore[0]['effect'],'economicBenefit'=>$resultFore[0]['economicBenefit'],'invest'=>$resultFore[0]['invest'],'recoverDate'=>$resultFore[0]['recoverDate'],'casculBasis'=>$resultFore[0]['casculBasis'],'economicBenefit'=>$resultFore[0]['economicBenefit']);
	
	
	$sqlFourData='SELECT * FROM economic_benefit WHERE app_id='.$id.' ORDER BY id ASC';
	$resultFourData=$db->Select($sqlFourData);
	
	$sqlFiveData='SELECT * FROM application_award WHERE app_id='.$id.' ORDER BY id DESC';
	$resultFiveData=$db->Select($sqlFiveData);
	
	$sqlSixData='SELECT * FROM application_unit WHERE app_id='.$id.' ORDER BY id DESC';
	$resultSixData=$db->Select($sqlSixData);
	
	$sqlSevenData='SELECT * FROM application_people WHERE app_id='.$id.' ORDER BY id DESC';
	$resultSevenData=$db->Select($sqlSevenData);
	
	$sqlEigth1Data='SELECT * FROM application_proof1 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth1Data=$db->Select($sqlEigth1Data);
	
	$sqlEigth2Data='SELECT * FROM application_proof2 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth2Data=$db->Select($sqlEigth2Data);
	
	$sqlEigth3Data='SELECT * FROM application_proof3 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth3Data=$db->Select($sqlEigth3Data);
	
	$sqlEigth4Data='SELECT * FROM application_proof4 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth4Data=$db->Select($sqlEigth4Data);
	
	$sqlEigth5Data='SELECT * FROM application_proof5 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth5Data=$db->Select($sqlEigth5Data);
	
	$sqlEigth6Data='SELECT * FROM application_proof6 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth6Data=$db->Select($sqlEigth6Data);
	
	$sqlEigth7Data='SELECT * FROM application_proof7 WHERE app_id='.$id.' ORDER BY id DESC';
	$resultEigth7Data=$db->Select($sqlEigth7Data);
	
	$sqlAdviceData='SELECT * FROM application_recommend WHERE app_id='.$id;
	$resultAdviceData=$db->Select($sqlAdviceData);
	
	$sqlAttachData=$sql='SELECT * FROM attach_proof WHERE app_id='.$id.' ORDER BY pro';
	$resultAttachData=$db->Select($sqlAttachData);
	

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator("Qiansong");
	//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, 's', 's');
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	$pdf->setLanguageArray($l);
	// set default font subsetting mode
	$pdf->setFontSubsetting(true);
	$pdf->SetFont('stsongstdlight', '', 14, '', true); 
	$pdf->AddPage();
	
	$html='
	<div align="left" style=" font-size:10pt; font-weight:bold; font-family:\'微软雅黑\';">项目编号:</div>
	<div align="center" style=" font-size:14pt; font-weight:bold; font-family:\'微软雅黑\';">通州区科学技术奖申报推荐书</div>
	<h1 style=" font-size:12pt;">1.项目基本情况</h1>
	<table width="100%" border="1" cellpadding="5" align="center" style=" font-size:9pt; font-family:\'微软雅黑\';">
	  <tr>
		<td>项目名称</td>
		<td colspan="5">'.$appJSON['aname'].'</td>
	  </tr>
	  <tr>
		<td>主要完成人</td>
		<td colspan="5">'.$appJSON['impPerson'].'</td>
	  </tr>
	  <tr>
		<td rowspan="4" valign="middle">第一完成<br />单位(盖章)</td>
		<td rowspan="4">'.autoInsertBR($appJSON['completeOrg'],6).'</td>
		<td>通讯地址</td>
		<td colspan="3">'.$appJSON['completeAdress'].'</td>
	  </tr>
	  <tr>
		<td>邮编</td>
		<td>'.$appJSON['completeCode'].'</td>
		<td>联系人</td>
		<td>'.$appJSON['completePerson'].'</td>
	  </tr>
	  <tr>
		<td>联系电话</td>
		<td>'.$appJSON['completeTel'].'</td>
		<td>手机</td>
		<td>'.$appJSON['completePhone'].'</td>
	  </tr>
	  <tr>
		<td>传真</td>
		<td>'.$appJSON['completeFax'].'</td>
		<td>电子邮箱</td>
		<td>'.$appJSON['completeEmail'].'</td>
	  </tr>
	  <tr>
		<td rowspan="4" valign="middle">推荐单位<br />(盖章)</td>
		<td rowspan="4">'.autoInsertBR($appJSON['recOrg'],6).'</td>
		<td>通讯地址</td>
		<td colspan="3">'.$appJSON['recAdress'].'</td>
	  </tr>
	  <tr>
		<td>邮编</td>
		<td>'.$appJSON['recCode'].'</td>
		<td>联系人</td>
		<td>'.$appJSON['recPerson'].'</td>
	  </tr>
	  <tr>
		<td>联系电话</td>
		<td>'.$appJSON['recTel'].'</td>
		<td>手机</td>
		<td>'.$appJSON['recPhone'].'</td>
	  </tr>
	  <tr>
		<td>传真</td>
		<td>'.$appJSON['recFax'].'</td>
		<td>电子邮箱</td>
		<td>'.$appJSON['recEmail'].'</td>
	  </tr>
	  <tr>
		<td colspan="2">所属国民经济行业</td>
		<td colspan="4">'.getEcnomic($appJSON['economic']).'</td>
	  </tr>
	  <tr>
		<td colspan="2">所属科学技术领域</td>
		<td colspan="4">'.getScience($appJSON['science'],$db).'</td>
	  </tr>
	  <tr>
		<td>任务来源</td>
		<td colspan="2">'.getSource($appJSON['source']).'</td>
		<td>具体计划、<br />基金的名称<br />和编号</td>
		<td colspan="2">'.$appJSON['planID'].'</td>
	  </tr>
	  <tr>
		<td>项目起始时间</td>
		<td colspan="2">'.$appJSON['proStart'].'</td>
		<td>完成时间</td>
		<td colspan="2">'.$appJSON['proEnd'].'</td>
	  </tr>
	</table>
	
	<br/>&nbsp;
	<h1 style=" font-size:12pt;">2.项目简介(可公开宣传)</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
			<td>(项目所属科学技术领域、主要研究开发内容、解决的主要技术问题、技术创新点与创新程度、技术经济指标、促进科技进步<br/>的作用、推广应用及经济和社会效益情况等)(限800字)</td>
		</tr>
		<tr>
			<td>'.autoInsertBR($briefJSON['proBrief'],54).'</td>
		</tr>
	</table>
	
	<br />&nbsp;
	<h1 style=" font-size:12pt;">三、主要创新点</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
			<td>(限1000字)</td>
		</tr>
		<tr>
			<td>'.autoInsertBR($createJSON['proCreat'],54).'</td>
		</tr>
	</table>
	
	
	<br />&nbsp;
	<h1 style=" font-size:12pt;">四、项目详细内容</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
			<td colspan="7">1、立项背景(限800字)</td>
		</tr>
		<tr>
		  <td colspan="7">'.autoInsertBR($detailJSON['background'],54).'</td>
		</tr>
		<tr>
		  <td colspan="7">2、详细科学技术内容(总体思路、技术方案、与当前同类科学技术的综合比较等)
		  </td>
		</tr>
		<tr>
		  <td colspan="7">'.autoInsertBR($detailJSON['scienceCon'],54).'</td>
		</tr>
		<tr>
		  <td colspan="7">3、应用情况及推广程度(限800字)</td>
		</tr>
		<tr>
		  <td colspan="7">'.autoInsertBR($detailJSON['extend'],54).'</td>
		</tr>
		<tr>
		  <td colspan="7">4、推动科学技术进步的作用(限800字)</td>
		</tr>
		<tr>
		  <td colspan="7">'.autoInsertBR($detailJSON['effect'],54).'</td>
		</tr>
		<tr>
		  <td colspan="7">5、经济效益(无法计算直接经济效益的项目可以不填此栏)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 单位：万元人民币</td>
		</tr>
		<tr>
		  <td colspan="2">项目总投资额</td>
		  <td colspan="2">'.$detailJSON['invest'].'</td>
		  <td>回收年(年)</td>
		  <td colspan="2">'.$detailJSON['recoverDate'].'</td>
		</tr>
		<tr>
		  <td>年份</td>
		  <td colspan="2">新增销售收入</td>
		  <td>新增利润</td>
		  <td>新增税收</td>
		  <td>创收外汇(美元)</td>
		  <td>节支总额</td>
		</tr>
		';
		$sumIncome='';
		$sumProfit='';
		$sumTax='';
		$sumForeignCurrency='';
		$sumTotalSavings='';
		for($i=0;$i<count($resultFourData);$i++){
			$html.='<tr>';
			$html.='<td>'.$resultFourData[$i]['year'].'</td>';
			$html.='<td colspan="2">'.$resultFourData[$i]['income'].'</td>';
			$html.='<td>'.$resultFourData[$i]['profit'].'</td>';
			$html.='<td>'.$resultFourData[$i]['tax'].'</td>';
			$html.='<td>'.$resultFourData[$i]['foreignCurrency'].'</td>';
			$html.='<td>'.$resultFourData[$i]['totalSavings'].'</td>';
			$html.='</tr>';
			$sumIncome.=intval($resultFourData[$i]['income']);
			$sumProfit.=intval($resultFourData[$i]['profit']);
			$sumTax.=intval($resultFourData[$i]['tax']);
			$sumForeignCurrency.=intval($resultFourData[$i]['foreignCurrency']);
			$sumTotalSavings.=intval($resultFourData[$i]['totalSavings']);
		}
		
		$html.='
		<tr>
		  <td>累计</td>
		  <td colspan="2">'.$sumIncome.'</td>
		  <td>'.$sumProfit.'</td>
		  <td>'.$sumTax.'</td>
		  <td>'.$sumForeignCurrency.'</td>
		  <td>'.$sumTotalSavings.'</td>
		</tr>
		<tr>
		  <td colspan="7">各栏目的计算依据</td>
		</tr>
		<tr>
		  <td colspan="7">'.autoInsertBR($detailJSON['recoverDate'],54).'</td>
		</tr>
		<tr>
		  <td colspan="7">经济效益综述（限800字）</td>
		</tr>
		<tr>
		  <td colspan="7">'.autoInsertBR($detailJSON['casculBasis'],54).'</td>
		</tr>
		<tr>
		  <td colspan="7">6、社会效益（限800字）</td>
		</tr>
		<tr>
			<td colspan="7">'.autoInsertBR($detailJSON['economicBenefit'],54).'</td>
		</tr>
	</table>
	
	<br />&nbsp;
	<h1 style=" font-size:12pt;">五、本项目曾获科技奖励情况</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
		  <td>序号</td>
		  <td>获奖项目名称</td>
		  <td>获奖时间</td>
		  <td>奖励名称</td>
		  <td>奖励等级</td>
		  <td>授奖部门</td>
	  </tr>';
	  for($i=0;$i<count($resultFiveData);$i++){
		  	$j=$i+1;
			$html.='<tr>';
			$html.='<td>'.$j.'</td>';
			$html.='<td>'.$resultFiveData[$i]['awardName'].'</td>';
			$html.='<td>'.$resultFiveData[$i]['awardTime'].'</td>';
			$html.='<td>'.$resultFiveData[$i]['name'].'</td>';
			$html.='<td>'.$resultFiveData[$i]['awardGrade'].'</td>';
			$html.='<td>'.$resultFiveData[$i]['depart'].'</td>';
			$html.='</tr>';
		}
		
	  $html.='
		<tr>
			<td colspan="6">本表所填科技奖励是指本项目曾获得的国家、省部级、经科技部或北京市批准的社会力量设立的科技奖励情况，不包括商业性<br/>奖励。</td>
		</tr>
		<tr></tr>
		<tr></tr>
	</table>
	
	<br />&nbsp;
	<h1 style=" font-size:12pt;">六、主要完成单位情况</h1>';
	for($i=0;$i<count($resultSixData);$i++){
		$html.='<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
		  <td>完成单位排序</td>
		  <td>'.$resultSixData[$i]['sort'].'</td>
		  <td>单位名称</td>
		  <td colspan="3">'.$resultSixData[$i]['name'].'</td>
		</tr>
		<tr>
		  <td>对申报项目作出<br/>的主要贡献(限100<br/>字)</td>
		  <td colspan="5">'.$resultSixData[$i]['contribute'].'</td>
		</tr>
		<tr>
		  <td>通讯地址</td>
		  <td colspan="3">'.$resultSixData[$i]['address'].'</td>
		  <td>邮政编码</td>
		  <td>'.$resultSixData[$i]['postcode'].'</td>
		</tr>
		<tr>
		  <td>单位性质</td>
		  <td>'.$resultSixData[$i]['nature'].'</td>
		  <td>单位类型</td>
		  <td>'.$resultSixData[$i]['type'].'</td>
		  <td>是否独立法人单位</td>
		  <td>'.$resultSixData[$i]['isSeparateLegal'].'</td>
		</tr>
		<tr>
		  <td>企业注册号</td>
		  <td colspan="2">'.$resultSixData[$i]['registeNum'].'</td>
		  <td>组织机构代码</td>
		  <td colspan="2">'.$resultSixData[$i]['organizationCode'].'</td>
		</tr>
		<tr>
		  <td>单位所在地区</td>
		  <td colspan="2">'.$resultSixData[$i]['zone'].'</td>
		  <td>单位网址</td>
		  <td colspan="2">'.$resultSixData[$i]['web'].'</td>
		</tr>
		<tr>
		  <td>单位联系人</td>
		  <td colspan="2">'.$resultSixData[$i]['contact'].'</td>
		  <td>单位联系人电话</td>
		  <td colspan="2">'.$resultSixData[$i]['phone'].'</td>
		</tr>
		<tr>
		  <td>单位传真</td>
		  <td colspan="2">'.$resultSixData[$i]['fax'].'</td>
		  <td>单位联系人手机</td>
		  <td colspan="2">'.$resultSixData[$i]['tel'].'</td>
		</tr>
		<tr>
		  <td colspan="2">单位联系人电子邮箱</td>
		  <td colspan="4">'.$resultSixData[$i]['email'].'</td>
		</tr>
		<tr>
		  <td>项目联系人</td>
		  <td colspan="2">'.$resultSixData[$i]['proContact'].'</td>
		  <td>项目联系人手机</td>
		  <td colspan="2">'.$resultSixData[$i]['proTel'].'</td>
		</tr>
		<tr>
		  <td colspan="2">项目联系人电子邮箱</td>
		  <td colspan="4">'.$resultSixData[$i]['proEmail'].'</td>
		</tr>
		<tr>
		  <td>声明</td>
		  <td colspan="5">本单位严格按照《通州区科学技术奖励办法》及其实施细则的有关规定和北京市通州区科学技术委员会<br/>
						  对申报工作的具体要求，如实提供了本申报推荐书及相关材料，且不存在任何违反《中华人民共和国保<br/>
						  守国家秘密法》和《科学技术保密规定》等相关法律法规及侵犯他人知识产权的情形。本单位是独立法<br/>
						  人机构。如有不符，本单位愿意承担相关后果并接受相应的处理。
		  </td>
		</tr>
	</table>';
	}
	$html.='
	<br />&nbsp;
	<h1 style=" font-size:12pt;">七、主要完成单位情况</h1>';
	for($i=0;$i<count($resultSevenData);$i++){
		$html.='
		<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
			<tr>
				<td>完成人排序</td>
				<td>'.$resultSevenData[$i]['sort'].'</td>
				<td>姓名</td>
				<td>'.$resultSevenData[$i]['name'].'</td>
				<td>性别</td>
				<td>'.$resultSevenData[$i]['sex'].'</td>
				<td>民族</td>
				<td>'.$resultSevenData[$i]['nation'].'</td>
			</tr>
			<tr>
				<td>出生地</td>
				<td>'.$resultSevenData[$i]['birthplace'].'</td>
				<td>出生日期</td>
				<td>'.$resultSevenData[$i]['birthdate'].'</td>
				<td>身份证号</td>
				<td colspan="3">'.$resultSevenData[$i]['idNumber'].'</td>
			</tr>
			<tr>
				<td>文化程度</td>
				<td>'.$resultSevenData[$i]['eduLeval'].'</td>
				<td>毕业时间</td>
				<td>'.$resultSevenData[$i]['graduateTime'].'</td>
				<td>是否归国人员</td>
				<td colspan="3">'.$resultSevenData[$i]['isHomecoming'].'</td>
			</tr>
			<tr>
				<td>工作单位</td>
				<td colspan="3">'.$resultSevenData[$i]['company'].'</td>
				<td>联系电话</td>
				<td colspan="3">'.$resultSevenData[$i]['phone'].'</td>
			</tr>
			<tr>
				<td>电子邮箱</td>
				<td colspan="3">'.$resultSevenData[$i]['email'].'</td>
				<td>手机</td>
				<td colspan="3">'.$resultSevenData[$i]['tel'].'</td>
			</tr>
			<tr>
				<td>通讯地址</td>
				<td colspan="7">'.$resultSevenData[$i]['address'].'</td>
			</tr>
			<tr>
				<td>毕业学校</td>
				<td colspan="2">'.$resultSevenData[$i]['graduateSchool'].'</td>
				<td>专业</td>
				<td colspan="2">'.$resultSevenData[$i]['major'].'</td>
				<td>学位</td>
				<td>'.$resultSevenData[$i]['degree'].'</td>
			</tr>
			<tr>
				<td>现从事专业</td>
				<td colspan="2">'.$resultSevenData[$i]['profession'].'</td>
				<td>技术职称</td>
				<td colspan="2">'.$resultSevenData[$i]['techTitle'].'</td>
				<td>行政职务</td>
				<td>'.$resultSevenData[$i]['adminPost'].'</td>
			</tr>
			<tr>
				<td>熟悉学科</td>
				<td colspan="7">'.$resultSevenData[$i]['familiarSubject'].'</td>
			</tr>
			<tr>
				<td>曾获科技<br/>奖励情况</td>
				<td colspan="7">'.$resultSevenData[$i]['techAward'].'</td>
			</tr>
			<tr>
				<td colspan="2">参加本项目的其实时间</td>
				<td colspan="2">'.$resultSevenData[$i]['startTime'].'</td>
				<td>完成时间</td>
				<td colspan="3">'.$resultSevenData[$i]['endTime'].'</td>
			</tr>
			<tr>
				<td>对本项目主<br/>要实质性贡<br/>献(限100字)</td>
				<td colspan="7">'.$resultSevenData[$i]['contribute'].'</td>
			</tr>
			<tr>
				<td>声明</td>
				<td colspan="7">本人严格按照《通州区科学技术奖励办法》及其实施细则的有关规定和北京市通州区科学技术委员会对申报<br/>
								工作的具体要求，如实提供了本申报推荐书及相关材料，且不存在任何违反《中华人民共和国保守国家秘密<br/>
								法》和《科学技术保密规定》等相关法律法规及侵犯他人知识产权的情形。本单位是独立法人机构。如有不<br/>符，
								本人愿意承担相关后果并接受相应的处理。</td>
			</tr>
		</table>';
	}
	$html.='
	
	<br/>&nbsp;
	<h1 style=" font-size:12pt;">八、主要证明目录</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
			<td colspan="7">1、知识产权目录(只填已授权知识产权证明)</td>
		</tr>
		<tr>
			<td>序号</td>
			<td colspan="2">授权项目名称</td>
			<td colspan="2">知识产权类别</td>
			<td>国(区)别</td>
			<td>授权号</td>
		</tr>';
		for($i=0;$i<count($resultEigth1Data);$i++){
			$j=$i+1;
			$html.='<tr>';
			$html.='<td>'.$j.'</td>';
			$html.='<td colspan="2">'.$resultEigth1Data[$i]['name'].'</td>';
			$html.='<td colspan="2">'.$resultEigth1Data[$i]['category'].'</td>';
			$html.='<td>'.$resultEigth1Data[$i]['country'].'</td>';
			$html.='<td>'.$resultEigth1Data[$i]['authorizationNum'].'</td>';
			$html.='</tr>';
		}
		$html.='
		<tr>
			<td colspan="7">2、主要技术评价证明目录</td>
		</tr>
		<tr>
			<td>序号</td>
			<td>项目名称</td>
			<td>评价形式</td>
			<td colspan="2">组织评价单位</td>
			<td>评价时间</td>
			<td>评价水平</td>
		</tr>';
		for($i=0;$i<count($resultEigth2Data);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td>'.$resultEigth2Data[$i]['name'].'</td>
				<td>'.$resultEigth2Data[$i]['evaluationForm'].'</td>
				<td colspan="2">'.$resultEigth2Data[$i]['organizationUnit'].'</td>
				<td>'.$resultEigth2Data[$i]['evaluationTime'].'</td>
				<td>'.$resultEigth2Data[$i]['evaluationLevel'].'</td>
			</tr>';
		}
		$html.='
		<tr>
			<td colspan="7">3、产品技术标准目录</td>
		</tr>
		<tr>
			<td>序号</td>
			<td colspan="2">标准名称</td>
			<td colspan="2">类别</td>
			<td colspan="2">标准号/备案号</td>
		</tr>';
		for($i=0;$i<count($resultEigth3Data);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td colspan="2">'.$resultEigth3Data[$i]['name'].'</td>
				<td colspan="2">'.$resultEigth3Data[$i]['category'].'</td>
				<td colspan="2">'.$resultEigth3Data[$i]['standardNo'].'</td>
			</tr>';
		}
		$html.='
		<tr>
			<td colspan="7">4、检测机构出具的产品检测报告等目录</td>
		</tr>
		<tr>
			<td>序号</td>
			<td>检测机构</td>
			<td colspan="2">委托单位</td>
			<td colspan="2">被检测产品名称</td>
			<td>证书编号</td>
		</tr>';
		for($i=0;$i<count($resultEigth4Data);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td>'.$resultEigth4Data[$i]['testOrg'].'</td>
				<td  colspan="2">'.$resultEigth4Data[$i]['client'].'</td>
				<td  colspan="2">'.$resultEigth4Data[$i]['proName'].'</td>
				<td>'.$resultEigth4Data[$i]['certificateNo'].'</td>
			</tr>';
		}
		$html.='
		<tr>
			<td colspan="7">5、国家法律法规要求的行业审批文件等目录</td>
		</tr>
		<tr>
			<td>序号</td>
			<td colspan="2">审批文件名称</td>
			<td>产品名称</td>
			<td>审批单位</td>
			<td>审批时间</td>
			<td>申请单位</td>
		</tr>';
		for($i=0;$i<count($resultEigth5Data);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td colspan="2">'.$resultEigth5Data[$i]['docName'].'</td>
				<td>'.$resultEigth5Data[$i]['proName'].'</td>
				<td>'.$resultEigth5Data[$i]['examUnit'].'</td>
				<td>'.$resultEigth5Data[$i]['examDate'].'</td>
				<td>'.$resultEigth5Data[$i]['appUnit'].'</td>
			</tr>';
		}
		$html.='
		<tr>
		  <td colspan="7">6、应用证明材料目录</td>
		</tr>
		<tr>
		  <td>序号</td>
		  <td>应用单位名称</td>
		  <td>联系人</td>
		  <td>电话</td>
		  <td>应用起始时间</td>
		  <td>应用完成时间</td>
		  <td>使用项目产生<br/>经济效益(万元)</td>
		</tr>';
		for($i=0;$i<count($resultEigth6Data);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td>'.$resultEigth6Data[$i]['unit'].'</td>
				<td>'.$resultEigth6Data[$i]['contact'].'</td>
				<td>'.$resultEigth6Data[$i]['phone'].'</td>
				<td>'.$resultEigth6Data[$i]['startTime'].'</td>
				<td>'.$resultEigth6Data[$i]['endTime'].'</td>
				<td>'.$resultEigth6Data[$i]['benefit'].'</td>
			</tr>';
		}
		$html.='
		<tr>
		  <td colspan="7">7、其他证明材料目录</td>
		</tr>
		<tr>
		  <td>序号</td>
		  <td>名称</td>
		  <td colspan="5">描述</td>
		</tr>';
		for($i=0;$i<count($resultEigth7Data);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td>'.$resultEigth7Data[$i]['name'].'</td>
				<td colspan="5">'.autoInsertBR($resultEigth7Data[$i]['descrip'],39).'</td>
			</tr>';
		}
		$html.='
	</table>
	
	<br/>&nbsp;
	<h1 style=" font-size:12pt;">九、推荐单位意见</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
			<td colspan="7">限400字)</td>
		</tr>
		<tr>
			<td colspan="7">'.autoInsertBR($resultAdviceData[0]['content'],54).'</td>
		</tr>
		<tr>
			<td>声明</td>
			<td colspan="6">我单位严格按照《通州区科学技术奖励办法》及其实施细则的有关规定和北京市通州区科学技术委员会对推<br/>
							荐工作的具体要求，对申报推荐书及全部附件材料进行了严格审查，确认该项目符合《通州区科学技术奖励<br/>
							办法实施细则》规定的推荐资格条件，推荐材料全部内容属实，且不存在任何违反《中华人民共和国保守国<br/>
							家秘密法》和《科学技术保密规定》等相关法律法规及侵犯他人知识产权的情形。<br/>
							我单位承诺将严格按照通州区科学技术奖励工作的相关规定和要求，认真履行作为推荐单位的义务并承担相<br/>
							应的责任。</td>
		</tr>
	</table>
	
	<br/>&nbsp;
	<h1 style=" font-size:12pt;">十、主要附件目录</h1>
	<table width="100%" border="1" cellpadding="5" align="left" style=" font-size:9pt; font-family:\'微软雅黑\';">
		<tr>
			<td colspan="2">
				<div>说明:需列出所提供的所有附件的清单，并按下列顺序排列:</div>
				<div>1、知识产权证明</div>
				<div>2、评价证明及国家法律法规要求审批的批准文件</div>
				<div>3、产品技术标准</div>
				<div>4、应用证明(必须提供一份原件)</div>
				<div>5、其他证明</div>
			</td>
		</tr>
		<tr>
			<td>序号</td>
			<td>文件名称</td>
		</tr>';
		for($i=0;$i<count($resultAttachData);$i++){
			$j=$i+1;
			$html.='
			<tr>
				<td>'.$j.'</td>
				<td>'.$resultAttachData[$i]['title'].'</td>
			</tr>';
		}
		$html.='
	</table>
	
	';
	
	$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='',$html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
	
	// ---------------------------------------------------------
	$pdf->Output('shenbaoshu.pdf', 'I');
}

function autoInsertBR($str,$len){
	preg_match_all("/./u",$str,$arr);
	$arr=$arr[0];
	$str='';
	for($i=0;$i<sizeof($arr);$i++){
		$str.=$i>0?($i%$len!=0?$arr[$i]:('<br />'.$arr[$i])):$arr[$i];
	}
	return $str;
}

function getEcnomic($economicId){
	$str='';
	switch($economicId){
		case '1':$str='农、林、牧、渔业';break;
		case '2':$str='采矿业';break;
		case '3':$str='制造业';break;
		case '4':$str='电力、燃气及水的生产和供应业';break;
		case '5':$str='建筑业';break;
		case '6':$str='交通运输、仓储和邮政业';break;
		case '7':$str='信息传输、计算机服务和软件业';break;
		case '8':$str='批发和零售业';break;
		case '9':$str='住宿和餐饮业';break;
		case '10':$str='金融业';break;
		case '11':$str='房地产业';break;
		case '12':$str='租赁和商务服务业';break;
		case '13':$str='科学研究、技术服务和地质勘查业';break;
		case '14':$str='水利、环境和公共设施管理业';break;
		case '15':$str='居民服务和其他服务业';break;
		case '16':$str='教育';break;
		case '17':$str='卫生、社会保障和社会福利业';break;
		case '18':$str='文化、体育和娱乐业';break;
		case '19':$str='公共管理和社会组织';break;
		case '20':$str='国际组织';break;
		default:;
	}
	return $str;
}

function getScience($scienceId,$db){
	$sqlScience='select * from applycat where id='.$scienceId;
	$resultScience=$db->Select($sqlScience);
	return $resultScience[0]['cat_name'];
	
}

function getSource($sourceId){
	$str='';
	switch($sourceId){
		case '1':$str='国家科技重大专项';break;
		case '2':$str='国家科技支撑计划';break;
		case '3':$str='863计划';break;
		case '4':$str='973计划';break;
		case '5':$str='其他国家计划';break;
		case '6':$str='国家自然基金';break;
		case '7':$str='北京市科技计划';break;
		case '8':$str='北京市自然基金';break;
		case '9':$str='部委计划';break;
		case '10':$str='国际合作';break;
		case '11':$str='企业';break;
		case '12':$str='自选';break;
		case '13':$str='其他';break;
		default:;
	}
	return $str;
}
?>