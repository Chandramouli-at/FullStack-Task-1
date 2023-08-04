<?php

    if (file_exists(__DIR__ . '/.env')) {
        $envVariables = parse_ini_file(__DIR__ . '/.env');
        foreach ($envVariables as $key => $value) {
            putenv("$key=$value");
        }
    }

    $host = getenv('DB_HOST');
    $dbusername = getenv('DB_USERNAME');
    $dbpassword = getenv('DB_PASSWORD');
    $database = getenv('DB_DATABASE');
    
    // Create a connection to the database
    $connection = mysqli_connect($host, $dbusername, $dbpassword, $database);

    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT id FROM users";
    $result = mysqli_query($connection, $query);

    if(empty($result)) {
        $query = "CREATE TABLE users (
                id int(11) AUTO_INCREMENT,
                username varchar(255) NOT NULL,
                password varchar(255) NOT NULL,
                PRIMARY KEY  (ID)
                )";
        $result = mysqli_query($connection, $query);
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Check if the user already exists
        $stmt = $connection->prepare("SELECT username FROM users WHERE username=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $res = $stmt->get_result();

        $data = $res->fetch_all(MYSQLI_ASSOC);

        // Try Data fetching...
        if(empty($data)){
            try {

                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

                // Store into MySQL
                $stmt = $connection->prepare("INSERT INTO users(username, password) VALUES(?,?)");
                $stmt->bind_param("ss", $username, $hashedPassword);
                $stmt->execute();
    
                $last_insert_id = $connection->insert_id;
    
                http_response_code(200);
        
                $response = array(
                    'status' => 'success',
                    'message' => 'Registered',
                    'id' => $last_insert_id
                );
    
                header('Content-Type: application/json');
    
                echo json_encode($response);
    
            } catch (\Throwable $th) {
                //throw $th;
                http_response_code(200);
    
                $response = array(
                    'status' => 'error',
                    'message' => "Registration Failed, Try again",
                    'id' => "null"
                );
    
                header('Content-Type: application/json');
    
                echo json_encode($response);
            }
        }
        else{            
            http_response_code(200);
    
            $response = array(
                'status' => 'error',
                'message' => 'User already exist',
                'id' => "null"
            );
    
            header('Content-Type: application/json');
    
            echo json_encode($response);
        }
    }

?>