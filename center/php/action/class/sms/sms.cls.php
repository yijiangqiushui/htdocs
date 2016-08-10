<?php
class SMS {
    //查询信息并调用存储的信息;
    function findInfo($project_id){
        $db = new DB();
        $project_info = $db -> GetInfo1($project_id, 'project_info', 'project_id');//project_info中的user_id是admin_id
        $login_info = $db -> GetInfo1($project_info['org_code'],'login_info','org_code');//这里的phone是smsPhone
        $db -> Close();
        return $this -> storeSms($project_info['user_id'], $login_info['celphone'], $project_info['project_stage']);
    }
    //存储信息 这个需要在check_list.js中立项、中期、验收时调用;
    function storeSms($admin_id,$smsPhone,$project_stage){
        $db = new DB();
        $reslutJson = array();
        $data['sendtime'] = date("Y-m-d H:i:s",time());
        $data['smsPhone'] = $smsPhone;
        $data['admin_id'] = $admin_id;
        switch ($project_stage){
            case 1:
                $data['content'] = '已开启立项';
                break;
            case 2:
                $data['content'] = '已开启中期';
                break;
            case 3:
                $data['content'] = '已开启验收';
                break;
        }
        $id = $db -> InsertData('smsinfo', $data);
        $db -> Close();
        if($id > 0){
            $db = new DB();
            $result = $db -> GetInfo($id,'smsinfo');
            $db -> Close();
            //调用java发送信息;
            $this -> sendToPhone($id, $admin_id, $smsPhone, $result['isSent']);
        }else{
            $reslutJson['code'] = "fail";
            echo json_encode($reslutJson);
        }
    }
    //发送信息    
    function sendToPhone($id,$admin_id,$smsPhone,$isSent){
        $db=new DB();
        $sql="select isSent,content from smsinfo where id = $id";
        $result=$db->Select($sql);
        $content=$result[0]['content'];
        if($result[0]['isSent']=='1'){
            $sql="update smsinfo set isSent='$isSent' where id = $id";
            $db->Update($sql);
        }else{
            $isSent=$result[0]['isSent'];
        }
        $db->Close();
        $url = "http://".$_SERVER["HTTP_HOST"].":83/message/msgsend.htm?isSent=".$isSent."&smsPhone=".$smsPhone."&content=".$content."&id=".$id;
        $ch = curl_init();
				
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT,10);
        $img = curl_exec($ch);
        curl_close($ch);
        print_r($img);
    }
    //短信批量发送
    //查询要发送的信息;
    function findSmsInfo($list,$context){
        $list = explode(",",$list);
        $count = count($list);
        $admin_id = '';
        $smsPhone = '';
        foreach ($list as $k=>$v){
            $db = new DB();
            $project_info = $db -> GetInfo1($v, 'project_info', 'project_id');//project_info中的user_id是admin_id
            $login_info = $db -> GetInfo1($project_info['org_code'],'login_info','org_code');//这里的phone是smsPhone
            $linkman = $project_info['linkman'];
            if(empty($project_info['linkman'])){
                $linkman = $login_info['real_name'];
            }
            $linkman_contact = $project_info['linkman_contact'];
            if(empty($project_info['linkman_contact'])){
                $linkman_contact = $login_info['celphone'];                 
            }
            $smsPhone = $smsPhone.$linkman_contact.';';
            $admin_id = $admin_id.$project_info['user_id'].';';
            $db -> Close();
        }
        $id = $this->batchStoreSms($admin_id, $smsPhone, $context);
        if($id > 0){
            $db = new DB();
            $result = $db -> GetInfo($id, 'smsinfo');
            $db -> Close();
            $this -> sendToPhone($id, $admin_id, $smsPhone, $result['isSent']);
        }else{
            $resultJson['success'] = "false";
            echo json_encode($resultJson);
        }
    }
    //批量发送的存储函数;
    function batchStoreSms($admin_id,$smsPhone,$context){
        $db = new DB();
        $data['sendtime'] = date("Y-m-d H:i:s",time());
        $data['smsPhone'] = $smsPhone;
        $data['admin_id'] = $admin_id;
        $data['content'] = $context;
        $result = $db -> InsertData('smsinfo', $data);
        $db -> Close();
				
        return $result;
    }
		//查询失败的联系人信息和电话号码;
		function findFailInfo($id){
		     $db = new DB();
				 $result = $db -> GetInfo($id,'smsinfo');
				 $smsPhone = explode(";",$result['smsPhone']);
				 $isSent = explode(";",$result['isSent']);
				 $i = 0;	
				 foreach($isSent as $k => $v){
				    if($v == 1){
							 $resultJson[$i]['phone'] = $smsPhone[$k]; 
						   $project_info = $db -> GetInfo1($smsPhone[$k],'project_info','linkman_contact');	
							 if(empty($project_info)){
								  $login_info = $db -> GetInfo1($smsPhone[$k],'login_info','celphone');
									$resultJson[$i]['linkman'] = $login_info['realname'];  
							 }else{
							     $resultJson[$i]['linkman'] = $project_info['linkman'];
							 }
							 $i++;
						}
				 }
				 echo json_encode($resultJson);
		}
}
