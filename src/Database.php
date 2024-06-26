<?php

namespace Occasion;
abstract class Database {
    protected $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    abstract public function select($table, $columns, $conditions);
    abstract public function insert($table, $data);
    abstract public function update($table, $data, $conditions);
    abstract public function delete($table, $conditions);
}
?>
