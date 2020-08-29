<?php
class Admin{
    //déclaration des propriétés et du constructeur
    private $database;
    private $bdd;

    //déclaration du constructeur
    public function __construct()
    {
        $this->database = new Database();
        $this->bdd=$this->database->getBdd();
    }

    //declarations des methodes
    // récupérer les infos de l'admin
    public function getAdminByEmail($email)
    {
        $query = $this->bdd->prepare("SELECT * FROM admin WHERE email=?");
        $query->execute([$email]);
        $monAdminByEmail = $query->fetch();
        return $monAdminByEmail;
    }
}
?>