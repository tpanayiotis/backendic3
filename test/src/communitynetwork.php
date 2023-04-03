<?php


class CommunityNetwork extends api
{
    protected function endpointParams()
    {
        return ['main_id', 'main_text'];
    }
    protected function initialiseSQL()
    {
        $sql = "SELECT DISTINCT  * FROM main
                WHERE 'true' = 'true'";

        $sqlParams = array();
        /**
         * check if author_id is set in request and if it's a valid integer
         */
        // check if id is set in request and if it's a valid integer
        if (isset($_GET['main_id'])) {
            $main_id = filter_input(INPUT_GET, 'main_id', FILTER_VALIDATE_INT);
            if ($main_id !== false) {
                $sql .= " AND main_id = :main_id";
                $sqlParams[':main_id'] = $main_id;
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