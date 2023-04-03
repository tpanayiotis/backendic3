<?php

/**
 * A general class for Education api 
 * 
 * @author Panagiotis Tsellos w20024460
 */
class Education extends api{
protected function endpointParams() {
    return ['id'];
 }
 
 protected function initialiseSQL() {
    $sql = "SELECT *
     FROM ic3_education_agenda";


        $this->setSQL($sql);
    }
   
}