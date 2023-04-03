<?php

class CategoryTextDelete extends End
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
        $sql = "DELETE FROM category_text
                WHERE 'true' = 'true'";

        $sqlParams = array();

        $bool = true;

        // Category Text ID parameter
        if (filter_has_var(INPUT_GET, 'cat_text_id')) {
            $sql .= " AND cat_text_id = :cat_text_id";
            $sqlParams[':cat_text_id'] = $_GET['cat_text_id'];

            $param = 'cat_text_id';
            $name = "Category Text ID";

            // Function that checks the correctness of the Category Text ID
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
        return ['cat_text_id'];
    }
}