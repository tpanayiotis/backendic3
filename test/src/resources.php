<?php

/**
 * Author Endpoint
 *@author Panagiotis Tamboukaris
 */



class Resources extends api
{

    protected function initialiseSQL()
    {
        $sql = "SELECT DISTINCT * 
                    FROM category";
        $sqlParams = [];

        if (filter_has_var(INPUT_GET, 'cat_id')) {
            if (isset($where)) {
                $where .= " AND cat_id = :cat_id";
            } else {
                $where = " WHERE cat_id = :cat_id";
            }
            $sqlParams['cat_id'] = $_GET['cat_id'];
        }


        if (isset($where)) {
            $sql .= $where;
        }

        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);
    }
}