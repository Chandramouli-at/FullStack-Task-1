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

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = $_POST["username"];
        $password = $_POST["password"];

        // Check if null
        if(!$username || !$password) {
            http_response_code(200);

            $response = array(
                'status' => 'error',
                'message' => "Login Failed, Try again",
                'id' => "null"
            );

            header('Content-Type: application/json');

            echo json_encode($response);
        } 
        // Main Code to perform Login Functions
        else{
            $stmt = $connection->prepare("SELECT id, username, password FROM users WHERE username=?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            // Try Data fetching...
            if(empty($user)){
                http_response_code(200);
    
                $response = array(
                    'status' => 'error',
                    'message' => 'Invalid Credentials',
                    'id' => "null"
                );
    
                header('Content-Type: application/json');
    
                echo json_encode($response);
            }
            // Success Function
            else{
                http_response_code(200);
                header('Content-Type: application/json');
                
                if (password_verify($password, $user['password'])) {
                    $response = array(
                        'status' => 'success',
                        'message' => 'Logged In',
                        'id' => $user["id"]
                    );

                    echo json_encode($response);
                } else {
                    $response = array(
                        'status' => 'error',
                        'message' => 'Invalid Credentials',
                        'id' => "null"
                    );

                    echo json_encode($response);
                }
            }
        }
    }

?>