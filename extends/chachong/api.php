<?php
/**
 * 查重提交接口
*
 * @author 风格独特
*/

require_once __DIR__ . '/db/ActionBase.cls.php';
require_once __DIR__ . '/Task.php';
require_once __DIR__ . '/db/config.zhujian.php';

class Api extends ActionBase
{
    public function index()
    {
        $param = array(
            'project_id'    => $_REQUEST['project_id'],
            'project_type'  => urldecode($_REQUEST['project_type']),
            'org_name'      => urldecode($_REQUEST['org_name']),
            'project_name'  => urldecode($_REQUEST['project_name']),
        );


$url_all = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];        
file_put_contents(dirname(__FILE__)."/error_api_checkReport.log", 'visit url = '.$url_all.'    || ',FILE_APPEND);  

    $url = REMOTE_PROJECT.'/website/html/view/template/apply/checkReport.php?action=find&project_id=' .  $_REQUEST['project_id'];
    $content = file_get_contents($url);
// file_put_contents(dirname(__FILE__)."/error_2.log", $url.'  __   '.$content,FILE_APPEND);    // 陈欢说注释这里是log.v()

if(!isset($_REQUEST['project_name']) || empty($_REQUEST['project_name']))
{
     Task::addError($param,$content);
}
else
{
         Task::add($param,$content,$_REQUEST['project_id']);
}

    }

    public function status()
    {
        if (Task::status($_GET['project_id'])) {
            echo '1';
        } else {
            echo '0';
        }
    }
}

$api = new Api();
$api->run();
