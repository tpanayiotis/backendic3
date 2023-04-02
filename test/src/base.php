<?php

    /**
     * Base 'root' endpoint of the api which returns information 
     * that we were asked in the assesment brief
     * @author Panagiotis Tamboukaris
     */
class Base extends api
{
    
       
    

    public function __construct() {

        $db = new Database("db/tpp.db");

           
        $name = array(
            "first_name" => "Panagiotis", 
            "last_name" => "Tamboukaris"
        );
        $doc = array(
            "Link" => "http://unn-w20017219.newnumyspace.co.uk/year3/app/documentation");
        $module = array(
            "code" => "KF6012", 
            "name" => "Web Application Integration",
            "level" => 6,
            "module_tutor" => "John Rooksby"
        );
        $data = array(
            "name" => $name,
            "id" => "w20017219",
            "module" => $module,
            "Documentation" => $doc
        );
 
     
        $this->setData( array(
            "length" => count($data),
            "message" => "Success",
            "data" => $data
        ));
        
    
   
}


}
