<?php
class Alunno implements JsonSerializable{
    protected $nome;
    protected $cognome;
    protected $eta;

    function __construct($id, $nome, $cognome, $eta) {
        $this->id = $id;
        $this->nome = $nome;
        $this->cognome = $cognome;
        $this->eta = $eta;
    }

    function set_id($id) {
        $this->id = $id;
    }

    function set_nome($nome) {
        $this->nome = $nome;
    }

    function set_cognome($cognome){
        $this->cognome = $cognome;
    }

    function set_eta(){
        $this->eta = $eta;
    }
    
    function get_id() {
        return $this->id;
    }

    function get_nome() {
        return $this->nome;
    }
  
    function get_cognome(){
        return $this->cognome;
    }

    function get_eta($eta){
        return $this->eta;
    }

    function toString(){ 
        return "nome: " . $this->nome. "<br>" . "Cognome: " .  $this->cognome . "<br>" . "Età: " . $this->eta . "<br>";
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