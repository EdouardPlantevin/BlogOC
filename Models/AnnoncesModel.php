<?php

namespace App\Models;

use App\Models\Model;


class AnnoncesModel extends Model
{
    protected $id;
    protected $title;
    protected $description;
    protected $createdAt;
    protected $actif;

    public function __construct()
    {
        $this->table = 'annonces';
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($date)
    {
        $this->createdAt = $date;
        return $this;
    }

    public function getActif()
    {
        return $this->actif;
    }
    
    public function setActif($actif)
    {
        $this->actif = $actif;
        return $this;
    }

}