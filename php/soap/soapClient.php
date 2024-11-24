<?php
// Initialize SOAP Client
session_start();
$client = null;
try {
    $client = new SoapClient(null, [
        'location' => "http://localhost/animals/php/soap/soapServer.php",
        'uri'      => "http://localhost/animals/php/soap/soapServer.php",
        'trace'    => 1,
        'exceptions' => true,
    ]);
    
} catch (SOAPFault $e) {
    echo "SOAP Error: " . $e->getMessage();
    exit;
}
if (!isset($_SESSION["USER"])) {
    header("Location:login.php");
}
$user=$_SESSION["USER"];



// Handle Animal Operations
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Animal Create / Edit / Delete
    if ($action === 'createAnimal' || $action === 'editAnimal' || $action === 'deleteAnimal') {
        $animalId = isset($_POST['animalId']) ? $_POST['animalId'] : null;
        $name = $_POST['animalName'] ?? null;
        $species = $_POST['species'] ?? null;
        
        if ($animalId && !$name && !$species) {
            // Delete Animal
            $client->deleteAnimal($animalId);
            echo "Animal successfully deleted!";
        } elseif ($animalId && $name && $species) {
            // Update Animal
            $client->updateAnimal($animalId,  $name, $species);
            echo "Animal successfully updated!";
        } elseif (!$animalId && $name && $species) {
            // Create Animal
            $client->createAnimal($name, $species);
            echo "Animal successfully created!";
        }
        exit;
    }

    // Novel Create / Edit / Delete
    if ($action === 'createNovel' || $action === 'editNovel' || $action === 'deleteNovel') {
        $novelId = isset($_POST['novelId']) ? $_POST['novelId'] : null;
        $title = $_POST['novelTitle'] ?? null;
        $publisher = $_POST['publisher'] ?? null;
        $year = $_POST['year'] ?? null;

        if ($novelId && !$title && !$publisher && !$year) {
            
            // Delete Novel
            $client->deleteNovel($novelId);
            echo "Novel successfully deleted!";
        } elseif ($novelId && $title && $publisher && $year) {
            // Update Novel
            $client->updateNovel($novelId,$title,$publisher,  $year);
            echo "Novel successfully updated!";
        } elseif (!$novelId && $title && $publisher && $year) {
            // Create Novel
            $client->createNovels($title, $publisher, $year);
            echo "Novel successfully created!";
        }
        exit;
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
    <div class="tab-content" id="myTabContent">
        <!-- Animals Tab -->
        <div class="tab-pane fade show active" id="animals" role="tabpanel" aria-labelledby="animals-tab">
            <h3>Add/Update/Delete Animal</h3>
            <form id="animal-form">
                <div class="mb-3">
                    <label for="animalId" class="form-label">Animal ID (for Edit/Delete)</label>
                    <input type="number" class="form-control" id="animalId" name="animalId">
                </div>
                <div class="mb-3">
                    <label for="animalName" class="form-label">Animal Name</label>
                    <input type="text" class="form-control" id="animalName" name="animalName">
                </div>
                <div class="mb-3">
                    <label for="species" class="form-label">Species</label>
                    <input type="text" class="form-control" id="species" name="species">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Novels Tab -->
        <div class="tab-pane fade" id="novels" role="tabpanel" aria-labelledby="novels-tab">
            <h3>Add/Update/Delete Novel</h3>
            <form id="novel-form">
                <div class="mb-3">
                    <label for="novelId" class="form-label">Novel ID (for Edit/Delete)</label>
                    <input type="number" class="form-control" id="novelId" name="novelId">
                </div>
                <div class="mb-3">
                    <label for="novelTitle" class="form-label">Novel Title</label>
                    <input type="text" class="form-control" id="novelTitle" name="novelTitle">
                </div>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher">
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control" id="year" name="year">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <!-- Connectings Tab -->
        <div class="tab-pane fade" id="connectings" role="tabpanel" aria-labelledby="connectings-tab">
            <h3>Add Connection</h3>
            <form id="connecting-form">
                <div class="mb-3">
                    <label for="animalId" class="form-label">Animal</label>
                    <select name="animalId" id="animalId" class="form-control">
                        <?php
                        foreach ($client->getAnimals() as $value) {
                            echo '<option value="'.$value["id"].'">'.$value['aname'].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="novelId" class="form-label">Novel ID</label>
                    <input type="number" class="form-control" id="novelId" name="novelId" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Connection</button>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Handle form submission for animals
        $('#animal-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createAnimal';
            $.post('soapClient.php', formData, function(response) {
                alert(response);
                $('#animal-form')[0].reset(); // Reset form
            });
        });

        // Handle form submission for novels
        $('#novel-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createNovel';
            $.post('soapClient.php', formData, function(response) {
                alert(response);
                $('#novel-form')[0].reset(); // Reset form
            });
        });

        // Handle form submission for connecting
        $('#connecting-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createConnecting';
            $.post('soapClient.php', formData, function(response) {
                alert(response);
                $('#connecting-form')[0].reset(); // Reset form
            });
        });
    });
</script>
<?php
	include_once '../include/footer.html';
 ?>

