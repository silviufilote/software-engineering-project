<?php
session_start();
$sql = '';
$Dati2 = '';
$conn = mysqli_connect('localhost','avoc','','my_avoc');
$stmt = $conn->prepare("select canoneMensile as Rata, o.durata as mesi, o.totDaFinanziare, o.tipo, o.km, v.prezzo, o.anticipo, o.interessi from Veicolo v inner join Operazione o on v.idVeicolo = o.idVeicolo inner join Utente on Utente.ID = o.IDutente where o.IDutente = ? and o.Codice=?");
$stmt->bind_param('ii', $_SESSION['UserId'],$_POST['Codice']);
$stmt->execute();
$result=$stmt->get_result();
while($row = $result->fetch_assoc())
{
  $Rata = number_format($row['Rata'], 2, '.', '');
  $prezzo = number_format($row['prezzo'], 2, '.', '');
  $anticipo = number_format($row['anticipo'], 2, '.', '');
  $Mesi = number_format($row['mesi'], 2, '.', '');
  $totdaFinanziare = number_format($row['totDaFinanziare'], 2, '.', '');
  $Capitale = number_format($totdaFinanziare, 2, '.', '');

  for ($i = 1; $i <= $Mesi; $i++){
    $QuotaInteressi = number_format($Capitale* 0.0304, 2, '.', '');   // il tan mensile prendilo dal db direttamente
    $CapitaleRestituito = number_format($Rata-$QuotaInteressi, 2, '.', '');
    $CapitaleResiduo = number_format($Capitale-$CapitaleRestituito, 2, '.', '');

    $Dati2 = $Dati2.'<tr>';
    $Dati2 = $Dati2.'<td class="pt-3-half" >'.$i.'</td>';
    $Dati2 = $Dati2.'<td class="pt-3-half" >'.number_format($Capitale, 2, '.', '').'</td>';
    $Dati2 = $Dati2.'<td class="pt-3-half" >'.number_format($Rata, 2, '.', '').'</td>';
    $Dati2 = $Dati2.'<td class="pt-3-half" >'.number_format($QuotaInteressi, 2, '.', '').'</td>';
    $Dati2 = $Dati2.'<td class="pt-3-half" >'.number_format($CapitaleRestituito, 2, '.', '').'</td>';
    $Dati2 = $Dati2.'<td class="pt-3-half" >'.number_format($CapitaleResiduo, 2, '.', '').'</td>';

    $Dati2 = $Dati2.'</tr>';

    $Capitale = number_format($Capitale-$CapitaleRestituito, 2, '.', '');
  }
}
echo $Dati2;
?>
