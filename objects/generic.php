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

function getLatestCtr($table){
  $query = "
    SELECT Ctr FROM ".$table."
    ORDER BY Ctr DESC
    LIMIT 1
  ";
  $rs = @mysql_query($query);
  return @mysql_fetch_assoc($rs)['Ctr'];
}
function updateWithCondition($table, $updateColumn, $updateValue, $conditionColumn, $conditionValue){
  $query = "
    UPDATE ".$table."
    SET ".$updateColumn." = ".$updateValue."
    WHERE ".$conditionColumn." = ".$conditionValue."
  ";
  return $query;
}

?>
