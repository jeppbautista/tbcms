<?php

// function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
//     return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
// }
//
date_default_timezone_set('Asia/Manila');

class eudodona_model
{
    public function database_connect()
    {
        if (false == true)
        {
            $conn = @mysql_connect('localhost', 'root', '');
        }
        else{
            $conn = @mysql_connect('ebitshares.ipagemysql.com', 'urfren_samson', '091074889701_a');
        }
        if (!$conn) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db('xdb_tbcmerchantservices', $conn);
    }

    public function get_tableid(){
        /* If the number of people in a table is greater than or equal to 7 then create new table by
        Max(table_id) + 1 else return the maximum table_id of the current table id */
        $table_id_query = "
            SELECT IFNULL(table_id, 1) as table_id
            FROM (
              SELECT CASE WHEN (
                SELECT COUNT( 1 )
                FROM `xtbl_eudodona`
                WHERE table_id = (SELECT MAX(table_id) FROM xtbl_eudodona)
              ) = 7
                THEN MAX( table_id ) +1
                ELSE MAX( table_id )
              END AS table_id
            FROM xtbl_eudodona
            WHERE table_id = (SELECT MAX(table_id) FROM xtbl_eudodona)

            ) eudodona
        ";

        $table_id_rs = mysql_query($table_id_query);
        $table_id_row = mysql_fetch_assoc($table_id_rs);
        return $table_id_row["table_id"];
    }

    public function get_rank() {
        /* If there is row in the table id then return the Maximum rank + 1 else if the table is empty return 1 */
        $rank_query = "
        SELECT
            CASE WHEN (
                SELECT MAX(rank)
                FROM xtbl_eudodona
                ) IS NOT NULL
                THEN (
                    SELECT MAX(rank) + 1
                    FROM xtbl_eudodona
                    )
            ELSE 1
        END AS rank
        ";
        $rank_rs = mysql_query($rank_query);
        $rank_row = mysql_fetch_assoc($rank_rs);
        return $rank_row["rank"];
    }

    public function checkAllPaid($tableId){
        $paid_query = "
        SELECT COUNT(1) AS paid
        FROM xtbl_eudodona
        WHERE table_id = '$tableId'
            AND paid = 1
        ";
        $paid_rs = mysql_query($paid_query);
        $paid_row = mysql_fetch_assoc($paid_rs);
        if($paid_row['paid'] == 7){
            return 1;
        }else {
            return 0;
        }
    }

    public function update_main_payment(){
      $unpaid_query = "
        SELECT *
        FROM xtbl_eudodona
        WHERE table_id = 1
          AND paid = 0
        ORDER BY rank
      ";
      $unpaid_rs = mysql_query($unpaid_query);
      $unpaid_count = mysql_num_rows($unpaid_rs);
      $unpaid_rows  = mysql_fetch_assoc($unpaid_rs);

      $paid_query = "
        SELECT *
        FROM xtbl_eudodona
        WHERE table_id <> 1
          AND paid = 1
        ORDER BY rank
      ";
      $paid_rs = mysql_query($paid_query);
      $paid_count = mysql_num_rows($paid_rs);
      $paid_rows  = mysql_fetch_assoc($paid_rs);

      if ($unpaid_count > 0){
        $x = 0;
        $y = 0;
        while ( $x < $unpaid_count && $y < $paid_count) {

          mysql_data_seek($unpaid_rs, $x);
          $unpaid_sq = mysql_fetch_array($unpaid_rs);
          $unpaid_ctr = $unpaid_sq['MainCtr'];

          mysql_data_seek($paid_rs, $y);
          $paid_sq  = mysql_fetch_array($paid_rs);
          $paid_ctr = $paid_sq['MainCtr'];

          $q1 = "
            UPDATE xtbl_eudodona
            SET paid = 1
            WHERE MainCtr = '$unpaid_ctr'
          ";
          mysql_query($q1);

          $q2 = "
            UPDATE xtbl_eudodona
            SET paid = 0
            WHERE MainCtr = '$paid_ctr'
          ";
          mysql_query($q2);

          // echo "<script>console.log(".json_encode($unpaid_sq).")</script>";
          // echo "<script>console.log(".json_encode($paid_sq).")</script>";

          $x++;
          $y++;
        }
      }

    }

    public function update_edudona_cycle(){
      $exit_query = "
        SELECT * FROM xtbl_eudodona WHERE rank = 1";
      $rs = mysql_query($exit_query);
      $row = msyql_fetch_assoc($rs);

      $Mainctr = $row['MainCtr'];
      $username = $row['username'];
      $refcode = $row['refcode'];
      $datetime = date('Y-m-d H:i:s');

      $insert_query = "
        INSERT INTO xtbl_edudona_trans (MainCtr, username, refcode, datetime)
        VALUES ('$Mainctr', '$username', '$refcode', '$datetime')
      ";
      mysql_query($insert_query);
    }


    public function update_ranks($tableId){
      $count_query = "
        SELECT COUNT(1) AS row_count FROM xtbl_eudodona
      ";
      $rs = mysql_query($count_query);
      $rs_row = mysql_fetch_assoc($rs);

      $max = $rs_row["row_count"];

        for ($i = 1; $i <= $max; $i++)
        {
            $ii = $i - 1;
            $q = "UPDATE xtbl_eudodona SET rank = '$ii' WHERE rank = '$i'";
            mysql_query($q);
        }
        $q2 = "UPDATE xtbl_eudodona SET rank = '$max' WHERE rank = 0";
        mysql_query($q2);
        $q5 = "UPDATE xtbl_eudodona SET table_id = 2 WHERE rank='$max'";
        mysql_query($q5);
        $q3 = "UPDATE xtbl_eudodona SET paid = 0 WHERE table_id = '$tableId'";
        mysql_query($q3);
        $q4 = "UPDATE xtbl_eudodona SET table_id = 1 ORDER BY rank  LIMIT 7;  ";
        mysql_query($q4);


    }

    public function update_table(){
      $table_query = "
        UPDATE xtbl_eudodona SET table_id = CEILING(rank/7)
      ";
      @mysql_query($table_query);
    }

    public function update_wallet($tableId){
      $exit_query = "
          SELECT MainCtr
          FROM xtbl_eudodona
          WHERE table_id = '$tableId'
              AND rank = 1
      ";
      $exit_rs = mysql_query($exit_query);
      $ctr = mysql_fetch_assoc($exit_rs)["MainCtr"];

      $wallet_query = "
        SELECT *
        FROM xtbl_eudodona_wallet
        WHERE MainCtr = '$ctr'
      ";

      $wallet_rs = mysql_query($wallet_query);
      $balance = mysql_fetch_assoc($wallet_rs)["Balance"];

      $new_balance = $balance + 2500;

      $update_wallet = "
        UPDATE xtbl_eudodona_wallet
        SET balance = '$new_balance'
        WHERE MainCtr = '$ctr'
      ";
      mysql_query($update_wallet);
    }

    public function reset_wallet(){

    }

}
?>
