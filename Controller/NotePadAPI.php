<?php

require_once("Model/NotePadConnect.php");

class NotePadAPI{
    private $model;

    public function __construct() {
       $this->model = new NotePadConnect();
    }
    //metodo para devolver al cliente la informacion de la base de datos en formato json
    public function getNotes(){
        try{
            $data = $this->model->consultTable();
            header('Content-Type:application/json');
            echo json_encode($data);
        }
        catch(Exception $e){
            header('Content-Type:application/json');
            echo json_encode(array('error'=>$e->getMessage()));
        }   
    }
    //metodo para consultar una nota pasado su id: args(id:int)
    public function getNoteById(){
        try{
            $id = $_REQUEST["id"];
            $data = $this->model->consultTable("notes","notes.id = $id");
            header('Content-Type:application/json');
            echo json_encode($data);
        }
        catch(Exception $e){
            header('Content-Type:application/json');
            echo json_encode(array('error'=>$e->getMessage()));
        }  
    }
    //metodo para crear una nueva nota y agregarla a la base de datos : args(title:string,text:string)
    public function createNote(){
        try{
            $title = $_REQUEST['title'];
            $text = $_REQUEST['text'];
            $this->model->insertRow($title,$text);
            header('Content-Type:application/json');
            echo json_encode(array('message'=>'Se inserto una nota correctamente'));
        }catch(Exception $e){
            header('Content-Type:application/json');
            echo json_encode(array('error'=>$e->getMessage()));
        }
    }
    //metodo para actualizar los datos de una nota existente y guardar los cambios en la base de datos: args(id:int,title:string,text:string)
    public function updateNote(){
        try{
            $id = $_REQUEST['id'];
            $title = $_REQUEST['title'];
            $text = $_REQUEST['text'];
            $this->model->updateRow($id,$title,$text);
            header('Content-Type:application/json');
            echo json_encode(array('message'=>'Se actualizo la nota correctamente'));
        }catch(Exception $e){
            header('Content-Type:application/json');
            echo json_encode(array('error'=>$e->getMessage()));
        }
    }
    //metodo para borrar una nota de la base de datos: args(id:int)
    public function deleteNote(){
        try{
            $id = $_REQUEST['id'];
            $this->model->deleteRow($id);
            header('Content-Type:application/json');
            echo json_encode(array('message'=>'Se elimino la nota correctamente'));
        }catch(Exception $e){
            header('Content-Type:application/json');
            echo json_encode(array('error'=>$e->getMessage()));
        }
    }
}