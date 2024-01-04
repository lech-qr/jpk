<?php
# $zakres_od = "2023-07-01"; 
# $zakres_do = "2023-07-31"; 
$zakres_od = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1)); // Pierwszy dzień poprzedniego miesiąca
$zakres_do = date("Y-m-d", mktime(0, 0, 0, date("m"), 0)); // Ostatni dzień poprzedniego miesiąca

$servername = "localhost"; 
$username = "root";
$password = "ilK1ue!gYQCMOgLG";
$dbname = "jpk_minti";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

echo '<?xml version="1.0" encoding="UTF-8"?><tns:JPK xmlns:etd="http://crd.gov.pl/xml/schematy/dziedzinowe/mf/2016/01/25/eD/DefinicjeTypy/" xmlns:tns="http://jpk.mf.gov.pl/wzor/2017/11/13/1113/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">'
    . '<tns:Naglowek>'
    . '<tns:KodFormularza kodSystemowy="JPK_VAT (3)" wersjaSchemy="1-1">JPK_VAT</tns:KodFormularza>'
    . '<tns:WariantFormularza>3</tns:WariantFormularza>'
    . '<tns:CelZlozenia>0</tns:CelZlozenia>'
    . '<tns:DataWytworzeniaJPK>' . $data=date("Y-m-d") . 'T09:30:00</tns:DataWytworzeniaJPK>'
    . '<tns:DataOd>' . $zakres_od . '</tns:DataOd>'
    . '<tns:DataDo>' . $zakres_do . '</tns:DataDo>'
    . '<tns:NazwaSystemu>JPK</tns:NazwaSystemu>'
    . '</tns:Naglowek>'
    . '<tns:Podmiot1>'
    . '<tns:NIP>7123290950</tns:NIP>'
    . '<tns:PelnaNazwa>MINTI sp z. o.o.</tns:PelnaNazwa>'
    . '<tns:Email>lech@mintishop.pl</tns:Email>'
    . '</tns:Podmiot1>'
        . '';

$sql = "SELECT LpSprzedazy, NrKontrahenta, NazwaKontrahenta, AdresKontrahenta, DowodSprzedazy, DataWystawienia, DataSprzedazy, K_19 FROM 22_01";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // Policz ile jestwierszy sprzedaży
    $rowcount = mysqli_num_rows( $result );
    // Polcz podatek należny
    
    
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<tns:SprzedazWiersz>'
        . '<tns:LpSprzedazy>' . $row["LpSprzedazy"]. '</tns:LpSprzedazy>'
        . '<tns:NrKontrahenta>' . $row["NrKontrahenta"]. '</tns:NrKontrahenta>'
        . '<tns:NazwaKontrahenta>' . $row["NazwaKontrahenta"]. '</tns:NazwaKontrahenta>'
        . '<tns:AdresKontrahenta>' . $row["AdresKontrahenta"]. '</tns:AdresKontrahenta>'
        . '<tns:DowodSprzedazy>' . $row["DowodSprzedazy"]. '</tns:DowodSprzedazy>'
        . '<tns:DataWystawienia>' . $row["DataWystawienia"]. '</tns:DataWystawienia>'
        . '<tns:DataSprzedazy>' . $row["DataSprzedazy"]. '</tns:DataSprzedazy>';
        if ($row["K_19"] !== "0.00") { 
            echo '<tns:K_22>' . number_format($row["K_19"], 2, ',', '') . '</tns:K_22>';
        }
    echo '</tns:SprzedazWiersz>';
  }

$sql = "SELECT SUM(K_19) from 22_01";
$result = $conn->query($sql);  
  
echo "<tns:SprzedazCtrl>"
    . "<tns:LiczbaWierszySprzedazy>" . $rowcount . "</tns:LiczbaWierszySprzedazy>";
while($row = mysqli_fetch_array($result)){
    $netto = $row['SUM(K_19)'];
    echo "<tns:PodatekNalezny>" . $netto . "</tns:PodatekNalezny>";
}
    echo "</tns:SprzedazCtrl>"
    . "</tns:JPK>";  

} else {
  echo "0 results";
}
$conn->close();
?>