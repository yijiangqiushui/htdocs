<?php
/**
 * 此接口用来处理获取和增加子表格数据
 *
 * @author 风格独特
 */

require_once __DIR__ . '/../../common/php/lib/ActionBase.cls.php';
require_once __DIR__ . '/TableData.php';
require_once __DIR__ . '../../../common/php/lib/db.cls.php';

class Api extends ActionBase
{
    public function save()
    {
        //destroy variable
        unset($_REQUEST['action']);

        $project_id = project_id();
        $subtable_id = isset($_REQUEST['subtable_id']) ? $_REQUEST['subtable_id'] : '';

        TableData::save($project_id, $subtable_id, $_REQUEST);
    }

    public function get()
    {
        $project_id = project_id();
        $subtable_id = isset($_REQUEST['subtable_id']) ? $_REQUEST['subtable_id'] : '';
        $data = TableData::get($project_id, $subtable_id);
        if($subtable_id==31 && $data['org_name'] == null){
        	$db = new DB();
        	$res1 = $db->GetInfo1($project_id, 'project_info', 'project_id');
        	$org_code = $res1['org_code'];
        	$res = $db->GetInfo1($org_code, 'org_info', 'org_code');
        	$data['data']['org_name'] = $res['org_name'];
        	$data['data']['business_id'] = $res1['business_id'];
        	$data['data']['project_name'] = $res1['project_name'];
        }
        echo TableData::easyuiJson($data['data']);
    }
    
}
//get project_id
function project_id()
{
    //judge whether variable exist.
    if (isset($_GET['project_id'])) {
        $project_id = $_GET['project_id'];
    } else if (isset($_SESSION['project_id'])) {
        $project_id = $_SESSION['project_id'];
    } else {
        $project_id = '';
    }
    return $project_id;
}

$api = new Api();
$api->run();