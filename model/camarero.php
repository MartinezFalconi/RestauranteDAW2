<?php
class Camarero {
    //ATRIBUTOS
    private $id_camarero;
    private $nombre_camarero;
    private $pass_camarero;
    private $idMantenimiento;

    //CONSTRUCTOR 
    public function __construct() {
    include_once '../db/connection.php';
    $this->pdo=$pdo;
    }

    //GETTERS & SETTERS
    public function getId_camarero() {
        return $this->id_camarero;
    }
    public function getNombre_camarero() {
        return $this->nombre_camarero;
    }
    public function getPass_camarero() {
        return $this->pass_camarero;
    }

    public function setId_camarero($id_camarero) {
        $this->id_camarero = $id_camarero;
    }
    public function setNombre_camarero($nombre_camarero) {
        $this->nombre_camarero = $nombre_camarero;
    }
    public function setPass_camarero($pass_camarero) {
        $this->pass_camarero = $pass_camarero;
    }

// VALIDACIÓN DEL LOGIN
// DEVUELVE TRUE EN CASO DE QUE EN LA BASE DE DATOS HAYA UN CAMARERO CON NOMBRE Y CONTRASEÑA IGUALES A LA QUE EL
// USUARIO APORTA EN EL FORMULARIO DEL LOGIN. FALSE, EN CUALQUIER OTRO CASO

public function login($camarero){
    $query = "SELECT * FROM `camareros` WHERE `nombre_camarero`=? AND `pass_camarero`=?";
    $sentencia=$this->pdo->prepare($query);
    $nombre = $camarero->getNombre_camarero();
    $pass = $camarero->getPass_camarero();
    $sentencia->bindParam(1,$nombre);
    $sentencia->bindParam(2,$pass);
    $sentencia->execute();
    $result=$sentencia->fetch(PDO::FETCH_ASSOC);
    $numRow=$sentencia->rowCount();

    if(!empty($numRow) && $numRow==1){
        $camarero->setId_camarero($result['id_camarero']);
        session_start();
        $_SESSION['camarero']=$camarero;
        return true;
    } else {
        return false;
    }

}
    public function getIdMantenimiento()
    {
        return $this->idMantenimiento;
    }

    public function setIdMantenimiento($idMantenimiento)
    {
        $this->idMantenimiento = $idMantenimiento;
    }
}

?>