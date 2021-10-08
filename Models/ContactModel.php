<?php 

namespace App\Models;

class ContactModel extends Model
{
    protected $name;
    protected $email;
    protected $message;

    public function __construct()
    {
        $this->table = 'contacts';
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMesssage($message)
    {
        $this->message = $message;
        return $this;
    }
    
}