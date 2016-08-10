<?php
require_once('../config.ini.php');

$link = mysql_connect(ServerName,UserName,PassWord);
@mysql_query("SET NAMES 'utf8'");  

$dbname = DBName;

$tables = mysql_list_tables($dbname);
while ($table = mysql_fetch_row($tables)) {
   $cachetables[$table[0]] = $table[0];
   $tableselected[$table[0]] = 1;
}

$table = $cachetables;
$path = ROOTPATH.'data_backup/'. date("Y-m-d", time()) . "-bak.sql";
$filehandle = fopen($path, "w");
$result = mysql_query("SHOW tables");
while ($currow = mysql_fetch_array($result)) {
   if (isset($table[$currow[0]])) {
     sqldumptable($currow[0], $filehandle);
     fwrite($filehandle, "\r\n\r\n\r\n");
   } 
} 
fclose($filehandle);

// data dump functions
function sqldumptable($table, $fp = 0) {

        $tabledump = "DROP TABLE IF EXISTS $table;\r\n";       
        $result = mysql_fetch_array(mysql_query("SHOW CREATE TABLE $table"));
        //echo "SHOW CREATE TABLE $table";
        $tabledump .= $result[1] . ";\r\n";
        
        if ($fp) {
                fwrite($fp, $tabledump);
        } else {
                echo $tabledump;
        } 
        // get data
        $rows = mysql_query("SELECT * FROM $table");
        // $numfields=$DB->num_fields($rows);
        $numfields = mysql_num_fields($rows);
        while ($row = mysql_fetch_array($rows)) {
                $tabledump = "INSERT INTO $table VALUES(";

                $fieldcounter = -1;
                $firstfield = 1; 
                // get each field's data
                while (++$fieldcounter < $numfields) {
                        if (!$firstfield) {
                                $tabledump .= ", ";
                        } else {
                                $firstfield = 0;
                        }

                        if (!isset($row[$fieldcounter])) {
                                $tabledump .= "NULL";
                        } else {
                                $tabledump .= "'" . mysql_escape_string($row[$fieldcounter]) . "'";
                        } 
                }

                $tabledump .= ");\r\n";

                if ($fp) {
                        fwrite($fp, $tabledump); 
                } else {
                        echo $tabledump;
                } 
        } 
       mysql_free_result($rows);
}


?>

<script type="text/javascript">
//用于跳出框架
if (self!=top)
	window.top.location.replace(self.location);
window.location.href="/";

</script>