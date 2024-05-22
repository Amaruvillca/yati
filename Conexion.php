<?php

class Conexion {
    // Configuración de la base de datos
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $dbname = "yatini";
    private $conn;

    // Método para establecer la conexión
    public function conectar() {
        // Crear conexión
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar la conexión
        if ($this->conn->connect_error) {
            die("La conexión ha fallado: " . $this->conn->connect_error);
        }
    }

    // Método para obtener la conexión
    public function obtenerConexion() {
        // Verificar si la conexión ya está establecida
        if (!$this->conn) {
            // Si la conexión no está establecida, llamar al método conectar
            $this->conectar();
        }
        return $this->conn;
    }

    // Método para cerrar la conexión
    public function cerrarConexion() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

?>
