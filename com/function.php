<?php
require_once 'connection.php';

function query($query)
{
    global $db;
    try {
        $statement = $db->query($query);
        return $statement->fetchAll();
    } catch (PDOException $th) {
        die("Query tidak Berhasil" . $th->getMessage());
    }
}
