<?php
session_start();
// on intègre les fichiers php et on instancie les classes
require("configuration/database.php");
require("controllers/admin_Controller.php");
require("controllers/contact_Controller.php");
require("controllers/article_Controller.php");

$adminController = new AdminController();
$contactController= new ContactController();
$articleController= new ArticleController();

// on fait un switch sur le paramètre action
if(isset($_GET["action"]))
{
    switch($_GET["action"])
    {       
          case "connexion":
          $adminController->is_admin();
               break;
          case "authentificationAdmin":
          $adminController->admin();
               break;
          case "home":
          $adminController->home();
               break;
          case "about":
          $adminController->about();
               break;
          case "retourMenu":
          $adminController->retour_menu();
               break; 
          case "contact":
          $contactController->contact();
               break;         
          case "askContact":
          $contactController->ask_contact();
               break; 
          case "showContact":
          $contactController->show_contact();
               break;
          case "deleteContact":
          $contactController->delete_contact();
               break; 
          case "deconnexion":
          $adminController->deconnexion();
               break;  
          case "news":
          $articleController->news();
               break; 
          case "showArticle":
          $articleController->show_article();
               break; 
          case "redigerArticle":
          $articleController->write_article();
               break; 
          case "modifierArticle":
          $articleController->recup_article();
               break;      
          case "deleteArticle":
          $articleController->delete_article();
               break;  
          case "updateArticle":
          $articleController->update_article();
               break; 
          case "addArticle":
          $articleController->add_article();
               break;  
          case "RecupArticle":
          $articleController->refresh_article();
               break;
    }
}
else
{
    $adminController->home();
}
?>