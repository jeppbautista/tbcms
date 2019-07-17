<?php
function readByID($ids){
  $ids_arr = implode(", ", $ids);
  $query = "
            SELECT Ctr,
              Product_Name,
              Product_Description,
              Product_Price,
              Image
            FROM xtbl_product WHERE Ctr IN ($ids_arr)";

  return $query;
}

function getProducts($product){
  $query = "select * from xtbl_product WHERE Ctr='" . $product . "'";
  $rs = mysql_query($query);
  $row = mysql_fetch_assoc($rs);
  return $row;
}



?>
