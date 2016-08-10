<?php
/**
 * Copyright (c) 2016 Qiansong Inc. All rights reserved.
 *
 * control.php
 *
 * @project    project_apply
 * @author     frank
 * @version    control.php 1.0 16/1/15 14:28 frank
 */
include '../../class/ActionBase.cls.php';
include CENTER_ROOTPATH."/modules/service/ProjectTypeService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectTypeRelativeService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeRelativeService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeService.cls.php";
include CENTER_ROOTPATH."/modules/service/AdminInfoService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectCheckUserListService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProPriListDao.cls.php";
include CENTER_ROOTPATH."/modules/service/ProCheckPriMapDao.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectInfoService.cls.php";

class ProjectListControl extends ActionBase
{

    public $view_dir = "action/page/project_type";
    private $is_super = false;

    function checkAdmin()
    {
        $status = 1; //0，表示超级管理员或者管理员授权  1表示普通用户
        if ($_SESSION['user_type'] == 2 || $_SESSION['user_type'] == 3) {
            $status = 0;
        }
        $this->admin_tag = $status;

        if (3 == $_SESSION['user_type']) {
            $this->is_super = true;
        }
    }

    function editProEngi()
    {

        $msgcode = 300;

        $project_id = trim($_POST['project_id']);
        $project_engineer = trim($_POST['project_engineer']);

        $project_id_arr = explode("|",$project_id);
        $ret = array();

        if($project_id_arr){
            foreach($project_id_arr as $val) {
                $condition = array(
                    'project_id' => $val
                );

                $data = array(
                    'project_engineer' => $project_engineer
                );

                $ret[] = ProjectInfoService::instance()->update($condition, $data);
            }
        }

        $this->response($msgcode,$ret);

    }

    function checkAcc(){

        $msgcode  = 200;
        $ret  = array();
        $data = array(
            'is_check'=>1
        );
        $p_row = $_POST['selRows'];

        foreach($p_row as $val) {

            $condition = array(
                'project_id'=>$val
            );

            $ret[] = ProjectInfoService::instance()->update($condition,$data);

        }

        $this->response($msgcode,$ret);

    }

}

$task = new ProjectListControl();

$task->run();
