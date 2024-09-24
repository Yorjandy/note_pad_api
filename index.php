<?php 
require_once("Controller/NotePadAPI.php");
class API{
    private $controller;

    public function __construct() {
       $this->controller = new NotePadAPI();
    }
    public function action(){
        $json = file_get_contents('php://input');
        $data = json_decode($json,true);
        if(json_last_error() === JSON_ERROR_NONE){
            $_REQUEST = $data;
        }
        if(isset($_REQUEST["method"])){
            if(method_exists("NotePadAPI",$_REQUEST["method"])){
                $this->controller->{$_REQUEST["method"]}();
            }
            else{
                $this->controller->getNotes();
            }
        }
    }
}

$api = new API();
$api->action();