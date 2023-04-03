<?php

/** 
 * 
 * @author Panagiotis Tsellos w20024460
 */

class Delete extends api
{
    public function __construct()
    {
        $db = new Database("db/tpp.db");

        $this->validateRequestMethod("POST");

        
        // Initialise and execute the SQL statement 
        $this->initialiseSQL();
        $queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());

        $this->setData(array(
            "length" => 0,
            "message" => "Success. Item deleted successfully.",
            "data" => null,
        ));
    }

    protected function initialiseSQL()
    {
        $sql = "DELETE FROM events WHERE id = :id
        ";

        //parameter to find the id.
        if (filter_has_var(INPUT_GET, 'id')) {
            $sqlParams[':id'] = $_GET['id'];
            $this->setSQL($sql);
            $this->setSQLParams($sqlParams);
        }
    }
    protected function validateRequestMethod($method)
{
    if ($_SERVER['REQUEST_METHOD'] != $method) {
        throw new ClientErrorException("Invalid request method: " . $_SERVER['REQUEST_METHOD'], 405);
    }
}
    protected function endpointParams()
    {
        return ['id'];
    }
}


