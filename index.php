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

echo '<?xml version="1.0" encoding="utf-8"?>'
    . '<JPK xmlns:etd="http://crd.gov.pl/xml/schematy/dziedzinowe/mf/2018/08/24/eD/DefinicjeTypy/" xmlns:tns="http://crd.gov.pl/wzor/2020/03/06/9196/">'
    . '<Naglowek>'
    . '<KodFormularza kodSystemowy="JPK_V7M (1)" wersjaSchemy="1-1">JPK_VAT</KodFormularza>'
    . '<WariantFormularza>1</WariantFormularza>'
    . '<DataWytworzeniaJPK>' . $data=date("Y-m-d") . 'T09:30:00</DataWytworzeniaJPK>'    
    . '<NazwaSystemu>MINTI</NazwaSystemu>'
    . '<CelZlozenia>1</CelZlozenia>'
    . '<KodUrzedu>0610</KodUrzedu>'
    . '<Rok>' . $lastYear . '</Rok>'
    . '<Miesiac>' . $lastMonthNumber . '</Miesiac>'
    . '<KodFormularzaDekl kodSystemowy="VAT-7 (21)" kodPodatku="VAT" rodzajZobowiazania="Z" wersjaSchemy="1-1E">VAT-7</KodFormularzaDekl>'
    . '<WariantFormularzaDekl>21</WariantFormularzaDekl>'
    . '</Naglowek>'
    . '<Podmiot1>'
    . '<OsobaNiefizyczna>'
    . '<NIP>7123290950</NIP>'
    . '<PelnaNazwa>MINTI sp z. o.o.</PelnaNazwa>'
    . '<Email>admin@mintishop.pl</Email>'
    . '</OsobaNiefizyczna>'
    . '</Podmiot1>'
        . ''; 

$sql = "SELECT LpSprzedazy, NrKontrahenta, NazwaKontrahenta, AdresKontrahenta, DowodSprzedazy, DataWystawienia, DataSprzedazy, K_13, K_15, K_16, K_17, K_18, K_19, K_20 FROM 22_01";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    // Policz ile jestwierszy sprzedaży
    $rowcount = mysqli_num_rows( $result );
    
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo '<SprzedazWiersz>'
        . '<LpSprzedazy>' . $row["LpSprzedazy"]. '</LpSprzedazy>'
        . '<KodKrajuNadaniaTIN>PL</KodKrajuNadaniaTIN>'
        . '<NrKontrahenta>' . $row["NrKontrahenta"]. '</NrKontrahenta>'
        . '<NazwaKontrahenta>' . $row["NazwaKontrahenta"]. '</NazwaKontrahenta>'
        . '<DowodSprzedazy>' . $row["DowodSprzedazy"]. '</DowodSprzedazy>'
        . '<DataWystawienia>' . $row["DataWystawienia"]. '</DataWystawienia>'
        . '<DataSprzedazy>' . $row["DataSprzedazy"]. '</DataSprzedazy>';
        if ($row["K_13"] !== "0.00") { 
            echo '<K_13>' . number_format($row["K_13"], 2, ',', '') . '</K_13>';
        }
        if ($row["K_15"] !== "0.00") { 
            echo '<K_15>' . number_format($row["K_15"], 2, ',', '') . '</K_15>';
        }
        if ($row["K_16"] !== "0.00") { 
            echo '<K_16>' . number_format($row["K_16"], 2, ',', '') . '</K_16>';
        }
        if ($row["K_17"] !== "0.00") { 
            echo '<K_17>' . number_format($row["K_17"], 2, ',', '') . '</K_17>';
        }
        if ($row["K_18"] !== "0.00") { 
            echo '<K_18>' . number_format($row["K_18"], 2, ',', '') . '</K_18>';
        }
        if ($row["K_19"] !== "0.00") { 
            echo '<K_19>' . number_format($row["K_19"], 2, ',', '') . '</K_19>';
        }
        if ($row["K_20"] !== "0.00") { 
            echo '<K_20>' . number_format($row["K_20"], 2, ',', '') . '</K_20>';
        }
    echo '</SprzedazWiersz>';
  }
  
$sql = "SELECT SUM(K_16), SUM(K_18), SUM(K_20) from 22_01";
$result = $conn->query($sql);   
  
echo "<SprzedazCtrl>"
    . "<LiczbaWierszySprzedazy>" . $rowcount . "</LiczbaWierszySprzedazy>";
while($row = mysqli_fetch_array($result)){
    $podatek = $row['SUM(K_16)'] + $row['SUM(K_18)'] + $row['SUM(K_20)'];
    // $podatek = $row['SUM(K_19)']; // Netto
    echo "<PodatekNalezny>" . $podatek . "</PodatekNalezny>";
}
    echo "</SprzedazCtrl>"
    . "</JPK>";  

} else {
  echo "0 results";
}
$conn->close();
?>
