<?php

class RelevantNewsStoriesDelete extends End
{
    public function __construct()
    {
        $db = new Database("db/tpp.db");

        // Check the request method is POST
        $this->validateRequestMethod("POST");

        // Initialise and execute the SQL statement 
        $this->initialiseSQL();
        $queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());

        $this->setData(array(
            "length" => 0,
            "message" => "Success. Item deleted successfully.",
            "data" => null
        ));
    }

    protected function initialiseSQL()
    {
        $sql = "DELETE FROM relevant
                WHERE 'true' = 'true'";

        $sqlParams = array();

        $bool = true;

        // Relevant ID parameter
        if (filter_has_var(INPUT_GET, 'relevant_id')) {
            $sql .= " AND relevant_id = :relevant_id";
            $sqlParams[':relevant_id'] = $_GET['relevant_id'];

            $param = 'relevant_id';
            $name = "Relevant ID";

            // Function that checks the correctness of the Relevant ID
            SwitchStatementForIntegers($param, $name);
        }

        // if the parameter that the user inserts is OK, then set the SQL and the parameters
        if ($bool) {
            $this->setSQL($sql);
            $this->setSQLParams($sqlParams);
        }
    }

    protected function endpointParams()
    {
        return ['relevant_id'];
    }
}