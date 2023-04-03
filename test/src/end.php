<?php

/**
 * A general class for endpoints
 * 
 * This Endpoint class is the parent class for the Base, Paper,
 * Author, Readers, ClientError, Authenticate and Update classes, 
 * providing common methods. It has been declared as an abstract 
 * class which means it is not possible to make an instance of 
 * this class itself.
 * 
 * @author Alexantros Tamboutsiaris W20001556
 */
abstract class End
{
    private $data;
    private $sql;
    private $sqlParams;

    /**
     * Query the database and save the result 
     */
    public function __construct()
    {
        $db = new Database("db/tpp.db");

        /*
        The initialiseSQL method can be overridden by
        child classes to set the SQL as appropriate for
        each endpoint
        */
        $this->initialiseSQL();

        $data = $db->executeSQL($this->sql, $this->sqlParams);

        // Error checking for the parameter
        if ($data != NULL) {
            $this->setData(array(
                "length" => count($data),
                "message" => "Success",
                "data" => $data
            ));
        } else {
            $this->setData(array(
                "length" => 0,
                "message" => "The parameter that you entered is not exist",
                "data" => null
            ));
            http_response_code(404);
        }

        // Check if the params used are valid for endpoint
        $this->validateParams($this->endpointParams());

        // Check the request method is 'GET'
        $this->validateRequestMethod("GET");
    }

    protected function setSQL($sql)
    {
        $this->sql = $sql;
    }

    protected function getSQL()
    {
        return $this->sql;
    }

    protected function setSQLParams($params)
    {
        $this->sqlParams = $params;
    }

    protected function getSQLParams()
    {
        return $this->sqlParams;
    }

    /**
     * Define SQL and params for the endpoint
     * 
     * This method can be overridden by child classes
     * with to set the SQL query needed for the specific
     * endpoint. It is just blank here because this is an
     * abstract endpoint.
     */
    protected function initialiseSQL()
    {
        $sql = "";
        $this->setSQL($sql);
        $this->setSQLParams([]);
    }

    protected function setData($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    /**
     * Define valid parameters for this endpoint
     */
    protected function endpointParams()
    {
        return [];
    }

    /**
     * Check the parameters used in request against an array of
     * valid parameters for the endpoint
     * 
     * @param array $params An array of valid param names (e.g. ['id'])
     */
    protected function validateParams($params)
    {
        foreach ($_GET as $key => $value) {
            if (!in_array($key, $params)) {
                http_response_code(400);
                $output['message'] = "Invalid parameter: " . $key;
                die(json_encode($output));
            }
        }
    }

    // Throw an error if request method is not appropriate
    protected function validateRequestMethod($method)
    {
        if ($_SERVER['REQUEST_METHOD'] != $method) {
            throw new ClientError("Invalid request method: " . $_SERVER['REQUEST_METHOD'], 405);
        }
    }
}

/**
 * Instead of repeating the following commands for the string parameters 
 * for the three classes (Paper, Author), I created the following function
 */
function SwitchStatementForStrings($param, $name)
{
    // Error checking for string parameters for all endpoints
    switch (true) {
        case ($_GET[$param] == NULL):
            $endpoint = new ClientError("The " . $name . " cannot have a NULL value", 400);
            RepeatedCommands($endpoint);
            break;
        case (is_numeric($_GET[$param])):
            $endpoint = new ClientError("The " . $name . " cannot be a number", 400);
            RepeatedCommands($endpoint);
            break;
    }
}

/**
 * Instead of repeating the following commands for the integer parameters 
 * for the three classes (Paper, Author), I created the following function
 */
function SwitchStatementForIntegers($param, $name)
{
    // Error checking for integer parameters for all endpoints
    switch (true) {
        case ($_GET[$param] == NULL):
            $endpoint = new ClientError("The " . $name . " cannot have a NULL value", 400);
            RepeatedCommands($endpoint);
            break;
        case (!is_numeric($_GET[$param])):
            $endpoint = new ClientError("The " . $name . " cannot be a letter, a word or a text", 400);
            RepeatedCommands($endpoint);
            break;
        case ($_GET[$param] <= 0):
            $endpoint = new ClientError("The " . $name . " cannot be negative or have a zero value", 400);
            RepeatedCommands($endpoint);
            break;
    }
}

/**
 * Instead of repeating the following commands on each parameter 
 * for the three classes (Paper, Author), I created the following function 
 * to set the bool variable to false in case the user input is wrong.
 */
function RepeatedCommands($endpoint)
{
    $bool = false;
    $response = $endpoint->getData();
    die(json_encode($response));
    return $bool;
}
