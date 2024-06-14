<?php


namespace Projectoop;

use PDO;
use PDOException;
use Exception;

class Mysql implements Database
{
    private PDO $db;

    public function __construct(string $host, string $dbname, string $username, string $password, )
    {
        // TODO: Implement connect() method.
        try {
            $this->db = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


        } catch (PDOException $error) {
            //            echo "Er is een error";
            throw new Exception($error->getMessage());
        }

    }

    // username, password, passwordrepeat, email
    public function insert(string $table, array $params = []): void
    {
        try {
            if (!empty($params) && is_array($params)) {
                // TODO: Implement insert() method.
//                $variableNames = array_keys(get_defined_vars()['params']);
                $columns = implode(',', array_keys($params));
                $values = ":" . implode(', :', array_keys($params));
                $insert = $this->db->prepare("INSERT INTO $table ($columns) VALUES ($values)");
                //            $sql = "INSERT INTO ".$table." (".$colums.") VALUES (".$values.")";
                //            $insert = $this->db->prepare($sql);
                foreach ($params as $key => $value) {
                    $insert->bindValue(':' . $key, $value);
                }
                $insert->execute();
                //                return self::$db->lastInsertId();
            } else {
                echo "ERROR";
            }

        } catch (PDOException $error) {
            throw new Exception($error->getMessage());
        }
    }

    public function select(array $params, array $conditions = [])
    {
        // TODO: Implement select() method.

        /*
         * SELECT user.username, user.email, user.password, order.date FROM user, order WHERE username = :username AND password = :password
         * WHERE user.id = 1
         * WHERE user.id = order.user_id
         *
         * PARAMETERS
         * [ user =>
         *        [ 'username', 'email', 'password'],
         *   order =>
         *          ['date']
         * ]
         * CONDITIONS
         * [ 'user.id' => 'order.user_id',
         *  'user.password' => 'admin' ,
         *  order.date => '2021-01-01' ]
         *
         */
        //SELECT user.username, user.email, user.password, order.date
        $query = "SELECT ";
        foreach ($params as $key => $value) {
            $tableName = $key;
            foreach ($value as $column) {
                $query .= "$tableName.$column, ";
            }
        }
        // SELECT user.username, user.email, user.password, order.date FROM
        // haal aan de rechter  kant de laatste komma weg
        $query = rtrim($query, ', ');
        // FROM
        $query .= " FROM " . implode(', ', array_keys($params));
        // SELECT user.username, user.email, user.password, order.date FROM user, order

        if (!empty($conditions)) {
            $query .= " WHERE ";
            foreach ($conditions as $key => $value) {
                //                $relation = false;
//                foreach(array_keys($params) as $table){
//                    $test = strpos($value, "$table.");
//                    var_dump($test);
//                    if(strpos($value, "$table.") == true)
//                    {
//                        $relation = true;
//                    }
//                }
                $isColumnReference = false;
                if (strpos($value, '.') !== false) {
                    // Splits de waarde op de punt om de mogelijke tabelnaam te isoleren
                    // value => order.user_id
                    [$possibleTableName, $possibleColumnName] = explode('.', $value, 2);
                    // Controleer of het eerste deel van de gesplitste waarde een bekende tabelnaam is
                    if (array_key_exists($possibleTableName, $params)) {
                        $isColumnReference = true;
                    }
                }
                if ($isColumnReference) {
                    $query .= "$key = $value AND ";
                    // geen quotes
                } else {
                    // wel quotes
                    $query .= "$key = '$value' AND ";
                }
                // $condition = 'user.id' => 'order.user_id'
//                $query .= "$key = $value AND ";
            }
            $query = rtrim($query, 'AND ');
        }
        //        var_dump($query);
        $result = $this->db->query($query);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update(string $table, array $params, array $conditions)
    {
        $query = "UPDATE $table SET ";
        $query .= implode(", ", array_map(function ($column) {
            return "$column = :$column";
        }, array_keys($params)));

        $query .= " WHERE ";

        $query .= implode(", ", array_map(function ($column) {
            return "$column = :$column";
        }, array_keys($conditions)));

        $query = $this->db->prepare($query);

        foreach ($params as $key => $value) {
            $query->bindValue(":$key", $value);
        }

        foreach ($conditions as $key => $value) {
            $query->bindValue(":$key", $value);
        }
        $query->execute();
    }

    public function delete(string $table, array $conditions)
    {
        $query = "DELETE FROM $table WHERE ";

        $query .= implode(", ", array_map(function ($column) {
            return "$column = :$column";
        }, array_keys($conditions)));

        $query = $this->db->prepare($query);

        foreach ($conditions as $key => $value) {
            $query->bindValue(":$key", $value);
        }
        $query->execute();
    }

    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}