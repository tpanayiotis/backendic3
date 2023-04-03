<?php


class RelevantNewsStories extends api
{
    protected function endpointParams()
    {
        return ['relevant_id', 'relevant_title', 'relevant_content', 'relevant_Img_url', 'article_url', 'date_published'];
    }
    protected function initialiseSQL()
    {
        $sql = "SELECT DISTINCT  * FROM relevant
                WHERE 'true' = 'true'";

        $sqlParams = array();
        /**
         * check if author_id is set in request and if it's a valid integer
         */
        // check if id is set in request and if it's a valid integer
        if (isset($_GET['relevant_id'])) {
            $relevant_id = filter_input(INPUT_GET, 'relevant_id', FILTER_VALIDATE_INT);
            if ($relevant_id !== false) {
                $sql .= " AND relevant_id = :relevant_id";
                $sqlParams[':relevant_id'] = $relevant_id;
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