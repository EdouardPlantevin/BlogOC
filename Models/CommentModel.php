<?php 

namespace App\Models;

class CommentModel extends Model
{
    protected $id;
    protected $author;
    protected $article_id;
    protected $content;
    protected $active;

    public function __construct()
    {
        $this->table = 'comments';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }

    public function getArticleId()
    {
        return $this->article_id;
    }

    public function setArticleId($articleId)
    {
        $this->article_id = $articleId;
        return $this;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function getActive()
    {
        return $this->active;
    }
    
    public function setActive($active)
    {
        $this->active = $active;
        return $this;
    }

}