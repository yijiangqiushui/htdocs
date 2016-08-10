<?php

$sql = "select * from project_type";
$show = new ShowProject();
$show->showProjects($sql);