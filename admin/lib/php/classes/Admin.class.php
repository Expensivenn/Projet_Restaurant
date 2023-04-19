<?php
//classe métier
class Admin {

    private $_attributs = array();

    public function __construct(array $data){ //data est envoyé par la classe DAO
        $this->hydrate($data);
    }

    public function hydrate($data){
        foreach($data as $champ => $valeur){
            $this->$champ = $valeur;   // $ après $this
            /*
             * $ symbol before $key ($champ) is used to indicate that $key
             * is a variable containing the name of the property or method
             *
             */
        }
    }

    public function __get($champ){
        if(isset($this->_attributs[$champ])){
            return $this->_attributs[$champ];
        }
    }

    public function __set($champ, $valeur){
        $this->_attributs[$champ] = $valeur;
    }


}