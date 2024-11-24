<?php
include_once './include/header.html';



// Initialize SOAP Client
$client = null;
try {
    $client = new SoapClient(null, [
        'location' => "http://localhost/web/admin/soapServer.php",
        'uri'      => "http://localhost/web/admin/soapServer.php",
        'trace'    => 1,
        'exceptions' => true,
    ]);
} catch (SOAPFault $e) {
    echo "SOAP Error: " . $e->getMessage();  // Return SOAP error message
    exit;
}

// Check if the user is logged in
if (!isset($_SESSION["USER"])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION["USER"]; // Get the current logged-in user

// Handle Animal Operations
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Animal Create / Edit / Delete
    if ($action === 'createAnimal' || $action === 'editAnimal' || $action === 'deleteAnimal') {
        $animalId = isset($_POST['animalId']) ? $_POST['animalId'] : null;
        $name = $_POST['animalName'] ?? null;
        $species = $_POST['species'] ?? null;

        try {
            if ($animalId && !$name && !$species) {
                // Delete Animal
                $client->deleteAnimal($animalId);
                echo "Animal successfully deleted!";  // Return success message
                exit;
            } elseif ($animalId && $name && $species) {
                // Update Animal
                $client->updateAnimal($animalId, $name, $species);
                echo "Animal successfully updated!";  // Return success message
                exit;
            } elseif (!$animalId && $name && $species) {
                // Create Animal
                $client->createAnimal($name, $species);
                echo "Animal successfully created!";  // Return success message
                exit;
            }
        } catch (SOAPFault $e) {
            echo "SOAP Error: " . $e->getMessage();  // Return SOAP error message
            exit;
        }
    }

    // Novel Create / Edit / Delete
    if ($action === 'createNovel' || $action === 'editNovel' || $action === 'deleteNovel') {
        $novelId = isset($_POST['novelId']) ? $_POST['novelId'] : null;
        $title = $_POST['novelTitle'] ?? null;
        $publisher = $_POST['publisher'] ?? null;
        $year = $_POST['year'] ?? null;

        try {
            if ($novelId && !$title && !$publisher && !$year) {
                // Delete Novel
                $client->deleteNovel($novelId);
                echo "Novel successfully deleted!";  // Return success message
                exit;
            } elseif ($novelId && $title && $publisher && $year) {
                // Update Novel
                $client->updateNovel($novelId, $title, $publisher, $year);
                echo "Novel successfully updated!";  // Return success message
                exit;
            } elseif (!$novelId && $title && $publisher && $year) {
                // Create Novel
                $client->createNovels($title, $publisher, $year);
                echo "Novel successfully created!";  // Return success message
                exit;
            }
        } catch (SOAPFault $e) {
            echo "SOAP Error: " . $e->getMessage();  // Return SOAP error message
            exit;
        }
    }
}
?>

<!-- Start of HTML content -->
<div class="container-fluid pt-4 px-4">
    <div class="row bg-light rounded align-items-center justify-content-center mx-0">
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
                        <input name="animalId" id="animalId" class="form-control"/>
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
</div>
<!-- End of HTML content -->

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle form submission for animals
        $('#animal-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createAnimal';
            $.post('soapClient.php', formData, function(response) {
                console.log(response);
                
                alert(response); // Show the response message
                $('#animal-form')[0].reset(); // Reset the form
            });
        });

        // Handle form submission for novels
        $('#novel-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createNovel';
            $.post('soapClient.php', formData, function(response) {
                console.log(response);
                alert(response); // Show the response message
                $('#novel-form')[0].reset(); // Reset the form
            });
        });

        // Handle form submission for connecting
        $('#connecting-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createConnecting';
            $.post('soapClient.php', formData, function(response) {
                console.log(response);
                alert(response); // Show the response message
                $('#connecting-form')[0].reset(); // Reset the form
            });
        });
    });
</script>

<?php
include_once './include/footer.html';
?>
