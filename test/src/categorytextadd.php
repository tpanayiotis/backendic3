<?php
class CategoryTextAdd extends api
{
    public function __construct()
    {
        $this->validateRequestMethod("POST");
        $this->validateInsertParams();
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

    private function validateInsertParams()
    {
        if (!filter_has_var(INPUT_POST, 'cat_text')) {
            throw new ClientError("Name parameter required", 400);
        }
        // Add any other validation for required parameters
    }
    private function validateRequestMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new ClientError("Invalid Request Method", 405);
        }
    }

    protected function initialiseSQL()
    {
        $cat_text = $_POST['cat_text'];


        // Add any other parameters required for the insert statement
        $sql = "INSERT INTO category_text (cat_text) VALUES (:cat_text)";
        $this->setSQL($sql);
        $this->setSQLParams([
            'cat_text' => $cat_text


        ]);
    }
}