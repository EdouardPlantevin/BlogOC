<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    protected $table;

    private $db;

    public function findAll()
    {
        $query = $this->request('SELECT * FROM ' . $this->table);
        return $query->fetchAll();
    }

    public function findBy(array $params)
    {
        $parameters = [];
        $values = [];

        foreach($params as $parameter => $value)
        {
            $parameters[] = "$parameter = ?";
            $values[] = $value;
        }
        
        $listParameters = implode(' AND ', $parameters);

        return $this->request('SELECT * FROM ' . $this->table . ' WHERE ' . $listParameters, $values)->fetchAll();
    }

    public function find(int $id)
    {
        return $this->request('SELECT * FROM ' . $this->table . ' WHERE id = ' . $id)->fetch();
    }

    public function findOneBy(array $params)
    {
        $parameters = [];
        $values = [];

        foreach($params as $parameter => $value)
        {
            $parameters[] = "$parameter = ?";
            $values[] = $value;
        }
        
        $listParameters = implode(' AND ', $parameters);
        return $this->request('SELECT * FROM ' . $this->table . ' WHERE ' . $listParameters, $value)->fetch();
    }

    public function create()
    {
        $parameters = [];
        $inters = [];
        $values = [];

        foreach($this as $parameter => $value)
        {
            if($value !== null && $parameter != 'db' && $parameter != 'table')
            {
                $parameters[] = $parameter;
                $inters[] = '?';
                $values[] = $value;
            }
        }
        
        $listParameters = implode(', ', $parameters);
        $listInters = implode(', ', $inters);

        return $this->request('INSERT INTO ' . $this->table . ' (' . $listParameters . ' ) VALUES (' . $listInters . ')', $values);
    }

    public function update()
    {
        $parameters = [];
        $inters = [];
        $values = [];

        foreach($this as $parameter => $value)
        {
            if($value !== null && $parameter != 'db' && $parameter != 'table')
            {
                $parameters[] = "$parameter = ?";
                $values[] = $value;
            }
        }
        $values[] = $this->id;
        $listParameters = implode(', ', $parameters);

        return $this->request('UPDATE ' . $this->table . ' SET ' . $listParameters . ' WHERE id = ?', $values);
    }

    public function delete(int $id)
    {
        return $this->request('DELETE FROM ' . $this->table . ' WHERE id = ' . $id);
    }

    public function hydrate($donnees)
    {
        foreach($donnees as $key => $value)
        {
            $setter = 'set' . ucfirst($key);

            if(method_exists($this, $setter))
            {
                $this->$setter($value);
            }
        }

        return $this;
    }

    public function request(string $sql, array $attributs = null)
    {
        $this->db = DB::getInstance();

        if($attributs != null)
        {
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        }
        else 
        {
            return $this->db->query($sql);
        }
    }

    public function getCount()
    {
        $query = $this->request('SELECT * FROM ' . $this->table);
        return $query->rowCount();
    }
}