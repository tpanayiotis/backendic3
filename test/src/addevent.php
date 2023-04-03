<?php

/** 
 * 
 * @author Panagiotis Tsellos w20024460
 */

//text,links
class AddEvent extends api
{
    public function __construct()
    {
        $db = new Database("db/tpp.db");

        // Initialise and execute the SQL statement 
        $this->initialiseSQL();
        $queryResult = $db->executeSQL($this->getSQL(), $this->getSQLParams());

        if ($queryResult === false) {
            $this->setData(array(
                "length" => 0,
                "message" => "Error. Item could not be added.",
                "data" => null,
            ));
        } else {
            $this->setData(array(
                "length" => 1,
                "message" => "Success. Item added successfully.",
                "data" => $queryResult,
            ));
        }
    }

    protected function initialiseSQL()
    {
        $sql = "INSERT INTO events (links, title, description, time, date, image, free_text) VALUES (:links, :title, :description, :time, :date, :image, :free_text)";

        //parameters for the new event
        $links = filter_input(INPUT_GET, 'links', FILTER_SANITIZE_STRING);
        $title = filter_input(INPUT_GET, 'title', FILTER_SANITIZE_STRING);
        $description = filter_input(INPUT_GET, 'description', FILTER_SANITIZE_STRING);
        $time = filter_input(INPUT_GET, 'time', FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_GET, 'date', FILTER_SANITIZE_STRING);
        $image = filter_input(INPUT_GET, 'image', FILTER_SANITIZE_STRING);
        $free_text = filter_input(INPUT_GET, 'free_text', FILTER_SANITIZE_STRING);

        $sqlParams = array(
            ':links' => $links,
            ':title' => $title,
            ':description' => $description,
            ':time' => $time,
            ':date' => $date,
            ':image' => $image,
            ':free_text' => $free_text
        );

        $this->setSQL($sql);
        $this->setSQLParams($sqlParams);
    }

    protected function endpointParams()
    {
        return ['links', 'title', 'description', 'time', 'date', 'image', 'free_text'];
    }
}
