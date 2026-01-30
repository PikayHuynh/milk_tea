<?php

require_once __DIR__ . '/Model.php';

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id';

    /**
     * Get user by email
     * @param string $email
     * @return array|false
     */
    public function getByEmail($email)
    {
        return $this->findOneBy('email', $email);
    }

    /**
     * Verify user password (by email or username)
     * @param string $identifier Email or Username
     * @param string $password
     * @return array|false User data with role_name if password matches, false otherwise
     */
    public function verifyUser($identifier, $password)
    {
        $sql = "SELECT u.*, r.role_name 
                FROM {$this->table} u 
                LEFT JOIN role r ON u.role_id = r.role_id 
                WHERE u.email = :identifier OR u.username = :identifier LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':identifier' => $identifier]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    /**
     * Verify user password (legacy, by email only)
     * @param string $email
     * @param string $password
     * @return array|false User data if password matches, false otherwise
     */
    public function verifyPassword($email, $password)
    {
        return $this->verifyUser($email, $password);
    }

    /**
     * Create user with hashed password
     * @param array $data
     * @return int|false
     */
    public function create($data)
    {
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return parent::create($data);
    }

    /**
     * Update user with optional password hashing
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        } elseif (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }
        return parent::update($id, $data);
    }

    public function getByRoleName($roleName)
    {
        if (!$roleName) {
            return [];
        }

        $sql = "
            SELECT u.*
            FROM {$this->table} u
            JOIN `role` r ON u.role_id = r.role_id
            WHERE r.role_name = :role_name
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'role_name' => $roleName
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}