<?php

class dbConnection
{
    public $conn;
    private $hostname = "localhost";
    private $dbusename = "root";
    private $dbpassword = "";
    private $db = "comshop";

    function __construct()
    {
        mysqli_report(MYSQLI_REPORT_STRICT);
        $this->conn = new mysqli(
            $this->hostname,
            $this->dbusename,
            $this->dbpassword,
            $this->db
        );
        if (!$this->conn->connect_error) {

            $GLOBALS["con"] = $this->conn;
        } else {
            echo "Not Success";
            $GLOBALS["con"] = $this->conn;
        }
    }
}
