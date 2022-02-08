<?php

    namespace App;


    class Utente{

        public $cognome;
        public $nome;
        public $dataNascita;
        public $CF;
        public $mail;

        function __construct($cognome, $nome, $dataNascita, $CF, $mail ) {
            
            if(strlen($cognome) == 0){
                throw new Exception("Cognome non valido");
            }

            if(strlen($nome) == 0){
                throw new Exception("Nome non valido");
            }

            if(strlen($CF) != 16){
                throw new Exception("Codice fiscale non valido");
            }

            if(strlen($mail) == 0){
                throw new Exception("Mail non valida");
            }

            $this->cognome = $cognome;
            $this->nome = $nome;
            $this->dataNascita = $dataNascita;
            $this->CF = $CF;
            $this->mail = $mail;
        }


        function generaNick($Nick){
            $TemptoCheck = "avoc-".rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            $stmt = $conn->prepare("SELECT count(idUtente) as Esiste from Login where Nickname=?");
            $stmt->bind_param('s',$Nick);
            $stmt->execute();
            $result=$stmt->get_result();
            while($row = $result->fetch_assoc())
            {
              if($row['Esiste']<1){
                $Nick = $TemptoCheck;
              }
            }
              $conn->close();
              return $Nick;
          }

        public function inserisciUtente(){
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            if ($stmt = $conn->prepare("INSERT INTO Utente (cognome, nome, dataNascita, CF, email) VALUES (?,?,?,?,?)")) {
                $stmt->bind_param("sssss", $this->cognome, $this->nome, $this->dataNascita, $this->CF, $this->mail);
                $stmt->execute();
            }
            $conn->close();
        }

        public static function recuperoIdUtente($codiceFiscale){
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            if ($stmt = $conn->prepare("SELECT ID from Utente where CF = ?")) {
                $stmt->bind_param("s", $codiceFiscale);
                $stmt->execute();
                $stmt->bind_result($idUtente);
                $stmt->fetch();
                $conn->close();
            }
            return $idUtente;
        }

    }

?>