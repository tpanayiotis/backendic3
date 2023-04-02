<?php
 /**
 * A general class for endpoints
 
 * @author Panagiotis Tamboukaris
 */
 abstract class endpoint
{
    private $data;
    private $sql;
    private $sqlParams;
 
 
    public function __construct() {
        
        $db = new Database("db/tpp.db");
 
        $this->initialiseSQL();
        
        $data = $db->executeSQL($this->sql, $this->sqlParams);

        $this->setData( array(
            "length" => count($data),
            "message" => "Success",
            "data" => $data
        ));
    }
 
    protected function setSQL($sql) {
        $this->sql = $sql;
    }
 
    protected function setSQLParams($params) {
        $this->sqlParams = $params;
    }
 
 
    protected function initialiseSQL() {
        $sql = "";
        $this->setSQL($sql);
        $this->setSQLParams([]);
    }
 
 
    protected function setData($data) {
        $this->data = $data;
    }
 
    public function getData() {
        return $this->data;
    }
    public function getSQL() {
        return $this->sql;
    }
    public function getSQLParams() {
        return $this->sqlParams;
    }
}