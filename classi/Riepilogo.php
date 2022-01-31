<?php

    class Riepilogo {

        public $tipo;
        public $mesi;
        public $targa;
        public $prezzo;
        public $chilometraggio;
        public $anticipo;
        public $riscatto;
        public $fissaKm;
        public $prezzoVeicolo;

        public $tanFisso;
        public $taeg;
        public $tanMensile;

        public $costiFissi;
        public $marchiatura;
        public $speseIstruttoria;
        public $bolli;
        public $pneumatici;
        public $speseRendiconto;
        public $sepa;

        public $totDaFinanziare;
        public $rataMensile;
        public $totDaRimborsare;
        public $interessi;

        public $mesiPagati;


        function __construct($tipo, $targa, $mesi, $prezzo, $chilometraggio, $anticipo, $riscatto, $fissaKm, $prezzoVeicolo, $totDaFinanziare, $rataMensile, $totDaRimborsare, $interessi) {
            $this->tipo = $tipo;
            $this->targa = $targa;
            $this->mesi = $mesi;
            $this->prezzo = $prezzo;
            $this->chilometraggio = $chilometraggio;
            $this->anticipo = $anticipo;
            $this->riscatto = $riscatto;
            $this->fissaKm = $fissaKm;
            $this->prezzoVeicolo = $prezzoVeicolo;


            /*Costanti */

            $this->tanFisso = 3.00;
            $this->taeg = 3.00;
            $this->tanMensile = 3.00;

            /* Costi fissi */

            if ($tipo == 'leasing') {
                $this->costiFissi = 0;
                $this->marchiatura = 0;
                $this->speseIstruttoria = 0;
                $this->bolli = 0;
                $this->pneumatici = 0;
                $this->speseRendiconto = 0;
                $this->sepa = 0;
            } else {
                $this->costiFissi = number_format(200 + 300 + 16 + 3 + 3.50 + number_format(($prezzo * 0.0021) , 2, '.', ''), 2, '.', '');
                $this->marchiatura = 200;
                $this->speseIstruttoria = 300;
                $this->bolli = 16;
                $this->speseRendiconto = 3;
                $this->pneumatici = number_format($prezzo * 0.0021, 2, '.', '');
                $this->sepa = 3.50;
            }

            /* Calcoli dati */
            $this->totDaFinanziare = $totDaFinanziare;
            $this->rataMensile = $rataMensile;
            $this->totDaRimborsare = $totDaRimborsare;
            $this->interessi = $interessi;

            $this->mesiPagati = (rand(1, $mesi));
            
        }

        public function inserisciRiepilogo($sessId){
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            if ($stmt = $conn->prepare("INSERT INTO Operazione (tipo, durata, mesiPagati, anticipo, km, valoreRiscatto, canoneMensile, tanFisso, totDaFinanziare, totDaRimborsare, marchiature, polizzaPneumatici, bolliContrattuali, speseIstruttoria, speseRendiconto, sepa, IDutente, idVeicolo, interessi, tanMensile, taeg) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)")) {
                $stmt->bind_param("siididddddddddddisddd", $this->tipo, $this->mesi, $this->mesiPagati, $this->anticipo, $this->chilometraggio, $this->riscatto, $this->rataMensile, $this->tanFisso, $this->totDaFinanziare, $this->totDaRimborsare, $this->marchiatura, $this->pneumatici, $this->bolli, $this->speseIstruttoria, $this->speseRendiconto, $this->sepa, $sessId, $this->targa, $this->interessi, $this->tanMensile, $this->taeg);
                $stmt->execute();
            }
            $conn->close();
        }
        
        public static function creazioneTabella($sessId){
            $conn = mysqli_connect('localhost','avoc','','my_avoc');
            if ($stmt = $conn->prepare("Select o.codice as Codice,o.totdaFinanziare,o.anticipo,v.idVeicolo,v.marca,v.modello,v.versione,v.idVeicolo,o.durata - o.mesiPagati as rimanenti ,canoneMensile as Rata,o.tanFisso,v.Prezzo,o.tipo from Veicolo v inner join Operazione o on v.idVeicolo = o.idVeicolo where o.IDutente = ?")) {
                $stmt->bind_param('i', $sessId);
	            $stmt->execute();
                return $stmt->get_result();
            }else{
                echo "Errore";
            }
            $conn->close();
        }
    }


?>