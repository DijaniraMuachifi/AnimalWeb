<?php
include_once './include/header.html';
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
        $result = 0;
        $stmt = $db->createNovel($title, $publisher, $year);
        if ($stmt) {
            $result = $title;
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
    $server = new SoapServer(null, ['uri' => "http://localhost/web/admin/soapServer.php"]);
    $server->setClass("AnimalService");
    $server->handle(); // Start handling SOAP requests
} catch (SOAPFault $f) {
    die('SOAP Error: ' . $f->getMessage());
}
$app = new AnimalService;
?>




<!-- Blank Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row  rounded align-items-center justify-content-center mx-0">
        <h2 class="h4 text-center">SOAP server menu</h2>
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
</div>
<!-- Blank End -->




<?php
include_once './include/footer.html';
?>