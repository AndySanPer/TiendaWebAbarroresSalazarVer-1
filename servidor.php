<?php
class Servidor {
    public $servi;
    public $base;
    public $pass;

    public function __construct($servi, $base, $pass) {
        $this->servi = $servi;
        $this->base = $base;
        $this->pass = $pass;
    }

    public function conecta() {
        $conex = "";
        try {
            $conex = new PDO("mysql:host=localhost;dbname=$this->base", "root", $this->pass);
        } catch (PDOException $e) {
            echo "no se pudo conectar";
        }
        return $conex;
    }
} 
     