<?php
class IndustryReportsAdd extends api
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
        if (!filter_has_var(INPUT_POST, 'text')) {
            throw new ClientError("Text parameter required", 400);
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
        $industry_title = $_POST['industry_title'];
        $industry_Img_url = $_POST['industry_Img_url'];
        $article_url = $_POST['article_url'];

        // Add any other parameters required for the insert statement
        $sql = "INSERT INTO industry (industry_title, industry_Img_url, article_url) 
        VALUES (:industry_title, :industry_Img_url, :article_url)";

        $this->setSQL($sql);
        $this->setSQLParams([
            'industry_title' => $industry_title,
            'industry_Img_url' => $industry_Img_url,
            'article_url' => $article_url
        ]);
    }
}