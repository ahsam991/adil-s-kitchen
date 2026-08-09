<?php
/**
 * User Model
 */

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['email', 'password', 'first_name', 'last_name', 'phone', 'profile_image', 'remember_token', 'email_verified_at', 'is_active'];
    protected $hidden = ['password', 'remember_token'];

    public function findByEmail(string $email): ?array {
        return $this->firstWhere('email', $email);
    }

    public function getUserRole(int $userId): ?string {
        $sql = "SELECT r.name FROM roles r
                JOIN user_roles ur ON r.id = ur.role_id
                WHERE ur.user_id = :user_id AND r.deleted_at IS NULL LIMIT 1";
        $result = $this->db->fetchOne($sql, ['user_id' => $userId]);
        return $result['name'] ?? null;
    }
}
