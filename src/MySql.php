<?php

namespace Occasion;

require_once './Database.php';

class MySql extends Database {
    public function select($table, $columns, $conditions = '1') {
        $sql = "SELECT " . implode(', ', $columns) . " FROM $table WHERE $conditions";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert($table, $data) {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($table, $data, $conditions) {
        $setClause = '';
        foreach ($data as $column => $value) {
            $setClause .= "$column = :$column, ";
        }
        $setClause = rtrim($setClause, ', ');
        $sql = "UPDATE $table SET $setClause WHERE $conditions";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($table, $conditions) {
        $sql = "DELETE FROM $table WHERE $conditions";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute();
    }
}
?>
