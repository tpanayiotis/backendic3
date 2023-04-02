<?php 
 /**
  * Author Endpoint
  *@author Panagiotis Tamboukaris
  */
 


class Submissions extends api
{
 
    protected function initialiseSQL() {
        $sql = "SELECT DISTINCT id, name, email, phone_number, organisation, job_title, interests, preference, message, created_at
                    FROM submissions";
               $sqlParams = [];

               if (filter_has_var(INPUT_GET, 'id')) {
                if (isset($where)) {
                    $where .= " AND id = :id";
                } else {
                    $where = " WHERE id = :id";
                }
                $sqlParams['id'] = $_GET['id'];
    
            }


        if (isset($where)) {
            $sql .= $where;
            
        }

        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);

    }
}