<?php
require("models/contact_Model.php");
class ContactController{
        //déclaration des propriétés
    private $contact;

        //déclaration du constructeur
    public function __construct()
    {
        $this->contact = new Contact();
    }

        //déclaration des méthodes
        
            // renvoi vers page Contact
    public function contact()
    {
        $template="contact/contact.phtml";
        require("view/layout.phtml");
    }

            //récupere test et insére les données du contact dans la BDD (nom, message)
    public function ask_contact()
    {
        if(!empty($_POST))
        {
            $contactName=htmlspecialchars($_POST["nom"]);
            $contactMessage=htmlspecialchars($_POST["message"]);
            $insertionMessage = $this->contact->insertContact($contactName, $contactMessage);
            if($insertionMessage == true)
            {
                $message = "Message envoyé";
            }
            else
            {
                $message = "Erreur : le message n'a pas pu être envoyé";
            }
        }
        else
        {
            $message = "Merci de remplir tous les champs";
        }
        $template= "contact/contact.phtml";
        require("view/layout.phtml"); 
    }

            // récupére toute la liste des contacts de la BDD
    public function show_contact()
    {
        $messagesInBdd = $this->contact->getContact();
        $template= "admin/liste_message.phtml";
        require("view/layout.phtml");
    }

            // récupere et supprime le contact séléctionné (id)
    public function delete_contact()
    {
        if(isset($_GET["id"]))
        {
            $messageDelete=$_GET["id"];
            $contactName= $this->contact->getContactById($_GET["id"]);
            $suppression= $this->contact->suppContact($messageDelete);
            if($suppression == true)
            {
                $message = "Message effacé";
            }
            else
            {
                $message = "Erreur : message non effacé";
            }
        $messagesInBdd = $this->contact->getContact();
        $template="admin/liste_message.phtml";
        require("view/layout.phtml");
        }
    }
}
?>