<?php
session_start();
class Sql
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=animal", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    public function close()
    {
        $this->pdo = null;
    }

    public function createAnimal($aname, $species)
    {
        $stmt = $this->pdo->prepare("INSERT INTO animals (aname, species) VALUES (:aname, :species)");
        $stmt->execute([':aname' => $aname, ':species' => $species]);
    }

    public function readAnimals()
    {
        $stmt = $this->pdo->query("SELECT * FROM animals");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function readAnimalsLimit()
    {
        $stmt = $this->pdo->query("SELECT * FROM animals LIMIT 8");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readAnimalById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM animals WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateAnimal($id, $aname, $species)
    {
        $stmt = $this->pdo->prepare("UPDATE animals SET aname = :aname, species = :species WHERE id = :id");
        $stmt->execute([':id' => $id, ':aname' => $aname, ':species' => $species]);
    }

    public function deleteAnimal($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM animals WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }

    public function createNovel( $title, $publisher,$pyear)
    {
        $stmt = $this->pdo->prepare("INSERT INTO novels (pyear, title, publisher) VALUES (:pyear, :title, :publisher)");
        $stmt->execute([':pyear' => $pyear, ':title' => $title, ':publisher' => $publisher]);
    }

    public function readNovels()
    {
        $stmt = $this->pdo->query("SELECT * FROM novels");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readNovelById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM novels WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateNovel($id, $pyear, $title, $publisher)
    {
        $stmt = $this->pdo->prepare("UPDATE novels SET pyear = :pyear, title = :title, publisher = :publisher WHERE id = :id");
        $stmt->execute([':id' => $id, ':pyear' => $pyear, ':title' => $title, ':publisher' => $publisher]);
    }

    public function deleteNovel($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM novels WHERE id = :id");
        $stmt->execute([':id' => $id]);
    }


    public function createConnecting($animalid, $novelid)
    {
        $stmt = $this->pdo->prepare("INSERT INTO connecting (animalid, novelid) VALUES (:animalid, :novelid)");
        $stmt->execute([':animalid' => $animalid, ':novelid' => $novelid]);
    }

    public function readConnectings()
    {
        $stmt = $this->pdo->query("SELECT * FROM connecting");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function readConnectingsWhitAnimals()
    {
        $stmt = $this->pdo->query("SELECT animals.aname as animal, novels.title as novel FROM `connecting` JOIN animals on connecting.animalid=animals.id JOIN novels on connecting.novelid=novels.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readConnectingByAnimalAndNovel($animalid, $novelid)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM connecting WHERE animalid = :animalid AND novelid = :novelid");
        $stmt->execute([':animalid' => $animalid, ':novelid' => $novelid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteConnecting($animalid, $novelid)
    {
        $stmt = $this->pdo->prepare("DELETE FROM connecting WHERE animalid = :animalid AND novelid = :novelid");
        $stmt->execute([':animalid' => $animalid, ':novelid' => $novelid]);
    }
    public function login($username, $password)
{
    // Ensure that the username and password are not empty
    if (empty($username) || empty($password)) {
        return false;
    }

    try {
        // Prepare the query to fetch the user by username
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        // If the user is found
        if ($data) {
            // Verify the password
            if (password_verify($password, $data['pass'])) {
                // Store user data in session
                $_SESSION['USER'] = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'name' => $data['name'],
                    'level' => $data['level'] 
                ];
               return true;
            } else {
                // Incorrect password
                return false;
            }
        } else {
            // User not found
            return false;
        }
    } catch (PDOException $e) {
        // Handle database errors gracefully
        error_log("Login failed: " . $e->getMessage()); // Log the error
        return "Database errors gracefully";  // Return false in case of a database error
    }
}

public function register($name, $username, $password)
{
    // Check if the username already exists
    $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE username = :username");
    $stmt->execute([":username" => $username]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    // If the user already exists, return false
    if ($data) {
        return " Username already exists";
    } else {
        // Proceed with registration
        $stmt = $this->pdo->prepare("INSERT INTO `users` (`name`, `username`, `pass`) VALUES (:name, :username, :pass)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Hash the password
        $stmt->execute([
            ':name' => $name,
            ':username' => $username,
            ':pass' => $hashedPassword
        ]);

        // Check if registration was successful
        if ($stmt->rowCount() > 0) {
            $stmt = $this->pdo->prepare("SELECT id, username,name FROM `users` WHERE username = :username");
            $stmt->execute([":username" => $username]);
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);

            // Start a session and store user data in session variables
           
            $_SESSION['USER'] = [
                'id' => $userData['id'],
                    'username' => $userData['username'],
                    'name' => $userData['name'],
                    'level' => $userData['level'] 
            ];

            return true; // Registration and login successful
        } else {
            return "Registration failed.";
        }
    }
}
function readUsers()  {
    $stmt = $this->pdo->query("SELECT * FROM users");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
