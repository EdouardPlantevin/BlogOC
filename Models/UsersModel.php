<?php 

namespace App\Models;

class UsersModel extends Model
{
    protected $id;
    protected $email;
    protected $fullname;
    protected $password;
    protected $roles;

    public function __construct()
    {
        $this->table = 'users';
    }

    public function findOneByEmail(string $email)
    {
        return $this->request("SELECT * FROM $this->table WHERE email = ?", [$email])->fetch();
    }

    public function setSession()
    {
        $_SESSION['user'] = [
            'id' => $this->id,
            'email' => $this->email,
            'fullname' => $this->fullname,
            'roles' => $this->roles
        ];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getFullname()
    {
        return $this->fullname;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles($roles)
    {
        $this->roles = json_decode($roles);
        return $this;
    }
}