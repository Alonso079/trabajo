<?php
class DataBaseConfig {
    public $servername;
    public $username;
    public $password;
    public $databasename;

    public function __construct() {
        $this->servername = '172.162.1.2';
        $this->username = 'verificacion_1';
        $this->password = 'Cfwt6593@2'; // Asegúrate de manejar y almacenar contraseñas de forma segura
        $this->databasename = 'llaves';
    }
}
?>

