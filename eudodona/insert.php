<?php

    include 'model.php';
    $model = new eudodona_model;
    $model->database_connect();

    $Mainctr = 1;
    # TODO get MainCTR

    $account_query="select * from xtbl_account_info WHERE Main_Ctr='$Mainctr'";
    $account_rs = mysql_query($account_query);
    $account_row = mysql_fetch_assoc($account_rs);

    $main_query="select * from xtbl_main_info WHERE Ctr='$Mainctr'";
    $main_rs = mysql_query($main_query);
    $main_row = mysql_fetch_assoc($main_rs);

    $username = $account_row['Username'];
    $refcode  = $main_row['Sponsor_Id'];

    # get tableID
    # get rank
    # get paid

    # check if already in table
    $eudodona_query="select * from xtbl_eudodona WHERE username='$username'";
    $eudodona_rs=mysql_query($eudodona_query);
    $eudodona_count_rows=mysql_num_rows($eudodona_rs);


    if ($eudodona_count_rows < 1) # if not existing in table
    {
        $table_id = $model->get_tableid($refcode);
        $rank = $model->get_rank($table_id, $refcode);
        $paid = 1;

        $query="insert into xtbl_eudodona(MainCtr, username, refcode, table_id, rank, paid) values('$ctr','$username', '$refcode', '$table_id', '$rank', '$paid')";
        mysql_query($query);
    }
    else{
        $query = "UPDATE xtbl_eudodona SET paid = 1 WHERE username = '$username'";
        mysql_query($query);

        $query = "SELECT table_id FROM xtbl_eudodona WHERE username = '$username'";
        $rs = mysql_query($query);
        $row = mysql_fetch_assoc($rs);
        $table_id = $row['table_id'];
    }

    // check if all are paid
    if($model->checkAllPaid($table_id, $refcode) == 1){
        #TODO fix payment system
        $model->update_ranks($table_id, $refcode);
    }

?>
