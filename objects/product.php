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
?>
