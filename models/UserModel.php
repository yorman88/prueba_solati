<?php


// Se crea la clase usuario de acuerdo a los campos de la tabla en la BD
class User {
    public $usu_intid;
    public $usu_varnombre;
    public $usu_varapellido;
    public $usu_intidentificacion;
    public $usu_vartelefono;
    public $usu_varemail;
    public $usu_intedad;
    public $usu_varsexo;
    public $usu_varestadocivil;
    public $usu_intestado;


    // Se crea el constructor de la clase
    public function __construct($id, $nombre, $apellido, $identificacion, $telefono, $email, $edad, $sexo, $estadoCivil, $estado) {
        $this->usu_intid = $id;
        $this->usu_varnombre = $nombre;
        $this->usu_varapellido = $apellido;
        $this->usu_intidentificacion = $identificacion;
        $this->usu_vartelefono = $telefono;
        $this->usu_varemail = $email;
        $this->usu_intedad = $edad;
        $this->usu_varsexo = $sexo;
        $this->usu_varestadocivil = $estadoCivil;
        $this->usu_intestado = $estado;
    }
}

