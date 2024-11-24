<?php
include_once './include/header.html';
// Function to make cURL requests to the RESTful API

function makeRequest($url, $method = 'GET', $data = [])
{
    $ch = curl_init();
    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method
    ];

    // If there is data (for POST), send it in the request body
    if (!empty($data)) {
        $options[CURLOPT_POSTFIELDS] = http_build_query($data);
    }

    curl_setopt_array($ch, $options);
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Handle form submission for Animal / Novel / Connection operations
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Animal Create / Edit / Delete
    if ($action === 'createAnimal' || $action === 'editAnimal' || $action === 'deleteAnimal') {
        $animalId = $_POST['animalId'] ?? null;
        $name = $_POST['animalName'] ?? null;
        $species = $_POST['species'] ?? null;

        // Determine the method and URL based on the action
        if ($animalId && !$name && !$species) {
            // Delete Animal
            $url = "http://localhost/web/admin/restfullServer.php";
            $response = makeRequest($url, 'DELETE', ["action" => 'deleteAnimal', "animalId" => $animalId]);
            echo "Animal successfully deleted!";
            print_r($response);
        } elseif ($animalId && $name && $species) {
            // Update Animal
            $data = [
                'action' => 'updateAnimal',
                'animalId' => $animalId,
                'animalName' => $name,
                'species' => $species
            ];
            $url = "http://localhost/web/admin/restfullServer.php";
            $response = makeRequest($url, 'PUT', $data);
            echo "Animal successfully updated!";
        } elseif (!$animalId && $name && $species) {
            // Create Animal
            $data = [
                'action' => 'createAnimal',
                'animalName' => $name,
                'species' => $species
            ];
            $url = "http://localhost/web/admin/restfullServer.php";
            $response = makeRequest($url, 'POST', $data);
            echo "Animal successfully created!";
        }
        exit;
    }

    // Novel Create / Edit / Delete
    if ($action === 'createNovel' || $action === 'editNovel' || $action === 'deleteNovel') {
        $novelId = $_POST['novelId'] ?? null;
        $title = $_POST['novelTitle'] ?? null;
        $publisher = $_POST['publisher'] ?? null;
        $year = $_POST['year'] ?? null;

        // Determine the method and URL based on the action
        if ($novelId && !$title && !$publisher && !$year) {
            // Delete Novel
            $url = "http://localhost/web/admin/restfullServer.php?action=deleteNovel&id=$novelId";
            $response = makeRequest($url, 'DELETE', ["action" => 'deleteNovel', "novelId" => $novelId]);
            echo "Novel successfully deleted!";
        } elseif ($novelId && $title && $publisher && $year) {
            // Update Novel
            $data = [
                'action' => 'updateNovel',
                'novelId' => $novelId,
                'novelTitle' => $title,
                'publisher' => $publisher,
                'year' => $year
            ];
            $url = "http://localhost/web/admin/restfullServer.php";
            $response = makeRequest($url, 'PUT', $data);
            echo "Novel successfully updated!";
        } elseif (!$novelId && $title && $publisher && $year) {
            // Create Novel
            $data = [
                'action' => 'createNovel',
                'novelTitle' => $title,
                'publisher' => $publisher,
                'year' => $year
            ];
            $url = "http://localhost/web/admin/restfullServer.php";
            $response = makeRequest($url, 'POST', $data);
            echo "Novel successfully created!";
        }
        exit;
    }

    // Connecting Create
    if ($action === 'createConnecting') {
        $animalId = $_POST['animalId'] ?? null;
        $novelId = $_POST['novelId'] ?? null;

        // Create Connection between Animal and Novel
        $data = [
            'action' => 'createConnecting',
            'animalId' => $animalId,
            'novelId' => $novelId
        ];
        $url = "http://localhost/web/admin/restfullServer.php";
        $response = makeRequest($url, 'POST', $data);

        echo "Connection between Animal and Novel created!";
        exit;
    }
}
?>




<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  bg-light rounded  justify-content-center mx-0">
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
                        <label for="connectionAnimalId" class="form-label">Animal</label>
                        <select name="animalId" id="connectionAnimalId" class="form-control">
                            <!-- Dropdown will be populated dynamically -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="novelId" class="form-label">Novel ID</label>
                        <input type="number" class="form-control" id="novelId" name=" novelId" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Connection</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Blank End -->



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function() {
        // Populate dropdown of animals in connecting tab
        $.get('http://localhost/web/admin/restfullServer.php?action=getAnimals', function(data) {
            let animalSelect = $('#connectionAnimalId');
            data.forEach(function(animal) {
                animalSelect.append(new Option(animal.aname, animal.id));
            });
        });

        // Handle form submission for animals
        $('#animal-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createAnimal';
            $.post('restfullClient.php', formData, function(response) {
                alert(response);
                $('#animal-form')[0].reset(); // Reset form
            });
        });

        // Handle form submission for novels
        $('#novel-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createNovel';
            $.post('restfullClient.php', formData, function(response) {
                alert(response);
                $('#novel-form')[0].reset(); // Reset form
            });
        });

        // Handle form submission for connecting
        $('#connecting-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize() + '&action=createConnecting';
            $.post('restfullClient.php', formData, function(response) {
                alert(response);
                $('#connecting-form')[0].reset(); // Reset form
            });
        });
    });
</script>
<?php
include_once './include/footer.html';
?>