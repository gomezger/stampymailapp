<?php

interface IModel{
    public function find($id);
    public function all();
    public function insert();
    public function update();
    public function delete($id);
    public function set(array $array);
}

?>