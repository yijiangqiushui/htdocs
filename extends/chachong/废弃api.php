<?php
/**
 * 查重提交接口
*
 * @author 风格独特
*/

require_once __DIR__ . '/../../common/php/lib/ActionBase.cls.php';
require_once __DIR__ . '/Task.php';


class Api extends ActionBase
{
    public function index()
    {
        $param = array(
            'project_id'    => $_REQUEST['project_id'],
            'project_type'  => $_REQUEST['project_type'],
            'org_name'      => $_REQUEST['org_name'],
            'project_name'  => $_REQUEST['project_name'],
        );

        Task::add($param);
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
