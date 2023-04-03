<?php
class RelevantNewsStoriesAdd extends api
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
        $relevant_title = $_POST['relevant_title'];
        $relevant_content = $_POST['relevant_content'];
        $relevant_Img_url = $_POST['relevant_Img_url'];
        $article_url = $_POST['article_url'];
        $date_published = $_POST['date_published'];

        // Add any other parameters required for the insert statement
        $sql = "INSERT INTO relevant (relevant_title, relevant_content, relevant_Img_url, article_url, date_published) 
        VALUES (:relevant_title, :relevant_content, :relevant_Img_url, :article_url, :date_published)";

        $this->setSQL($sql);
        $this->setSQLParams([
            'relevant_title' => $relevant_title,
            'relevant_content' => $relevant_content,
            'relevant_Img_url' => $relevant_Img_url,
            'article_url' => $article_url,
            'date_published' => $date_published
        ]);
    }
}