<?php
class Plat
{
    private $_attributs = array();

    public function __construct(array $data)
    { //data est envoyé par la classe DAO
        $this->hydrate($data);
    }

    public function hydrate($data)
    {
        foreach ($data as $champ => $valeur) {
            $this->$champ = $valeur;   // $ après $this
        }
    }

    public function __get($champ)
    {
        if (isset($this->_attributs[$champ])) {
            return $this->_attributs[$champ];
        }
    }

    public function __set($champ, $valeur)
    {
        $this->_attributs[$champ] = $valeur;
    }
}
