<?php 

namespace App\Models;

class ArticleModel extends Model
{
    protected $id;
    protected $title;
    protected $content;
    protected $short_description;
    protected $created_at;
    protected $updated_at;
    protected $author_id;
    protected $active;
    protected $image;

    public function __construct()
    {
        $this->table = 'articles';
    }

    //GETTER
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function getShortDescription()
    {
        return $this->short_description;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getImage()
    {
        return $this->image;
    }

    //SETTER
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    public function setShortDescription($shortDescription)
    {
        $this->short_description = $shortDescription;
        return $this;
    }

    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
        return $this;
    }

    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
        return $this;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
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

    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    //Request

    public function findAllOrder()
    {
        $query = $this->request('SELECT * FROM ' . $this->table . ' WHERE active = 1 ORDER BY updated_at DESC');
        return $query->fetchAll();
    }

}