<?php

class IndustryReportsDelete extends End
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
        $sql = "DELETE FROM industry
                WHERE 'true' = 'true'";

        $sqlParams = array();

        $bool = true;

        // Industry ID parameter
        if (filter_has_var(INPUT_GET, 'industry_id')) {
            $sql .= " AND industry_id = :industry_id";
            $sqlParams[':industry_id'] = $_GET['industry_id'];

            $param = 'industry_id';
            $name = "Industry ID";

            // Function that checks the correctness of the Industry ID
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
        return ['industry_id'];
    }
}