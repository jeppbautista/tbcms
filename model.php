<?php

// function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
//     return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
// }

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

    public function get_rank($tableId) {
        /* If there is row in the table id then return the Maximum rank + 1 else if the table is empty return 1 */
        $rank_query = "
        SELECT
            CASE WHEN (
                SELECT MAX(rank)
                FROM xtbl_eudodona
                WHERE table_id = '$tableId'
                ) IS NOT NULL

                THEN (
                    SELECT MAX(rank) + 1
                    FROM xtbl_eudodona
                    WHERE table_id = '$tableId'
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
        $q3 = "UPDATE xtbl_eudodona SET paid = 0 WHERE table_id = '$tableId' AND rank<>'$max'";
        mysql_query($q3);

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
