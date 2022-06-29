<?php


class TableData
{

    function __construct($dataBase, $userName, $password)
    {
        $this->connection = new PDO($dataBase, $userName, $password);
    }

    function insertData($tableName, $termValue, $termContent)
    {

        $sql = "INSERT INTO $tableName(term, content) VALUES (:termValue, :termContent)";
        $db = $this->connection;
        $smt = $db->prepare($sql);
        $smt->execute([
            ":termValue" => $termValue, ":termContent" => $termContent
        ]);
    }

    function getAll($tableName)
    {

        $db = $this->connection;
        $sql = "SELECT * FROM $tableName";
        $smt = $db->prepare($sql);
        $smt->execute();

        $data = $smt->fetchAll();

        return $data;
    }

    function deleteTerm($term, $tableName)
    {
        $db = $this->connection;
        $sql = "DELETE FROM $tableName WHERE term = '$term'";
        $smt = $db->prepare($sql);
        $smt->execute();
    }

    function termExists($term, $tableName)
    {

        $db = $this->connection;
        $sql = "SELECT term FROM $tableName WHERE term = '$term'";
        $smt = $db->prepare($sql);
        $smt->execute();

        $data = $smt->fetch();

        if (empty($data)) {
            return false;
        };

        return true;
    }

    function search($searchingFor, $tableName)
    {

        $db = $this->connection;
        $sql = "SELECT * FROM $tableName WHERE term REGEXP('$searchingFor') OR content REGEXP('$searchingFor')";
        $smt = $db->prepare($sql);
        $smt->execute();
        $data = $smt->fetchAll();

        return ($data);
    }
}


class Table
{

    static private $data;

    static public function initialize(TableData $tableData)
    {
        return self::$data = $tableData;
    }

    static public function insertData($tableName, $termValue, $termContent)
    {
        return self::$data->insertData($tableName, $termValue, $termContent);
    }

    static public function  getAll($tableName)
    {
        return self::$data->getAll($tableName);
    }

    static public function deleteTerm($term, $tableName)
    {
        return self::$data->deleteTerm($term, $tableName);
    }

    static public function termExists($term, $tableName)
    {
        return self::$data->termExists($term, $tableName);
    }

    static public function search($searchingFor, $tableName)
    {

        return self::$data->search($searchingFor, $tableName);
    }
}
