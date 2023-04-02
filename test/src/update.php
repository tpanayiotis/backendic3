<?php
class ClientError extends Exception {
    public function __construct($message, $code) {
        parent::__construct($message, $code);
    }
}

class Update extends api 
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
        // Check if description and id parameter exist
        if (!isset($_POST['description'])) {
            throw new ClientErrorException("Description parameter required", 400);
        }
        if (!isset($_POST['id'])) {
            throw new ClientErrorException("ID parameter required", 400);
        }
        // Check if description and id parameter are not empty
        if (empty($_POST['description'])) {
            throw new ClientErrorException("Description cannot be empty", 400);
        }
        if (empty($_POST['id'])) {
            throw new ClientErrorException("ID cannot be empty", 400);
        }
    }
    

    protected function initialiseSQL() {
        $description = $_POST['description'];
        $id = $_POST['id'];
        $sql = "UPDATE about SET description = :description WHERE id = :id";
        $this->setSQL($sql);
        $this->setSQLParams([
            'description' => $description,
            'id' => $id,
        ]);
    }
}
