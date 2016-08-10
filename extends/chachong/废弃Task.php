<?php
/**
 * 查重任务的封装
 *
 * @author 风格独特
 */

require_once __DIR__ . '/../../common/php/config.ini.php';
require_once __DIR__ . '/../../common/php/lib/db.cls.php';

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
    }

    public static function add($param = array())
    {
        $conn = mysql_connect(SERVERNAME, USERNAME, PASSWORD);
        mysql_select_db('check', $conn);

        $data = mysql_real_escape_string(json_encode($param));
        $time = time();
        $sql = "insert into check_task (`param`, `status`, `add_time`) values ('{$data}', 0, {$time})";
        mysql_query($sql, $conn);
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
}

//Task::add(array(
//    'aa'    => 'bbb',
//    'ccc'   => 'ddd',
//));

//$task = Task::getNext();
//
//Task::finish($task['id']);

//var_dump(Task::status('dev1451714872'));