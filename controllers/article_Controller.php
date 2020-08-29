<?php
require("models/article_Model.php");

class ArticleController{
        //déclaration des propriétés et du constructeur
    private $article;
    
    public function __construct()
    {
        $this->article = new Article();
    }

    //déclaration des méthodes
    public function news()
    {
        $lastArticle = $this->article->lastArticle();
        $allArticles = $this->article->allArticles();
        $template = "article/article.phtml";
        require("view/layout.phtml");
    }  
        
    public function show_article()
    {
        $articles = $this->article->getArticle();
        $template = "admin/liste_article.phtml";
        require("view/layout.phtml");
    }

    public function write_article()
    {
        $template = "admin/add_article.phtml";
        require("view/layout.phtml"); 
    }

    public function add_article()
    {
        if(!empty($_POST["contenu"]))
        { 
            $articleTitle = htmlspecialchars($_POST["titre"]);
            $articleContent = htmlspecialchars($_POST["contenu"]);
            $articleImage = $_FILES["image"]["name"];
            $uploads_dir = 'view/img/articles';
            if(!empty($_FILES['image']['name']))
            {   
                $tmp_name = $_FILES["image"]["tmp_name"];
                $name = $_FILES["image"]["name"];
                move_uploaded_file($tmp_name,"$uploads_dir/$name");
                $lastArticle = $this->article->insertArticle($articleTitle,$articleContent,$articleImage,date("Y-m-d H:m:s"));
                if($lastArticle == true)
                {
                    $message = "L'article a été enregistré avec succès !";
                }
                else
                {
                    $message = "Erreur lors de l'enregistrement : l'article n'a pas pu être enregistré ";
                }
            }
            else
            {
                echo "Problème lors du télechargement";
            }
        }
        else
        {
            $message = "Attention ! Des champs n'ont pas été remplis";
        }
        $articles = $this->article->getArticle();
        $template = "admin/liste_article.phtml";
        require("view/layout.phtml"); 
    }

    public function recup_article()
    {
        if(isset($_GET["id"]))
        { 
            $lastArticle = $this->article->getArticleById($_GET["id"]);
            $template = "admin/update_article.phtml";
            require("view/layout.phtml"); 
        }
        else
        {
        $message = "L'article n'a pas pu être récupéré";
        }
    }

    public function update_article()
    {
        if(!empty($_POST))
        {
            $idArticleUpdate = $_GET["id"];
            $articleTitle = $_POST["titre"];
            $articleContent = $_POST["contenu"];
            $articleImage = $_FILES["image"]["name"];
            $uploads_dir = 'view/img/articles';
            if(!empty($_FILES['image']['name']))
            {   
                $tmp_name = $_FILES["image"]["tmp_name"];
                $name = $_FILES["image"]["name"];
                move_uploaded_file($tmp_name,"$uploads_dir/$name");	
                $modification= $this->article->updateArticle($articleTitle,$articleContent,$articleImage,$idArticleUpdate);	
            }
            else
            {
                $modification = $this->article->updateArticleNoPicture($articleTitle,$articleContent,$idArticleUpdate); 
            } 
            if($modification == true)
            {//tester la variable insertion
                $message = "Mise à jour de l'article enregistrée avec succès";
            }
            else
            {
                $message = "La mise à jour n'a pas été enregistré";
            }
            $articles = $this->article->getArticle();
            $template = "admin/liste_article.phtml";
            require("view/layout.phtml"); 
        }
        else
        {
            header("location:index.php");
        }
    }

    public function delete_article()
    {
        if(isset($_GET["id"]))
        { 
            $idArticleToDelete = $_GET["id"];
            $nameArticleToDelete = $this->article->getArticleById($_GET["id"]);
            $suppression = $this->article->suppArticle($idArticleToDelete);
            $path = "view/img/articles/".$nameArticleToDelete["picture"];
            $test = unlink($path);
            if($suppression == true)
            {//tester la variable insertion
                $message = "L'article a été supprimé avec succès";
            }
            else
            {
                $message = "La suppression de l'article n'a pas été prise en compte";
            }
        $articles = $this->article->getArticle();
        $template = "admin/liste_article.phtml";
        require("view/layout.phtml");
        }
    }

    public function refresh_article()
    {   
        if (isset($_GET["id"]))
        {
            $id = $_GET["id"];
            $lastArticleId = $this->article->getArticleById($id);
            echo json_encode($lastArticleId);
        }
        else
        {
        header("location:index.php"); 
        }
    }
}