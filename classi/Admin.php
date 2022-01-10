<?php

    class Admin extends UtenteRegistrato{

        function __construct($nickName, $password, $idCliente) {
            $this->nickName = $nickName;
            $this->password = $password;
            $this->idCliente = $idCliente;
            $this->idAmministratore = 1;
        }
        

        
        

    }

?>