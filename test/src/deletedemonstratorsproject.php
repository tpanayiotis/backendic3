<?php
class DeleteDemonstratorsProject extends api 
{
    public function __construct() {
        $this->validateRequestMethod("POST");
       
        $this->validateUpdateParams();
        $db = new Database("db/tpp.db");
        $this->initialiseSQL();
        $queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());
       
        // No need to set status code
       
        // Return a success message
        $this->setData( array(
          "length" => 0,
           "message" => "Success",
           "data" => null
        ));
    }

    private function validateRequestMethod($method) {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new ClientError("Invalid Request Method", 405);
        }
    }

    private function validateUpdateParams() {
        // 1. Look for all required parameters
        if (!filter_has_var(INPUT_POST, 'id')) {
            throw new ClientError("Project ID parameter required", 400);
        }
  
        // 2. Check to see if a valid project ID is supplied 
        // (this can be done by checking if the ID exists in the Projects table)
    }

    protected function initialiseSQL() {
        $id = $_POST['id'];

        $sql = "DELETE FROM Demonstrators_Projects WHERE id = :id";
        $this->setSQL($sql);
        $this->setSQLParams([
            'id' => $id,
        ]);
    }
}