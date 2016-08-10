<?php
/**
 * 查重任务的封装
 *
 * @author 风格独特
 */

require_once __DIR__ . '/db/config.zhujian.php';
require_once __DIR__ . '/db/db.cls.php';

class Task
{
    public static function getNext()
    {
        $conn = mysql_connect(SERVERNAME, USERNAME, PASSWORD);
        mysql_select_db('check', $conn);

        $sql = 'select * from check_task where `status`=0 order by `id` ASC limit 1';
        $result = mysql_query($sql, $conn);
        if (mysql_num_rows($result) <= 0) {
            return false;
        }

        $row = mysql_fetch_assoc($result);
        $param = @json_decode($row['param'], true);

        return array(
            'id'        => $row['id'],
            'param'     => $param,
            'status'    => $row['status'],
            'content'    => $row['content'],
        );
    }

    public static function finish($task_id)
    {
        $conn = mysql_connect(SERVERNAME, USERNAME, PASSWORD);
        mysql_select_db('check', $conn);

        $task_id = (int) $task_id;
        $time = time();
        $sql = "update check_task set `status`=1, `finish_time`={$time} where `id`={$task_id}";

        mysql_query($sql, $conn);
        mysql_close($conn);
    }

    public static function add($param = array(),$content,$project_id)
    {
        $conn = mysql_connect(SERVERNAME, USERNAME, PASSWORD);
        mysql_select_db('check', $conn);

         $sql_filter = "SELECT project_id  FROM check_task  ORDER BY id DESC LIMIT 0,1;" ; //
         mysql_query("set names utf8");
         $result_filter = mysql_query($sql_filter,$conn);
         $overview_filter = mysql_fetch_array($result_filter);
        if($overview_filter[0]==$param['project_id'])  
        {
            file_put_contents(dirname(__FILE__)."/error_api_checkReport.log", '@1 = '.$overview_filter[0].'    ||    '.$param['project_id'],FILE_APPEND);  
        
        }
        else { 
             file_put_contents(dirname(__FILE__)."/error_api_checkReport.log", '#1 = '.$overview_filter[0].'    ||    '.$param['project_id'],FILE_APPEND);  
        
                     $data = mysql_real_escape_string(json_encode($param));
                    $time = time();
                    // $content = str_replace("\\","\\\\",$content);
                    $content = mysql_real_escape_string($content);
                    $sql = "insert into check_task (`param`, `status`, `add_time`,`content`,`project_id`) values ('{$data}', 0, {$time},'".$content."','".$project_id."')";
                    mysql_query($sql, $conn);
                    mysql_close($conn);
        }

     
    }

    public static function status($project_id)
    {
        $db = new DB();
        $status = $db->GetInfo1($project_id, 'check_status', 'project_id');

        if (isset($status['html']) && ! empty($status['html'])) {
            return true;
        }
        return false;
    }

 public static function addError($param = array(),$content)
    {
        $conn = mysql_connect(SERVERNAME, USERNAME, PASSWORD);
        mysql_select_db('check', $conn);

        $data = mysql_real_escape_string(json_encode($param));
        $time = time();
        // $content = str_replace("\\","\\\\",$content);
        $content = mysql_real_escape_string($content);
        $sql = "insert into check_task (`param`, `status`, `add_time`,`content`) values ('{$data}', 2, {$time},'".$content."')";
        mysql_query($sql, $conn);
        mysql_close($conn);
    }


}

//Task::add(array(
//    'aa'    => 'bbb',
//    'ccc'   => 'ddd',
//));

//$task = Task::getNext();
//
//Task::finish($task['id']);

//var_dump(Task::status('dev1451714872'));