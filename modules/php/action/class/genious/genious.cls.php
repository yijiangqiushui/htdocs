<?php 
class Genious
{
    function findStateMent($project_id,$statement,$flag)
    {
        $db = new DB();
        $result = $db->GetInfo2($project_id, 'genious_info', 'project_id',$statement['flag'],'flag'); 
        $data = array(
            'statement' => $result['statement']
        );
        if($flag=="pdf"){
        	$db->Close();
        	return $data;
        }
        echo json_encode($data);
        $db->Close();
    }
    
    function saveStateMent($project_id,$name,$parameters,$index_id)
    {
        $db = new DB();
        $result = $db->UpdateData2($name, $project_id, $parameters, $index_id,$parameters['flag'],'flag');
        echo $result;
        $db->Close();
    }
}
?>