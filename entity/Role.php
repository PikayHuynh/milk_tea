<?php

require_once __DIR__ . '/Model.php';

class Role extends Model
{
    protected $table = 'role';
    protected $primaryKey = 'role_id';

    /**
     * Get role by name
     * @param string $name
     * @return array|false
     */
    public function getByName($name)
    {
        return $this->findOneBy('role_name', $name);
    }
}