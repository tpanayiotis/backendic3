<?php

class CommunityNetworkDelete extends End
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
            "message" => "Success. Text deleted successfully.",
            "data" => null
        ));
    }

    protected function initialiseSQL()
    {
        $sql = "DELETE FROM main
                WHERE 'true' = 'true'";

        $sqlParams = array();

        $bool = true;

        // Main ID parameter
        if (filter_has_var(INPUT_GET, 'main_id')) {
            $sql .= " AND main_id = :main_id";
            $sqlParams[':main_id'] = $_GET['main_id'];

            $param = 'main_id';
            $name = "Main ID";

            // Function that checks the correctness of the Category Main ID
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
        return ['main_id'];
    }
}