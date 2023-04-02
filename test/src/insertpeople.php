<?php
class InsertPeople extends api 
{
    public function __construct() {
        $this->validateRequestMethod("POST");
        $this->validateInsertParams();
        $db = new Database("db/contact-form.db");
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
        if (!filter_has_var(INPUT_POST,'picture_url')) {
          throw new ClientErrorException("Picture url parameter required", 400);
        }
        if (!filter_has_var(INPUT_POST,'name')) {
            throw new ClientErrorException("Name parameter required", 400);
          }
        // Add any other validation for required parameters
      }
      private function validateRequestMethod($method) {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
          throw new ClientErrorException("Invalid Request Method", 405);
         }}

      protected function initialiseSQL() {
        $picture_url = $_POST['picture_url'];
        $name = $_POST['name'];
     

        // Add any other parameters required for the insert statement
        $sql = "INSERT INTO people (picture_url, name) VALUES (:picture_url, :name)";
        $this->setSQL($sql);
        $this->setSQLParams([
          'picture_url' => $picture_url,
          'name' => $name,
      
        ]);
      }
}