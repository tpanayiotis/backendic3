<?php


class NewsAndInsights extends api
{
    protected function endpointParams()
    {
        return ['news_id', 'news_title', 'news_content', 'news_Img_url', 'article_title', 'article_content', 'article_Img_url', 'date_published'];
    }
    protected function initialiseSQL()
    {
        $sql = "SELECT DISTINCT  * FROM news
                WHERE 'true' = 'true'";

        $sqlParams = array();
        /**
         * check if author_id is set in request and if it's a valid integer
         */
        // check if id is set in request and if it's a valid integer
        if (isset($_GET['news_id'])) {
            $news_id = filter_input(INPUT_GET, 'news_id', FILTER_VALIDATE_INT);
            if ($news_id !== false) {
                $sql .= " AND news_id = :news_id";
                $sqlParams[':news_id'] = $news_id;
            } else {
                throw new ClientError("The id must be a valid integer", 400);
            }
        }
        /**
         * check if first_name is set in request and if it's a valid string
         */

        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);
        return array($sql, $sqlParams);
    }
}