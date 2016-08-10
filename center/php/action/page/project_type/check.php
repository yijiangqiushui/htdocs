<?php
include '../../class/ActionBase.cls.php';
include CENTER_ROOTPATH."/modules/service/ProjectTypeService.cls.php";
include CENTER_ROOTPATH."/modules/service/ProjectCheckRelativeService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeRelativeService.cls.php";
include CENTER_ROOTPATH."/modules/service/TableTypeService.cls.php";

class ProjectCheckControl extends ActionBase{
    
    public $view_dir = "action/page/project_type";
    private $is_super = false;
    
    function getList(){
        
        //$json_str = file_get_contents("http://www.jeasyui.net/demo/treegrid_data2.json");
        //echo $json_str;
        $ptid = $_GET['ptid'];
        
        
        $data = array(
            'id'=>$ptid
        );
        
        $project_types = ProjectTypeService::instance()->get_project_type($data);
        
        if(empty($project_types)){
            //error
            exit;
        }else{
            $pt_instance = $project_types[0];
            if(!$pt_instance['is_new']){
                $pc_ptid = 0;
            }else{
                $pc_ptid = $ptid;
            }
        }
        
        /* $sql = "select a.*,b.name,b.id as slid,b.tpl_url,c.weight,c.status from table_type_relative as a 
        join subtable_list as b on(a.subtable_list_id=b.id) 
        left join project_check_relative as c on(c.project_type_id={$ptid} and a.table_type_id=c.table_type_id and a.subtable_list_id=c.subtable_id)
        where a.project_type_id={$pc_ptid} and a.para_id=0 and b.is_check=1 order by a.table_type_id asc,a.sort_id asc"; */
        
        $sql = "select a.*,b.name,b.id as slid,b.tpl_url,c.weight,c.status from table_type_relative as a
        join subtable_list as b on(a.subtable_list_id=b.id)
        left join project_check_relative as c on(c.project_type_id={$ptid} and a.table_type_id=c.table_type_id and a.subtable_list_id=c.subtable_id)
        where a.project_type_id={$pc_ptid} and (a.para_id=0 or a.table_type_id=12) and b.is_check=1 order by a.table_type_id asc,a.sort_id asc";
//         echo $sql;exit();
        $ret = TableTypeRelativeService::instance()->db->Select($sql);
        
        $parentId_arr = array();
        $footer = array(
            "name"=>"权重总计",
            "weight"=>0,
            "iconCls"=>"icon-sum"
        );
        foreach($ret as &$val){
            $val['_parentId'] = "p".$val['table_type_id'];
            if(!array_key_exists($val['table_type_id'],$parentId_arr)){
                $parentId_arr[$val['table_type_id']] = -1;
            }
            if($val['status'] !== null && $val['status'] == 0){
                $parentId_arr[$val['table_type_id']] = 0;
            }
            $val['weight'] = $val['weight']?$val['weight']:0;
            $footer['weight'] += $val['weight'];
        }
        
        //var_dump($parentId_arr);exit;
        foreach($parentId_arr as $item=>$sval){
            $table_type = TableTypeService::instance()->get(array('id'=>$item));
            $tt_name = "";
            if($table_type){
                $tt_name = $table_type[0]['name'];
            }
            $ret[] = array(
                "id"=>"p".$item,
                "status"=>$sval,
                "parentId"=>0,
                "name"=>$tt_name
            );
        }
        
        $res = array(
            'total'=>count($ret),
            'rows'=>$ret,
            'footer'=>array($footer)
        );
//         ob_clean();
        echo json_encode($res);exit;
    }
    
    function upcheck(){
        $db = new DB();
        $msgcode = 100;
        
        $val = $_POST['val'];
        $status = 0;
        $stag = 1;
        if(isset($_POST['status'])){
            $stag = 2;
            $status = $_POST['status'];
        }
        //             echo $inherit_project_sql;exit();
        
        //根据str_id获取project_type_id table_type_id
        $id = $_POST['str_id'];
        $ptid = intval($_POST['ptid']);
        $inherit_project_sql = "Select * from project_type where inherit_val = $ptid";
        $inherit_project = $db -> Select($inherit_project_sql);
        if(strpos($_POST['str_id'], "p") !== false){
            //delete content
            $table_type_id = intval(str_replace("p", "", $_POST['str_id']));
            $condition = array(
                "table_type_id"=>$table_type_id,
                "project_type_id"=>$ptid
            );
            
            $data = array(
                'status'=>$status
            );
            
            if($status == 0){
                $this->response($msgcode, $res);
            }
            
            $res = ProjectCheckRelativeService::instance()->update($condition,$data);
            //需要同步更新继承这个项目的所有继承类的项目
//             var_dump($inherit_project);exit();
            foreach($inherit_project as $pitem){
//                 echo "fffff";exit();
                $newid = $pitem['id'];
//                 $update_check_sql = "Update project_check_relative set status = $status where table_type_id = $table_type_id and project_type_id = $newid ";
//                 var_dump($condition_new);exit();
//                 $$update_check_result = $db -> Update($update_check_sql);
                $condition_new = array(
                    "table_type_id"=>$table_type_id,
                    "project_type_id"=>$pitem['id']
                );
                $res1 = ProjectCheckRelativeService::instance()->update($condition_new,$data);
            }
            
            $this->response($msgcode, $res);
        }else{
            $id = intval($id);
        }
        $condition = array(
            'id'=>$id
        );
        
        $ret = TableTypeRelativeService::instance()->get($condition);
        
        if($ret&&$ret[0]){
            $ttr = $ret[0];
            if($ttr['project_type_id'] == 0){
                $ttr['project_type_id'] = $ptid;
            }
            $data = array(
                'project_type_id'=>$ttr['project_type_id'],
                'table_type_id'=>$ttr['table_type_id'],
                'subtable_id'=>$ttr['subtable_list_id'],
                //'weight'=>$val
            );
            
            $condition = $data;
            
            $res = ProjectCheckRelativeService::instance()->get($condition);
            $is_up = true;
            if(empty($res)){
                $is_up = false;
            }
            $up_data = array();
            if($stag == 2){
                $data['status'] = $status;
                $up_data['status'] = $status;
            }else{
                $data['weight'] = $val;
                $up_data['weight'] = $val;
            }
            
            if($is_up){
                $res = ProjectCheckRelativeService::instance()->update($condition,$up_data);
                //同步更新其继承的项目
                foreach($inherit_project as $pitem){
                    /* var_dump($expression);exit();
                    echo "4444";exit(); */
                    $data['project_type_id'] = $pitem['id'];
                    $res_new = ProjectCheckRelativeService::instance()->update($condition,$up_data);
                }
            }else{
                $res = ProjectCheckRelativeService::instance()->insert($data);
                foreach($inherit_project as $pitem){
                    $data['project_type_id'] = $pitem['id'];
                    $res_new = ProjectCheckRelativeService::instance()->insert($data);
                }
            }
            
        }else{
            $msgcode = 101;
        }
        
        $this->response($msgcode, $res);
    }
    
    function index(){
        if($_GET['ptid']){
            $_SESSION['pt_edit_id'] = intval($_GET['ptid']);
        }
        $this->display("checktable.php");
    }
    
}
$task = new ProjectCheckControl();

$task->run();