<?php
include_once './include/header.html';

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
    <meta charset="UTF-8">
    <title>Currency Exchange Rates</title>
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
        .message {
            text-align: center;
            color: red;
        }
    </style>
</head>
<body>

<h2>Currency Exchange Rates</h2>

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

    <!-- Canvas for Chart.js -->
    <canvas id="exchangeRatesChart" width="400" height="200"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data from PHP to JavaScript
        const labels = [];
        const datasets = {};

        <?php
        // Process XML data for the chart
        foreach ($xml->Day as $day) {
            echo "labels.push('" . $day['date'] . "');"; // Add dates to the X-axis labels

            foreach ($day->Rate as $rate) {
                $currency = (string)$rate['curr'];
                $value = (float)$rate;

                // Initialize the array for each currency if not already set
                if (!isset($datasets[$currency])) {
                    $datasets[$currency] = [];
                }
                $datasets[$currency][] = $value;
            }
        }

        // Pass each currency's data to JavaScript
        foreach ($datasets as $currency => $data) {
            echo "if (!datasets['$currency']) datasets['$currency'] = [];";
            foreach ($data as $value) {
                echo "datasets['$currency'].push($value);";
            }
        }
        ?>

        // Create the chart
        const ctx = document.getElementById('exchangeRatesChart').getContext('2d');
        const exchangeRatesChart = new Chart(ctx, {
            type: 'line', // Line chart type
            data: {
                labels: labels,
                datasets: Object.keys(datasets).map(currency => ({
                    label: currency,
                    data: datasets[currency],
                    fill: false,
                    borderColor: `#${Math.floor(Math.random()*16777215).toString(16)}`, // Random color for each currency
                    tension: 0.1
                }))
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Exchange Rates'
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Rate'
                        },
                        beginAtZero: false
                    }
                }
            }
        });
    </script>
<?php endif; ?>


<?php
include_once './include/footer.html';
?>