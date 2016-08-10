<?php
class ShowProject
{
    function showProjects($sql)
    {
        $db = new DB();
        $data = $db->Select($sql);
        echo json_encode($data);
    }
}