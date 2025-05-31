<?php
require_once('database.php');

class User
{
    public function get_all_users()
    {
        $db = db_connect();
        $stmt = $db->query("SELECT id, username, created_at FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function register(string $username, string $password): bool
    {
        if (!$this->is_password_strong($password) || $this->exists($username)) {
            return false;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $db = db_connect();
        $stmt = $db->prepare(
            "INSERT INTO users (username, password) VALUES (:u, :h)"
        );
        return $stmt->execute([':u' => $username, ':h' => $hash]);
    }

    public function authenticate(string $username, string $password): bool
    {
        $db = db_connect();
        $stmt = $db->prepare(
            "SELECT password FROM users WHERE username = :u LIMIT 1"
        );
        $stmt->execute([':u' => $username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row && password_verify($password, $row['password']);
    }

    private function exists(string $username): bool
    {
        $db = db_connect();
        $stmt = $db->prepare(
            "SELECT 1 FROM users WHERE username = :u LIMIT 1"
        );
        $stmt->execute([':u' => $username]);
        return (bool) $stmt->fetchColumn();
    }

    private function is_password_strong(string $p): bool
    {
        return preg_match(
            '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/',
            $p
        );
    }
}
?>