<?php
    require '../vendor/autoload.php';

    if (file_exists(__DIR__ . '/.env')) {
        $envVariables = parse_ini_file(__DIR__ . '/.env');
        foreach ($envVariables as $key => $value) {
            putenv("$key=$value");
        }
    }

    $MONGO_CLUSTER=getenv('MONGO_CLUSTER');
    $MONGO_DATABASE=getenv('MONGO_DATABASE');
    $MONGO_COLLECTION=getenv('MONGO_COLLECTION');

    session_start();

    $redis = new Redis();
    $redis->connect('localhost', 6379);
    $sessionId = session_id();
    $userData = $redis->get("session:$sessionId");

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $action = $_POST["action"];

        switch ($action) {
            case 'sessionData':

                $id = $_POST["id"];
                // Check if the session data exists
                $userExists = $redis->exists("user{$id}"); // Check if the key 'name' exists
                if ($userExists) {
                    $jsonData = $redis->get("user{$id}");

                    // Convert the JSON data back to a PHP array
                    // $dataArray = json_decode($jsonData, true);
                    echo $jsonData;
                } else {
                    echo json_encode([]);
                }
                break;

            case 'save':
                $id = $_POST["id"];
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $age = $_POST["age"];
                $dob = $_POST["dob"];
                $email = $_POST["email"];
                $contact = $_POST["contact"];

                $dataArray = array(
                    'userId' => $id,
                    'fname' => $fname,
                    'lname' => $lname,
                    'age' => $age,
                    'dob' => $dob,
                    'email' => $email,
                    'contact' => $contact
                );

                $jsonData = json_encode($dataArray);

                $redis->set("user{$id}", $jsonData);
    
                // $redis->set('fname', $fname);
                // $redis->set('lname', $lname);
                // $redis->set('age', $age);
                // $redis->set('dob', $dob);
                // $redis->set('email', $email);
                // $redis->set('contact', $contact);

                // $connectionString = $MONGO_CLUSTER;
                $mongoClient = new MongoDB\Client($MONGO_CLUSTER);
                $database = $mongoClient->$MONGO_DATABASE;

                $collection = $database->$MONGO_COLLECTION;
                
                // $result = $collection->insertOne($dataArray);

                $result = $collection->replaceOne(
                    ['userId' => $dataArray['userId']], $dataArray, ['upsert' => true]
                );

                // Check if the insertion was successful
                if ($result->isAcknowledged()) {
                    echo $jsonData;
                } else {
                    echo "Failed to update or insert the document.";
                }

                // echo "success";

                break;
            
            default:
                # code...
                break;
        }
        
        function getSessionData($userData) {
            // Check if the session data exists
            if ($userData) {
                // If data exists, return the session data as JSON
                echo $userData;
            } else {
                // If data does not exist, return an empty JSON object
                echo json_encode([]);
            }
        }

        function saveData() {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $age = $_POST["age"];
            $dob = $_POST["dob"];
            $email = $_POST["email"];
            $contact = $_POST["contact"];

            $redis->set('fname', $fname);
            $redis->set('lname', $lname);
            $redis->set('age', $age);
            $redis->set('dob', $dob);
            $redis->set('email', $email);
            $redis->set('contact', $contact);
        }

    }



?>