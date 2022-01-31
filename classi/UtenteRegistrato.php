<?php

    class UtenteRegistrato extends Utente{

        public $nickName;
        public $password;
        public $idCliente;
        private $idAmministratore;

        function __construct($nickName, $password, $idCliente) {
            $this->nickName = $nickName;
            $this->password = $password;
            $this->idCliente = $idCliente;
            $this->idAmministratore = -1;
        }

        static function generateAdmin($nickName){
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            if ($stmt = $conn->prepare("UPDATE Login SET idBanca = 1 WHERE Nickname = ?")) {
                $stmt->bind_param("sssd", $nickName);
                $stmt->execute();
            }
            $conn->close();
        }

        public function inserisciUtenteRegistrato(){
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            if ($stmt = $conn->prepare("INSERT INTO Login (idUtente,Nickname,Password,idCliente) VALUES (null,?,?,?)")) {
                $stmt->bind_param("ssi",  $this->nickName, $this->password, $this->idCliente);
                $stmt->execute();
            }
            $conn->close();
        }

    }

?>