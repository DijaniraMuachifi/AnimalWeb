<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['startDate'], $_GET['endDate'], $_GET['currencies'])) {
    
    $startDate = $_GET['startDate'];
    $endDate = $_GET['endDate'];
    $currencies = implode(',', $_GET['currencies']);  
    $wsdl = 'http://www.mnb.hu/arfolyamok.asmx?wsdl';
    
    
    try {
        $client = new SoapClient($wsdl);
        
       
        $response = $client->GetExchangeRates(array(
            'startDate' => $startDate,
            'endDate' => $endDate,
            'currencyNames' => $currencies
        ));

       
        if (is_object($response)) {
            $xmlData = $response->GetExchangeRatesResult;

           
            if (!empty($xmlData)) {
                $xml = simplexml_load_string($xmlData);
                if ($xml && $xml->Day) {
                    $ratesAvailable = true;
                } else {
                    $ratesAvailable = false;
                    $message = "No exchange rates found for the selected currencies and dates.";
                }
            } else {
                $ratesAvailable = false;
                $message = "The response from the server is empty or invalid.";
            }
        }
    } catch (SoapFault $e) {
        $ratesAvailable = false;
        $message = 'Error fetching data: ' . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Animal names</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="format-detection" content="telephone=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/normalize.css">
    <link rel="stylesheet" type="text/css" href="../../icomoon/icomoon.css">
    <link rel="stylesheet" type="text/css" href="../../css/vendor.css">
    <link rel="stylesheet" type="text/css" href="../../style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        .form-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            width: 300px;
        }
        .form-container form input, 
        .form-container form select, 
        .form-container form button {
            margin: 10px 0;
            padding: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }
        .message {
            text-align: center;
            color: red;
        }
    </style>

</head>

<body data-bs-spy="scroll" data-bs-target="#header" tabindex="0">

    <div id="header-wrap">

        <div class="top-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <div class="social-links">
                            <ul>
                                <li>
                                    <a href="#"><i class="icon icon-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-youtube-play"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="icon icon-behance-square"></i></a>
                                </li>
                            </ul>
                        </div><!--social-links-->
                    </div>
                    <div class="col-md-6">
                        <div class="right-element">
                            <a href="login.php" class="user-account for-buy"><span>
                                  <?=$user["name"]?></span></a>

                            

                        </div><!--top-right-->
                    </div>

                </div>
            </div>
        </div><!--top-content-->

        <header id="header">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-1">
                        <div class="main-logo">
                            <a href="index.html" class="h6 text-dark">Animal names</a>
                        </div>

                    </div>

                    <div class="col-md-11">

                        <nav id="navbar">
                            <div class="main-menu stellarnav">
                                <ul class="menu-list">
                                    <li class="menu-item active"><a href="http://localhost/animals/home.php">Home</a></li>

                                    <li class="menu-item"><a href="http://localhost/animals/php/soap/soapServer.php" class="nav-link">SOAP server </a>
                                    </li>
                                    <li class="menu-item"><a href="http://localhost/animals/php/soap/soapClient.php" class="nav-link">SOAP client </a>
                                    </li>
                                    <li class="menu-item"><a href="http://localhost/animals/php/soap/soapMNB.php" class="nav-link">SOAP-MNB server
                                        </a></li>
                                    <li class="menu-item"><a href="#http://localhost/animals/php/api/serverAPI.php" class="nav-link">Restful server  </a>
                                    </li>
                                    <li class="menu-item"><a href="http://localhost/animals/php/api/clientAPI.php" class="nav-link">Restful client </a>
                                    </li>
                                    <li class="menu-item"><a href="http://localhost/animals/pdf.php" class="nav-link">PDF
                                        </a></li>
                                </ul>

                                <div class="hamburger">
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                    <span class="bar"></span>
                                </div>

                            </div>
                        </nav>

                    </div>

                </div>
            </div>
        </header>

    </div><!--header-wrap-->


    <h2>Currency Exchange Rates</h2>

    <!-- Form to Input Dates and Select Currencies -->
    <div class="form-container">
        <form action="" method="GET">
            <label for="startDate">Start Date (YYYY-MM-DD):</label>
            <input type="date" id="startDate" name="startDate" required>

            <label for="endDate">End Date (YYYY-MM-DD):</label>
            <input type="date" id="endDate" name="endDate" required>

            <label for="currencies">Select Currencies:</label>
            <select id="currencies" name="currencies[]" multiple required>
                <option value="EUR">EUR</option>
                <option value="USD">USD</option>
                <option value="GBP">GBP</option>
                <option value="CHF">CHF</option>
                <option value="JPY">JPY</option>
            </select>

            <button type="submit">Get Exchange Rates</button>
        </form>
    </div>

    <?php if (isset($ratesAvailable) && !$ratesAvailable): ?>
        <div class="message">
            <p><?php echo $message; ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($ratesAvailable) && $ratesAvailable): ?>
        <h3>Exchange Rates from <?php echo $startDate; ?> to <?php echo $endDate; ?> for currencies: <?php echo $currencies; ?></h3>
        <table>
            <tr>
                <th>Date</th>
                <th>Currency</th>
                <th>Rate</th>
            </tr>
            <?php
            // Loop through XML data and display exchange rates
            foreach ($xml->Day as $day) {
                foreach ($day->Rate as $rate) {
                    echo "<tr>";
                    echo "<td>" . $day['date'] . "</td>";
                    echo "<td>" . $rate['curr'] . "</td>";
                    echo "<td>" . $rate . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    <?php endif; ?>

</body>
</html>

