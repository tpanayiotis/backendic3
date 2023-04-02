<?php

/**
 * A general class for Education api 
 * 
 * @author Panagiotis Tsellos w20024460
 */

 class editeducation extends api {
    protected function initialiseSQL() {
        $sql = "UPDATE ic3_education_agenda SET description = :description WHERE id = :id";
        $sqlParams = [
            ':description' => $_GET['description'],
            ':id' => 1
        ];
    
        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);
        if (!isset($_GET['description']) || empty($_GET['description'])) {
            throw new Exception('Description parameter is required.');
        }
    }
    
      
    

    public function __construct() {
        $db = new Database("db/tpp.db");

        $this->validateRequestMethod("GET");

        $this->initialiseSQL();
        $db->executeSQL($this->getSQL(), $this->getSQLParams());

        $this->setData(array(
            "length" => 0,
            "message" => "Success. Item updated successfully.",
            "data" => null,
        ));
    }
}
