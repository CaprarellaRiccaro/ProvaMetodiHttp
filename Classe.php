<?php
require_once("Alunno.php");

class Classe implements JsonSerializable{
    protected $modo = [];
    public function __construct(){
        $a = new Alunno(1, "Mario", "Rossi", 18);
        $b = new Alunno(2, "Luca", "Bianchi", 19);
        $c = new Alunno(3, "Giuseppe", "Verdi", 20);
        array_push($this->modo, $a);
        array_push($this->modo, $b);
        array_push($this->modo, $c);
    }

    public function aggiungiAlunno($a){
        array_push($this->modo, $a);
    }

    public function eliminaAlunno($a){
        foreach($this->modo as $index => $alunno) {
            if ($alunno->get_nome() == $nome){
                unset($this->modo[$index]);
                return true;
            }
        }
        return false;
    }

    public function getAlunno(){
        foreach($this->modo as $alunno){
            if($alunno->get_nome() == $nome)
                return  $alunno;
        }
        return null;
    }

    function toHTML(){
        $s='<h1>Elenco alunni</h1>';
        foreach($this->modo as $alunno){
            $s.= $alunno->toString();
        }
        return $s;
    }

    public function jsonSerialize() {
        $attrs = [];
        $class_vars = get_class_vars(get_class($this));
        foreach ($class_vars as $name => $value) {
            $attrs[$name]=$this->{$name};
        }
        return $attrs;
    }
}