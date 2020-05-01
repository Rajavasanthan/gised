<?php

class generalsql {

    function userRequestList() {

        $sql = "SELECT  
                    fstd.r_gised_id AS gised_id, 
                    concat(du.title,'. ',du.first_name,' ',du.last_name) AS user_name,
                    du.email_id, 
                    du.mobile_no,
                    ds.status_value   
                FROM 
                    fact_status_tracking_details fstd, 
                    dm_user du,
                    dm_status ds,
                    dm_gised_form dgf 
                WHERE 
                    du.user_id = fstd.r_user_id 
                    and dgf.r_status_id = fstd.r_status_id 
                    and ds.status_id = dgf.r_status_id
                    group by fstd.r_gised_id 
                    order by fstd.update_date_time desc";

        return $sql;

    }

}

?>