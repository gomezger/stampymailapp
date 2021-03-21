<?php

include_once 'libs/imodel.php';

abstract class Model {
    protected Database $db;

    function __construct() {
        $this->db = new Database();
    }

    function query(string $query) {
        return $this->db->connect()->query($query);
    }

    function prepare($query) {
        return $this->db->connect()->prepare($query);
    }

    

}
