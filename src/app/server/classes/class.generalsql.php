<?php

class generalsql {

    function userRequestList() {

        $sql = "SELECT  
                    dgf.gised_form_id as gised_id, 
                    concat(du.title,'. ',du.first_name,' ',du.last_name) AS user_name,
                    du.email_id, 
                    du.mobile_no,
                    ds.status_value,
                    fstd.*  
                FROM 
                    dm_gised_form dgf,
                    dm_user du,
                    dm_status ds,
                    fact_status_tracking_details fstd 
                WHERE 
                    du.user_id = dgf.r_user_id 
                    and ds.status_id = dgf.r_status_id 
                    and fstd.r_gised_id = dgf.gised_form_id 
                    group by fstd.r_gised_id   
                    order by fstd.update_date_time desc";

        return $sql;

    }

}

?>