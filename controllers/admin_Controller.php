<?php
require("models/admin_Model.php");

class AdminController{
    //déclaration des propriétés et du constructeur
    private $admin;
    
    public function __construct()
    {
        $this->admin = new Admin();
    }

    //déclaration des methodes
    // c'est l'administrateur
    public function is_admin()
    {
        $template = "admin/authentification.phtml"; 
        require("view/layout.phtml");
    }
    // si l'admin est connecté
    public function is_connect()
    {
        if(isset($_SESSION['admin'])){
            return true;
            }
        else{
            return false;
        }
    }
    // vérification si administrateur
    public function admin()
    {
        if(!empty($_POST['email']))
        {
            $emailAdmin = htmlspecialchars($_POST['email']);
            $passwordAdmin = htmlspecialchars($_POST['password']);
            $passwordOk = $this->admin->getAdminByEmail($emailAdmin);
                if($passwordOk == true)
                    if(password_verify($passwordAdmin,$passwordOk['password']))
                    {
                        $_SESSION["admin"]["email"]=$passwordOk["email"];
                        $template = "admin/home_admin.phtml";
                        require("view/layout.phtml");
                    } 
                    else
                    {
                        $message = "Identifiant ou mot de passe incorrect, veuillez essayer à nouveau";
                        $template = "admin/authentification.phtml";  
                        require("view/layout.phtml");
                    }
                }
        
        else
        {
        $template = "admin/authentification.phtml";  
        require("view/layout.phtml");
        }      
    }
    // renvoi vers page "A propos"
    public function about()
    {
        $template = "about/about.phtml";
        require("view/layout.phtml");
    }
    
    // renvoi vers page "Accueil"
    public function home()
    {
        $template = "home.phtml";
        require("view/layout.phtml");
    }
    
    // renvoi vers la page d'accueil lorsque l'admin est connecté
    public function retour_menu()
    {
        $template = "admin/home_admin.phtml";
        require("view/layout.phtml");
    }
    
    // // renvoi vers page "Accueil" lorsque l'admin se déconnecte
    public function deconnexion()
    {
        session_unset();
        session_destroy();
        $template = "admin/home_admin.phtml";
        require("view/layout.phtml");
    }
}

// Les étapes à suivre pour se connecter à la partie administrateur : 
// 1 - Accéder à l'url : index.php?action=connexion
// 2 - Champ email : anthony.liverpool-actu@gmail.com
// 3 - Champ mot de passe : liverpool
?>