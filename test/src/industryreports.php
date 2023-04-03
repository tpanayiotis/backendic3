<?php


class IndustryReports extends api
{
    protected function endpointParams()
    {
        return ['industry_id', 'industry_title', 'industry_Img_url', 'article_url'];
    }
    protected function initialiseSQL()
    {
        $sql = "SELECT DISTINCT  * FROM industry
                WHERE 'true' = 'true'";

        $sqlParams = array();
        /**
         * check if author_id is set in request and if it's a valid integer
         */
        // check if id is set in request and if it's a valid integer
        if (isset($_GET['industry_id'])) {
            $industry_id = filter_input(INPUT_GET, 'industry_id', FILTER_VALIDATE_INT);
            if ($industry_id !== false) {
                $sql .= " AND industry_id = :industry_id";
                $sqlParams[':industry_id'] = $industry_id;
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