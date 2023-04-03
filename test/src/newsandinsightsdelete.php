<?php

class NewsAndInsightsDelete extends api
{
    public function __construct()
    {
        $this->validateRequestMethod("POST");
        $this->validateDeleteParams();
        $db = new Database("db/tpp.db");
        $this->initialiseSQL();
        $queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());
        // No need to set status code
        // Return a success message
        $this->setData(array(
            "length" => 0,
            "message" => "Success",
            "data" => null
        ));
    }
    private function validateRequestMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new ClientError("Invalid Request Method", 405);
        }
    }

    private function validateDeleteParams()
    {
        if (!filter_has_var(INPUT_POST, 'news_id')) {
            throw new ClientError("ID parameter required", 400);
        }
        // Add any other validation for required parameters
    }

    protected function initialiseSQL()
    {
        $sql = "DELETE FROM news
                WHERE 'true' = 'true'";

        // News ID parameter
        if (filter_has_var(INPUT_GET, 'news_id')) {
            $sql .= " AND news_id = :news_id";
            $sqlParams[':news_id'] = $_GET['news_id'];
        }

        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);
    }
}