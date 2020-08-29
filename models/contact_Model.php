<?php
class Contact{
        //déclaration des proprietes
    private $database;
    private $bdd;

        //déclaration du cnstructeur 
    public function __construct()
    {
        $this->database = new Database();
        $this->bdd=$this->database->getBdd();
    }

        //déclaration des méthodes
            // permet d'inserer un contact 
    public function insertContact($contactName, $contactMessage)
    {
        $query = $this->bdd->prepare("INSERT INTO messages(pseudo, message)VALUES(?,?)"); 
        $addContact = $query->execute([$contactName,$contactMessage]);
        return $addContact;
    }

            // permet de récuperer tous les contacts
    public function getContact()
    {
        $query = $this->bdd->prepare("SELECT id, pseudo, message FROM messages"); 
        $query->execute();
        $mesContacts = $query->fetchAll();
        return $mesContacts;
    }

            // permet de recuperer un contact par son id
    public function getContactById($id)
    {
        $query = $this->bdd->prepare("SELECT * FROM messages WHERE id=?");  
        $query->execute([$id]);
        $monContactId=$query->fetch();  
        return $monContactId; 
    }
        
            // permet de supprimer un contact par son id
    public function suppContact($champId)
    {
        $query = $this->bdd->prepare("DELETE FROM messages WHERE id=?"); 
        $suppContact = $query->execute([$champId]);
        return $suppContact;
    }
}
?>