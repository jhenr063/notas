<?php
require_once 'model/nota.php';

class noteController{
public $page_title;
public $view;

public function __construct()
{
    $this->view = 'list_note';
    $this ->page_title = '';
    $this ->noteobj = new Note();
        
}//cierre de constructor
/*Listado de Notas */

public function list()
{

    $this ->page_title = "Listado de Notas";
    return $this ->noteobj->getNotes();
}

public function edit ($id = null)
{
$this->page_title = 'Editar Notas';
$this->view = 'edit_note';

if(isset($_GET["id"])) $id = $_GET["id"];
return $this->noteobj->getNoteById($id);
}//Cierre de Funcion

public function save(){
    $this->view ='edit_note';
    $this->page_title = 'Guardar Notas';
    $id = $this->noteobj->save($_POST);
    $result = $this->noteobj->getNoteByID($id);
    $_GET["response"] = true; //?????????
    return $result;
}

public function confirmDelete()
{
    $this->page_title = 'Eliminar Nota';
    $this->view ='confirm_delete_note';
    return $this->noteobj->getNoteById($_GET["id"]);
}

public function delete()
{
    $this->page_title = 'Listado de Notas';
    $this->view ='delete_note';
    return $this->noteobj->deleteNoteById($_POST["id"]);

}

}//fin del note controller

?>