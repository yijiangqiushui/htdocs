<?php
/**
 * 处理请求
 *
 * @author 风格独特
 */
require __DIR__ . '/curl/curl.php';

$project_id = 'dev1451705148';
$url = 'http://192.168.1.171/website/html/view/template/apply/main_plan.php?action=find&amp&project_id=' . $project_id;

$content = file_get_contents($url);

$data = array(
    'content'   => $content,
);

$post_url = "http://226.bjqskj.com:8080/getCmd.php";
$curl = new Curl();
$res = $curl->post($data, $post_url);


echo $res;