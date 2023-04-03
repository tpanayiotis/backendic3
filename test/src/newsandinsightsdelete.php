<?php

/** 
 * 
 * @author Alexantros Tamboutsiaris W20001556
 */
class NewsAndInsightsDelete extends Endpoint
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
        $sql = "DELETE FROM news
                WHERE 'true' = 'true'";

        $sqlParams = array();

        $bool = true;

        // News ID parameter
        if (filter_has_var(INPUT_GET, 'news_id')) {
            $sql .= " AND news_id = :news_id";
            $sqlParams[':news_id'] = $_GET['news_id'];

            $param = 'news_id';
            $name = "News ID";

            // Function that checks the correctness of the News ID
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
        return ['news_id'];
    }
}