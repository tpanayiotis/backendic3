<?php
class InsertText extends api 
{
    public function __construct() {
        $this->validateRequestMethod("POST");
        $this->validateInsertParams();
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

      private function validateInsertParams() {
        if (!filter_has_var(INPUT_POST,'description')) {
          throw new ClientErrorException("Picture url parameter required", 400);
        }
        
        // Add any other validation for required parameters
      }
      private function validateRequestMethod($method) {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
          throw new ClientErrorException("Invalid Request Method", 405);
         }}

      protected function initialiseSQL() {
        $description = $_POST['description'];
       
     

        // Add any other parameters required for the insert statement
        $sql = "INSERT INTO about (id, description) VALUES (:description)";
        $this->setSQL($sql);
        $this->setSQLParams([
            'id' => $id,
          'description' => $description,
          
      
        ]);
      }
}