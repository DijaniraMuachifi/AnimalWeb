<?php
// This file serves as the API for handling CRUD operations for Animals, Novels, and Connections
require_once '../php/config.php';  // Include the database configuration

// AnimalService class that handles CRUD operations for Animals, Novels, and Connections
class AnimalService
{
    // Fetch all animals
    public function getAnimals()
    {
        $db = new Sql();
        $animals = $db->readAnimals();
        $db->close();
        return $animals;
    }

    // Fetch all novels
    public function getNovels()
    {
        $db = new Sql();
        $novels = $db->readNovels();
        $db->close();
        return $novels;
    }

    // Fetch all connections with animals and novels
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
    public function createNovel($title, $publisher, $year)
    {
        $db = new Sql();
        $stmt = $db->createNovel($title, $publisher, $year);
        $db->close();
        return $stmt;
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

// Set the response header to JSON
header('Content-Type: application/json');

// Function to handle API requests
function handleRequest($method, $params) {
    $animalService = new AnimalService();

    // Check the HTTP method and handle accordingly
    if ($method === 'GET') {
        // If no action is specified in the URL, provide basic information about the project
        if (empty($params)) {
            echo json_encode([
                'project_name' => 'Animal Names',
                'author' => 'Dijanira',
                'language' => 'PHP'
            ]);
            return;
        }

        if (isset($params['action'])) {
            switch ($params['action']) {
                case 'getAnimals':
                    echo json_encode($animalService->getAnimals());
                    break;
                case 'getNovels':
                    echo json_encode($animalService->getNovels());
                    break;
                case 'getConnectings':
                    echo json_encode($animalService->getConnectingsWithAnimals());
                    break;
                default:
                    echo json_encode(['error' => 'Invalid action']);
            }
        } else {
            echo json_encode(['error' => 'No action specified']);
        }
    }

    // Handle POST requests for CRUD operations
    elseif ($method === 'POST') {
        parse_str(file_get_contents("php://input"), $params);
        if (isset($params['action'])) {
            switch ($params['action']) {
                case 'createAnimal':
                    $name = $params['animalName'] ?? null;
                    $species = $params['species'] ?? null;
                    if ($name && $species) {
                        $result = $animalService->createAnimal($name, $species);
                        echo json_encode(['success' => 'Animal created', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing animal parameters']);
                    }
                    break;

                case 'createNovel':
                    $title = $params['novelTitle'] ?? null;
                    $publisher = $params['publisher'] ?? null;
                    $year = $params['year'] ?? null;
                    if ($title && $publisher && $year) {
                        $result = $animalService->createNovel($title, $publisher, $year);
                        echo json_encode(['success' => 'Novel created', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing novel parameters']);
                    }
                    break;

                case 'createConnecting':
                    $animalId = $params['animalId'] ?? null;
                    $novelId = $params['novelId'] ?? null;
                    if ($animalId && $novelId) {
                        $result = $animalService->createConnecting($animalId, $novelId);
                        echo json_encode(['success' => 'Connecting created', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing connection parameters']);
                    }
                    break;

                default:
                    echo json_encode(['error' => 'Invalid action']);
            }
        } else {
            echo json_encode(['error' => 'No action specified']);
        }
    }

    // Handle PUT requests for updating data
    elseif ($method === 'PUT') {
        parse_str(file_get_contents("php://input"), $params);
        if (isset($params['action'])) {
            switch ($params['action']) {
                case 'updateAnimal':
                    $id = $params['animalId'] ?? null;
                    $name = $params['animalName'] ?? null;
                    $species = $params['species'] ?? null;
                    if ($id && $name && $species) {
                        $result = $animalService->updateAnimal($id, $name, $species);
                        echo json_encode(['success' => 'Animal updated', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing parameters to update animal']);
                    }
                    break;

                case 'updateNovel':
                    $id = $params['novelId'] ?? null;
                    $title = $params['novelTitle'] ?? null;
                    $publisher = $params['publisher'] ?? null;
                    $year = $params['year'] ?? null;
                    if ($id && $title && $publisher && $year) {
                        $result = $animalService->updateNovel($id, $title, $publisher, $year);
                        echo json_encode(['success' => 'Novel updated', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing parameters to update novel']);
                    }
                    break;

                default:
                    echo json_encode(['error' => 'Invalid action']);
            }
        } else {
            echo json_encode(['error' => 'No action specified']);
        }
    }

    // Handle DELETE requests for deleting data
    elseif ($method === 'DELETE') {
        parse_str(file_get_contents("php://input"), $params);
        echo json_encode(['error' => $params]);
        
        if (isset($params['action'])) {
            switch ($params['action']) {
                case 'deleteAnimal':
                    $id = $params['animalId'] ?? null;
                    if ($id) {
                        $result = $animalService->deleteAnimal($id);
                        echo json_encode(['success' => 'Animal deleted', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing animal ID']);
                    }
                    break;

                case 'deleteNovel':
                    $id = $params['novelId'] ?? null;
                    if ($id) {
                        $result = $animalService->deleteNovel($id);
                        echo json_encode(['success' => 'Novel deleted', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing novel ID']);
                    }
                    break;

                case 'deleteConnecting':
                    $animalId = $params['animalId'] ?? null;
                    $novelId = $params['novelId'] ?? null;
                    if ($animalId && $novelId) {
                        $result = $animalService->deleteConnecting($animalId, $novelId);
                        echo json_encode(['success' => 'Connecting deleted', 'data' => $result]);
                    } else {
                        echo json_encode(['error' => 'Missing connection parameters']);
                    }
                    break;

                default:
                    echo json_encode(['error' => 'Invalid action']);
            }
        } else {
            echo json_encode(['error' => 'No action specified']);
        }
    } else {
        echo json_encode(['error' => 'Method not supported']);
    }
}

// Retrieve the HTTP method
$method = $_SERVER['REQUEST_METHOD'];
$params = $_GET;

// Call the request handler
handleRequest($method, $params);
?>
