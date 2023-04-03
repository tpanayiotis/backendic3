<?php
class NewsAndInsightsAdd extends api
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
        $news_title = $_POST['news_title'];
        $news_content = $_POST['news_content'];
        $news_Img_url = $_POST['news_Img_url'];
        $article_title = $_POST['article_title'];
        $article_content = $_POST['article_content'];
        $article_Img_url = $_POST['article_Img_url'];
        $date_published = $_POST['date_published'];

        // Add any other parameters required for the insert statement
        $sql = "INSERT INTO news (news_title, news_content, news_Img_url, article_title, article_content, article_Img_url, date_published) 
        VALUES (:news_title, :news_content, :news_Img_url, :article_title, :article_content, :article_Img_url, :date_published)";

        $this->setSQL($sql);
        $this->setSQLParams([
            'news_title' => $news_title,
            'news_content' => $news_content,
            'news_Img_url' => $news_Img_url,
            'article_title' => $article_title,
            'article_content' => $article_content,
            'article_Img_url' => $article_Img_url,
            'date_published' => $date_published
        ]);
    }
}