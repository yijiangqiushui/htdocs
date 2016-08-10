<?php
/**
 * 定期处理查重的文件
 *
 * @author 风格独特
 */


require_once __DIR__ . '/Task.php';
// require_once __DIR__ . '/db/config.zhujian.php';
// require_once __DIR__ . '/db/db.cls.php';
require_once __DIR__ . '/../../common/php/config.ini.php';
require_once __DIR__ . '/../../common/php/lib/db.cls.php';

while($task = Task::getNext()) {
    //用户提交的参数
    $param = $task['param'];
//-----start------------这里面生成查重的结果的html文件生成----------------
$htmlstr = '<body>yesyesyes!</body>';


$writePath=ROOT_PATH.'index_award/include_reward_tab_'.$category.'.htm';
write2File($writePath,$str2file);
$htmlurl= $htmlstr;  //这里修改为一个地址
// -----end----------这里面生成查重的结果的html文件生成----------------
$db = new DB();
$data= array(
            'html'  => $htmlurl // 这里放html文件生成的路径即可
            // 今天下午重点就是修改这句话
        );
     $status = $db->UpdateData1( 'check_status', $param['project_id'], $data, 'project_id');


    // 完成这个任务
    Task::finish($task['id']);
}