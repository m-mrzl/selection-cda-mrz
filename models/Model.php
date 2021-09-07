<?php

abstract class Model
{
    private static $_bdd;

    // instancie la connection à la BDD avec PDO
    private static function setBdd()
    {
        self::$_bdd = new PDO('mysql:host=localhost;dbname=miniblog;charset=utf8','root','');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    // recupère la connexion à la BDD
    protected function getBdd()
    {
        if(self::$_bdd == null)
            self::setBdd();
        return self::$_bdd;
    }

    protected function getAll($table, $obj)
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM ' .$table. ' ORDER BY id asc');
        $req->execute();
        while($data = $req->fetch(PDO::FETCH_ASSOC))
        {
            $var[] = new $obj($data);
        }
        return $var;
        $req->closeCursor();
    }
}