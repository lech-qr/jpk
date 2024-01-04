<?php
# $zakres_od = "2023-07-01"; 
# $zakres_do = "2023-07-31"; 
$zakres_od = date("Y-m-d", mktime(0, 0, 0, date("m")-1, 1)); // Pierwszy dzień poprzedniego miesiąca
$zakres_do = date("Y-m-d", mktime(0, 0, 0, date("m"), 0)); // Ostatni dzień poprzedniego miesiąca

// Get the current date
$currentDate = new DateTime();

// Subtract one month from the current date
$lastMonth = clone $currentDate;
$lastMonth->modify('-1 month');

// Get the year and month for the last month
$lastYear = $lastMonth->format('Y');
$lastMonthNumber = $lastMonth->format('m');

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

// echo '<?xml version="1.0" encoding="UTF-8"?><tns:JPK xmlns:etd="http://crd.gov.pl/xml/schematy/dziedzinowe/mf/2016/01/25/eD/DefinicjeTypy/" xmlns:tns="http://jpk.mf.gov.pl/wzor/2017/11/13/1113/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">'
 <!--    . '<tns:Naglowek>'
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
        . ''; -->

echo '<?xml version="1.0" encoding="utf-8"?>'
    . '<JPK xmlns:etd="http://crd.gov.pl/xml/schematy/dziedzinowe/mf/2018/08/24/eD/DefinicjeTypy/" xmlns:tns="http://crd.gov.pl/wzor/2020/03/06/9196/">'
    . '<Naglowek>'
    . '<KodFormularza kodSystemowy="JPK_V7M (1)" wersjaSchemy="1-1">JPK_VAT</KodFormularza>'
    . '<WariantFormularza>1</WariantFormularza>'
    . '<tns:DataWytworzeniaJPK>' . $data=date("Y-m-d") . 'T09:30:00</tns:DataWytworzeniaJPK>'    
    . '<NazwaSystemu>MINTI</NazwaSystemu>'
    . '<CelZlozenia>1</CelZlozenia>'
    . '<KodUrzedu>0610</KodUrzedu>'
    . '<Rok> . $lastMonth->format('Y') . </Rok>'
    . '<Miesiac> . $lastMonth->format('m') . </Miesiac>'
    . '<KodFormularzaDekl kodSystemowy="VAT-7 (21)" kodPodatku="VAT" rodzajZobowiazania="Z" wersjaSchemy="1-1E">VAT-7</KodFormularzaDekl>'
    . '<WariantFormularzaDekl>21</WariantFormularzaDekl>'
    . '</Naglowek>'
    . '<tns:Podmiot1>'
    . '<OsobaNiefizyczna>'
    . '<tns:NIP>7123290950</tns:NIP>'
    . '<tns:PelnaNazwa>MINTI sp z. o.o.</tns:PelnaNazwa>'
    . '<tns:Email>admin@mintishop.pl</tns:Email>'
    . '</OsobaNiefizyczna>'
    . '</tns:Podmiot1>'
        . ''; 

$sql = "SELECT LpSprzedazy, NrKontrahenta, NazwaKontrahenta, AdresKontrahenta, DowodSprzedazy, DataWystawienia, DataSprzedazy, K_13, K_15, K_16, K_17, K_18, K_19, K_20 FROM 22_01";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // Policz ile jestwierszy sprzedaży
    $rowcount = mysqli_num_rows( $result );
    
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<tns:SprzedazWiersz>'
        . '<tns:LpSprzedazy>' . $row["LpSprzedazy"]. '</tns:LpSprzedazy>'
        . '<tns:NrKontrahenta>' . $row["NrKontrahenta"]. '</tns:NrKontrahenta>'
        . '<tns:NazwaKontrahenta>' . $row["NazwaKontrahenta"]. '</tns:NazwaKontrahenta>'
        <!-- . '<tns:AdresKontrahenta>' . $row["AdresKontrahenta"]. '</tns:AdresKontrahenta>' -->
        . '<tns:DowodSprzedazy>' . $row["DowodSprzedazy"]. '</tns:DowodSprzedazy>'
        . '<tns:DataWystawienia>' . $row["DataWystawienia"]. '</tns:DataWystawienia>'
        . '<tns:DataSprzedazy>' . $row["DataSprzedazy"]. '</tns:DataSprzedazy>';
        if ($row["K_13"] !== "0.00") { 
            echo '<tns:K_13>' . number_format($row["K_13"], 2, ',', '') . '</tns:K_13>';
        }
        if ($row["K_15"] !== "0.00") { 
            echo '<tns:K_15>' . number_format($row["K_15"], 2, ',', '') . '</tns:K_15>';
        }
        if ($row["K_16"] !== "0.00") { 
            echo '<tns:K_16>' . number_format($row["K_16"], 2, ',', '') . '</tns:K_16>';
        }
        if ($row["K_17"] !== "0.00") { 
            echo '<tns:K_17>' . number_format($row["K_17"], 2, ',', '') . '</tns:K_17>';
        }
        if ($row["K_18"] !== "0.00") { 
            echo '<tns:K_18>' . number_format($row["K_18"], 2, ',', '') . '</tns:K_18>';
        }
        if ($row["K_19"] !== "0.00") { 
            echo '<tns:K_19>' . number_format($row["K_19"], 2, ',', '') . '</tns:K_19>';
        }
        if ($row["K_20"] !== "0.00") { 
            echo '<tns:K_20>' . number_format($row["K_20"], 2, ',', '') . '</tns:K_20>';
        }
    echo '</tns:SprzedazWiersz>';
  }
  
$sql = "SELECT SUM(K_16), SUM(K_18), SUM(K_20) from 22_01";
$result = $conn->query($sql);   
  
echo "<tns:SprzedazCtrl>"
    . "<tns:LiczbaWierszySprzedazy>" . $rowcount . "</tns:LiczbaWierszySprzedazy>";
while($row = mysqli_fetch_array($result)){
    $podatek = $row['SUM(K_16)'] + $row['SUM(K_18)'] + $row['SUM(K_20)'];
    // $podatek = $row['SUM(K_19)']; // Netto
    echo "<tns:PodatekNalezny>" . $podatek . "</tns:PodatekNalezny>";
}
    echo "</tns:SprzedazCtrl>"
    . "</tns:JPK>";  

} else {
  echo "0 results";
}
$conn->close();
?>
