<?php


class CategoryText extends api
{
    protected function endpointParams()
    {
        return ['cat_text_id', 'cat_text'];
    }
    protected function initialiseSQL()
    {
        $sql = "SELECT DISTINCT  * FROM category_text
                WHERE 'true' = 'true'";

        $sqlParams = array();
        /**
         * check if author_id is set in request and if it's a valid integer
         */
        // check if id is set in request and if it's a valid integer
        if (isset($_GET['cat_text_id'])) {
            $cat_text_id = filter_input(INPUT_GET, 'cat_text_id', FILTER_VALIDATE_INT);
            if ($cat_text_id !== false) {
                $sql .= " AND cat_text_id = :cat_text_id";
                $sqlParams[':cat_text_id'] = $cat_text_id;
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