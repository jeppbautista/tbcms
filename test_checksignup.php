<?php 
$link = mysql_connect('ebitshares.ipagemysql.com', 'dev_user', '2019TBCMScsbn7270#####$$$$$$'); 
if (!$link) { 
    die('Could not connect: ' . mysql_error()); 
} 
echo 'Connected successfully'; 
mysql_select_db('xdb_tbcmerchant8080'); 
?> 