<?php 
 /**
  * Author Endpoint
  *@author Panagiotis Tamboukaris
  */
 


class Partners extends api
{
 
    protected function initialiseSQL() {
        $sql = "SELECT DISTINCT id, name, picture_url
                    FROM partners";
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