<?php
class Database
{
    // on déclare les propriétés
    private $bdd;
    // on déclare le constructeur
    public function __construct()
    {
        $this->bdd = new PDO("mysql:host=home.3wa.io;dbname=pa-152_anthonybussi_Liverpool;port=3307;charset=utf8", "anthonybussi", "b2a07786ZmYzMWEzNzc1NmJkYzQ2ZjFkYzViNzAxd715f83f"); 
    }
    // on déclare les méthode
            // on se connecte ici à la base de données
    public function getBdd()
    {
        return $this->bdd;
    }
}
?>