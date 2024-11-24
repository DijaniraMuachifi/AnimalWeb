<?php
// Display errors for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config.php');

$sql = new Sql();
$animalsData = $sql->readAnimals();
$novelsData = $sql->readNovels();

// Contagem de cada espécie de animal
$speciesCount = [];
foreach ($animalsData as $animal) {
    $species = $animal['species'];
    if (isset($speciesCount[$species])) {
        $speciesCount[$species]++;
    } else {
        $speciesCount[$species] = 1;
    }
}

// Preparando dados dos animais para o gráfico
$animalLabels = array_keys($speciesCount);
$animalData = array_values($speciesCount);

// Contagem de romances por ano de publicação
$yearCount = [];
foreach ($novelsData as $novel) {
    $year = $novel['pyear'];
    if (isset($yearCount[$year])) {
        $yearCount[$year]++;
    } else {
        $yearCount[$year] = 1;
    }
}

// Preparando dados dos romances para o gráfico
$novelLabels = array_keys($yearCount);
$novelData = array_values($yearCount);

// Enviando resposta JSON
header('Content-Type: application/json');
echo json_encode([
    'animalLabels' => $animalLabels,
    'animalData' => $animalData,
    'novelLabels' => $novelLabels,
    'novelData' => $novelData
]);
?>
