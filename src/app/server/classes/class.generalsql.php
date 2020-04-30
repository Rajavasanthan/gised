<?php

class generalsql {

    function userRequestList() {

        $sql = "SELECT  
                    fstd.r_gised_id AS gised_id, 
                    concat(du.title,'. ',du.first_name,' ',du.last_name) AS user_name,
                    du.email_id, 
                    du.mobile_no 
                FROM 
                    fact_status_tracking_details fstd, 
                    dm_user du,
                    dm_status ds 
                WHERE 
                    du.user_id = fstd.r_user_id 
                    and ds.status_id = fstd.r_status_id 
                    group by fstd.r_gised_id 
                    order by fstd.update_date_time desc";

        return $sql;

    }

}

?>