<?php
require_once '../config.php';
if (!isset($_SESSION["USER"])) {
    header("Location:login.php");
}
$user=$_SESSION["USER"];



// AnimalService class which handles CRUD operations
class AnimalService
{
    // Fetch Animals
    public function getAnimals()
    {
        $db = new Sql();
        $animals = $db->readAnimals();
        $db->close();
        return $animals;
    }

    // Fetch Novels
    public function getNovels()
    {
        $db = new Sql();
        $novels = $db->readNovels();
        $db->close();
        return $novels;
    }

    // Fetch Connectings
    public function getConnectingsWithAnimals()
    {
        $db = new Sql();
        $connectings = $db->readConnectingsWhitAnimals();
        $db->close();
        return $connectings;
    }

    // CRUD operations for Animals
    public function createAnimal($name, $species)
    {
        $db = new Sql();
        $stmt = $db->createAnimal($name, $species);
        $db->close();
        return $stmt;
    }

    public function updateAnimal($id, $name, $species)
    {
        $db = new Sql();
        $stmt = $db->updateAnimal($id, $name, $species);
        $db->close();
        return $stmt;
    }

    public function deleteAnimal($id)
    {
        $db = new Sql();
        $stmt = $db->deleteAnimal($id);
        $db->close();
        return $stmt;
    }

    // CRUD operations for Novels
    public function createNovels($title, $publisher, $year)
    {
        $db = new Sql();
        $result=0;
        $stmt = $db->createNovel($title, $publisher, $year);
        if ($stmt) {
            $result=$title;
        }
        $db->close();
        return $result;
    }

    public function updateNovel($id, $title, $publisher, $year)
    {
        $db = new Sql();
        $stmt = $db->updateNovel($id, $title, $publisher, $year);
        $db->close();
        return $stmt;
    }

    public function deleteNovel($id)
    {
        $db = new Sql();
        $stmt = $db->deleteNovel($id);
        $db->close();
        return $stmt;
    }

    // CRUD operations for Connections
    public function createConnecting($animalId, $novelId)
    {
        $db = new Sql();
        $stmt = $db->createConnecting($animalId, $novelId);
        $db->close();
        return $stmt;
    }

    public function deleteConnecting($animalId, $novelId)
    {
        $db = new Sql();
        $stmt = $db->deleteConnecting($animalId, $novelId);
        $db->close();
        return $stmt;
    }
}

// Create a SOAP Server instance
try {
    $server = new SoapServer(null, ['uri' => "http://localhost/animals/php/soap/soapServer.php"]);
    $server->setClass("AnimalService");
    $server->handle(); // Start handling SOAP requests
} catch (SOAPFault $f) {
    die('SOAP Error: ' . $f->getMessage());
}
$app= new AnimalService;
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



<!-- Main Content -->
<div class="container mt-4">
    <!-- Tabs Navigation -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="animals-tab" data-bs-toggle="tab" href="#animals" role="tab" aria-controls="animals" aria-selected="true">Animals</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="novels-tab" data-bs-toggle="tab" href="#novels" role="tab" aria-controls="novels" aria-selected="false">Novels</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="connectings-tab" data-bs-toggle="tab" href="#connectings" role="tab" aria-controls="connectings" aria-selected="false">Connectings</a>
        </li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content " id="myTabContent">
        <!-- Animals Tab -->
        <div class="tab-pane fade show active" id="animals" role="tabpanel" aria-labelledby="animals-tab">
            <h3>Animals</h3>
            <table class="table shadow-lg mt-2 px-2" style="padding: 15px;">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Species</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $animals = $app->getAnimals();
                        foreach ($animals as $animal) {
                            echo "<tr>";
                            echo "<td>" . $animal['id'] . "</td>";
                            echo "<td>" . $animal['aname'] . "</td>";
                            echo "<td>" . $animal['species'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Novels Tab -->
        <div class="tab-pane fade" id="novels" role="tabpanel" aria-labelledby="novels-tab">
            <h3 class="mt-2">Novels</h3>
            <table class="table shadow-lg mt-2 px-2">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Year</th>
                        <th>Publisher</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $novels = $app->getNovels();
                        foreach ($novels as $novel) {
                            echo "<tr>";
                            echo "<td>" . $novel['id'] . "</td>";
                            echo "<td>" . $novel['title'] . "</td>";
                            echo "<td>" . $novel['pyear'] . "</td>";
                            echo "<td>" . $novel['publisher'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Connectings Tab -->
        <div class="tab-pane fade" id="connectings" role="tabpanel" aria-labelledby="connectings-tab">
            <h3>Connectings</h3>
            <table class="table shadow-lg mt-2 px-2">
                <thead>
                    <tr>
                        <th>Animal</th>
                        <th>Novel</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $connectings = $app->getConnectingsWithAnimals();
                        foreach ($connectings as $connecting) {
                            echo "<tr>";
                            echo "<td>" . $connecting['animal'] . "</td>";
                            echo "<td>" . $connecting['novel'] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
	include_once '../include/footer.html';
 ?>
