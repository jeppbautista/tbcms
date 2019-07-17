<?php
function getAllElementsWithCondition($table, $column, $condition)
{
  $query = "select * from ".$table." WHERE ".$column."='" . $condition . "'";
  $rs = mysql_query($query);
  $row = mysql_fetch_assoc($rs);
  return $row;
}

function getAllElements($table)
{
  $query = "select * from ".$table."";
  $rs = mysql_query($query);
  $row = mysql_fetch_assoc($rs);
  return $row;
}
?>
