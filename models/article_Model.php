<?php
class Article{
    //déclaration des proprietes et du constructeur
    private $database;
    private $bdd;

    public function __construct()
    {
        $this->database = new Database();
        $this->bdd = $this->database->getBdd();
    }

    //déclaration des méthodes
    // insérer un article
    public function insertArticle($articleTitle, $articleContent, $articleImage)
    {
        $query = $this->bdd->prepare("INSERT INTO articles (title, content, picture, date)VALUES(?,?,?,?)"); 
        $addArticle = $query->execute([$articleTitle, $articleContent, $articleImage, date("Y-m-d H:m:s")]);
        return $addArticle;
    }
    // récupérer tous les articles
    public function getArticle()
    {
        $query = $this->bdd->prepare("SELECT id, title, content, picture FROM articles"); 
        $query->execute();
        $articles = $query->fetchAll();
        return $articles;
    }
    // récupérer le dernier article
    public function lastArticle()
    {
        $query = $this->bdd->prepare("SELECT id, title, content, date, picture FROM articles ORDER BY date DESC LIMIT 1"); 
        $query->execute();
        $lastArticle=$query->fetchAll();
        return $lastArticle;
    }
    // récupérer tous les articles triés par date
    public function allArticles()
    {
        $query = $this->bdd->prepare("SELECT id, title, content, date FROM articles ORDER BY date DESC"); 
        $query->execute();
        $allArticles=$query->fetchAll();
        return $allArticles;
    }
    // récupérer un article
    public function getArticleById($id)
    {
        $query = $this->bdd->prepare("SELECT * FROM articles WHERE id=?");  
        $query->execute([$id]);
        $lastArticleId=$query->fetch();  
        return $lastArticleId; 
    }
    // mettre à jour un article
    public function updateArticle($articleTitle, $articleContent, $articleImage, $champId)
    {
        $query = $this->bdd->prepare("UPDATE articles SET title=?, content=?, picture=? WHERE id=?"); 
        $modifArticle=$query->execute([$articleTitle,$articleContent,$articleImage,$champId]);
        return $modifArticle;
    }
    // mettre à jour un article qui ne comporte pas de photo
    public function updateArticleNoPicture($articleTitle,$articleContent,$champId)
    {
        $query = $this->bdd->prepare("UPDATE articles SET title=?, content=? WHERE id=?");
        $modifArticleNoPicture=$query->execute([$articleTitle,$articleContent,$champId]);
        return $modifArticleNoPicture;
    }
    // supprimer un article
    public function suppArticle($champId)
    {
        $query = $this->bdd->prepare("DELETE FROM articles WHERE id=?"); 
        $suppArticle = $query->execute([$champId]);
        return $suppArticle;
    }
}
?>