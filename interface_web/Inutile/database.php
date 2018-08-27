<?php
ini_set('display_errors', 1);

class database {

    const USERNAME="root";
    const PASSWORD="";
    const HOST="localhost";
    const DB="SmartVillage";

    private function getConnection(){
        $username = self::USERNAME;
        $password = self::PASSWORD;
        $host = self::HOST;
        $db = self::DB;
        $connection = new PDO("mysql:dbname=$db;host=$host", $username, $password);
        return $connection;
    }

    public function getArray($query){
      $connection = $this->getConnection();
      $reponse = $connection->query($query);
      $i = 0;
      while ($donnees = $reponse->fetch()){
        $tab[$i] = $donnees;
        $i++;
      }
      return $tab;
    }

    public function getLast($query){
      $array = $this->getArray($query);
      $last = $array[count($array)-1];
      return $last;
    }

}

?>
