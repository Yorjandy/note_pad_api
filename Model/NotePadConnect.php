<?php

class NotePadConnect{
    private $host = "localhost";
    private $port = "5432";
    private $db = "NOTE_PAD_DB";
    private $user = "postgres";
    private $password = "1234";
    private $connect = null;
    //estableciendo la conexion con la base de datos en postgres usando la funcion pg_connect
    public function __construct() {
       try{
            $this->connect = pg_connect("host=$this->host port=$this->port dbname=$this->db user=$this->user password=$this->password");
       }
       catch(Exception $e){
            echo "$e";
       }
    }
    //creando un metodo para lograr consultar a la base de datos 
    public function consultTable($tablename = "notes",$condition = "true"){
          $query = "select * from ".$tablename." where ".$condition;
          $result = pg_query($this->connect,$query);
          if($result){
               $list = pg_fetch_all($result);
               return $list;
          }
          else{
               throw new Exception();
          }
    }
    //creando un metodo para lograr insertar una fila en la base de datos 
    public function insertRow($title,$text,$tablename = "notes"){
          $query = "insert into $tablename (title,container) values ('$title','$text')";
          $result = pg_query($this->connect,$query);
          if(!$result){
               throw new Exception();
          }
    }
    //creando metodo para actualizar una fila de la base de datos
    public function updateRow($id, $title, $text, $tablename = "notes"){
          $query = "update $tablename set title = '$title', container = '$text' where id = '$id'";
          $result = pg_query($this->connect,$query);
          if (!$result){
               throw new Exception();
          }
    }
    //creando metodo para borrar una fila dada
    public function deleteRow($id, $tablename = "notes"){
          $query = "delete from $tablename where id = '$id' ";
          $result = pg_query($this->connect,$query);
          if (!$result){
               throw new Exception();
          }
    }
}