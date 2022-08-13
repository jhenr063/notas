<?php

class Note {

/* private $table = 'nota'; */ ///????????????????????????????????????????
private $table = 'nota';
private $conection;

//Constructor Vacio
public function __construct()
{
}

public function getConection()
{

    $dbObj = new Db();
    $this->conection  = $dbObj->connection;

}//cierre del getConection

public function getNotes()
{
    $this ->getConection();
    $sql = "SELECT * FROM ".$this->table;
    $stmt = $this->conection->prepare($sql);
    $stmt ->execute();
    return $stmt ->fetchAll();
}

public function getNoteById($id)
{

if (is_null($id)) return false;
$this ->getConection();
$sql = "SELECT * FROM " .$this->table."WHERE id =?";
$stmt = $this->conection->prepare($sql);
$stmt->execute([$id]);

return $stmt->fetch();
} // fin de la funcion obtener notas por id

public function save($param)
{

    $this->getConection();
    /* Set default values */
$title ="";
$content ="";

/* Revisar si Existe */

$exist = false;
if (isset($param["id"]) and $param["id"] != ''){
/* $actualNote = $this->getNoteById(["id"]); */
$actualNote = $this->getNoteById($param["id"]);
if (isset($actualNote["id"]))
{

    $exist = true;
    /*Valores Actuales */
    $id = $param["id"];
    $title = $actualNote["title"];
    $content = $actualNote["content"];

}

} // fin de la revision si existen
/*Recibir  Valores */

if (isset($param["title"]))  $title = $param["title"];
if (isset($param["content"]))  $content = $param["content"];
 
    /*Operacion en la base de Datos */

    if ($exist) {
        //editar
        $sql = "UPDATE " . $this->table . " SET title=?, content=? WHERE id = ?";
        $stmt = $this ->conection ->prepare($sql);
        $res = $stmt->execute([$title, $content, $id]);        
    } else {
            //registrar o Guardar
            $sql = "INSERT INTO " .$this->table. "(title,content) Values (?,?)";
            $stmt = $this->conection->prepare($sql);
            $stmt ->execute([$title,$content]);
            $id = $this->conection->lastInsertId();
    }

    return $id;

}

public function deleteNoteById($id)
{
$this->getConection();
$sql = "DELETE FROM ".$this->table."WHERE id=?";
$stmt = $this->conection->prepare($sql);
return $stmt->execute([$id]);
}

}//fin de clase Note

