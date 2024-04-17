<?php
require "DataBaseConfig.php";

class DataBase {
    public $connect;
    public $config;

    public function __construct() {
        $this->config = new DataBaseConfig();
        $this->connect = new mysqli(
            $this->config->servername,
            $this->config->username,
            $this->config->password,
            $this->config->databasename
        );

        if ($this->connect->connect_error) {
            die("Conexión fallida: " . $this->connect->connect_error);
        }
    }

    public function prepareData($data) {
        return $this->connect->real_escape_string(stripslashes(htmlspecialchars($data)));
    }

    public function logIn($table, $username, $password) {
        $username = $this->prepareData($username);
        $stmt = $this->connect->prepare("SELECT username, password FROM {$table} WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                return true; // Login exitoso
            }
        }
        return false; // Login fallido
    }

    public function signUp($table, $fullname, $username, $password) {
        $fullname = $this->prepareData($fullname);
        $username = $this->prepareData($username);
        $password = password_hash($this->prepareData($password), PASSWORD_DEFAULT);
        $stmt = $this->connect->prepare("INSERT INTO {$table} (fullname, username, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $fullname, $username, $password);
        if ($stmt->execute()) {
            return true; // Registro exitoso
        }
        return false; // Fallo en el registro
    }
}
?>
