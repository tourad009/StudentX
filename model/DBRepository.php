<?php 
    class DBRepository
    {
        private $host;
        private $dbname;
        private $user;
        private $password;
        protected $db;

        public function __construct()
        {
            $this->host = getenv("DB_HOST") ?: "localhost";
            $this->dbname = getenv("DB_NAME") ?: "studentX";
            $this->user = getenv("DB_USER") ?: "root";
            $this->password = getenv("DB_PASSWORD") ?: "";
            $this-> getConnexion();
        }

        private function getConnexion()
        {
            $dsn = "mysql:host={$this->host}; dbname={$this->dbname}";

            try {
                $this->db = new PDO($dsn, $this->user, $this->password);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $error) {
                error_log("Erreur de connexion à la base de données");
                throw $error;
            }
        }
    }

?>