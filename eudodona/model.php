<?php 

function isLocalhost($whitelist = ['127.0.0.1', '::1']) {
    return in_array($_SERVER['REMOTE_ADDR'], $whitelist);
}

class eudodona_model
{
    public function database_connect()
    {
        if (isLocalhost()== true)
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

    public function get_tableid($refcode){
        /* If the number of people in a table is greater than or equal to 7 then create new table by 
        Max(table_id) + 1 else return the maximum table_id of refcode */
        $table_id_query = "
            SELECT IFNULL(table_id, SELECT MAX()) as table_id 
            FROM (
                SELECT CASE WHEN (
                    SELECT COUNT(1) 
                    FROM xtbl_eudodona
                        WHERE refcode = '$refcode'
                        AND table_id = (
                            SELECT MAX(table_id) 
                            FROM xtbl_eudodona
                            WHERE refcode = '$refcode'
                        )) >= 7

                    THEN MAX(table_id) + 1 
                    ELSE MAX(table_id)

                END AS table_id
      
                FROM xtbl_eudodona
                WHERE refcode = '$refcode' ) eudodona
        ";
        $table_id_rs = mysql_query($table_id_query);
        $table_id_row = mysql_fetch_assoc($table_id_rs);
        return $table_id_row["table_id"];
    }

    public function get_rank($tableId, $refcode) {
        /* If there is row in the table id then return the Maximum rank + 1 else if the table is empty return 1 */
        $rank_query = "
        SELECT 
            CASE WHEN (
                SELECT MAX(rank)
                FROM xtbl_eudodona
                WHERE table_id = '$tableId'
                AND refcode = '$refcode') IS NOT NULL

                THEN (
                    SELECT MAX(rank) + 1
                    FROM xtbl_eudodona
                    WHERE table_id = '$tableId'
                    AND refcode='$refcode')
            ELSE 1
        END AS rank
        ";
        $rank_rs = mysql_query($rank_query);
        $rank_row = mysql_fetch_assoc($rank_rs);
        return $rank_row["rank"];
    }

    public function checkAllPaid($tableId, $refcode){
        $paid_query = "
        SELECT COUNT(1) AS paid
        FROM xtbl_eudodona
        WHERE refcode = '$refcode'
            AND table_id = '$tableId'
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


    public function update_ranks($tableId, $refcode){
        for ($i = 1; $i <= 7; $i++)
        {
            $ii = $i - 1;
            $q = "UPDATE xtbl_eudodona SET rank = '$ii' WHERE rank = '$i' AND table_id = '$tableId' AND refcode='$refcode'";
            mysql_query($q);
        }
        $q2 = "UPDATE xtbl_eudodona SET rank = 7 WHERE rank = 0 AND table_id = '$tableId'  AND refcode='$refcode'";
        mysql_query($q2);
        $q3 = "UPDATE xtbl_eudodona SET paid = 0 WHERE table_id = '$tableId'  AND refcode='$refcode'";
        mysql_query($q3);

        echo "UPDATE COMPLETE";
    }


}
?>