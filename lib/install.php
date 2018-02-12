<?php
function installBlog(PDO $pdo)
{
    $root = getRootPath();
    $database = getDatabasePath();
    $error = '';

// A security measure, to avoid anyone resetting the database if it already exists
    if (is_readable($database) && filesize($database) > 0) {
        $error = 'Please delete the existing database manually before installing it afresh';
    }

// Create an empty file for the database
    if (!$error) {
        $createdOk = @touch($database);
        if (!$createdOk) {
            $error = sprintf(
                'Could not create the database, please allow the server to create new files in \'%s\'',
                dirname($database)
            );
        }
    }

// Grab the SQL commands we want to run on the database
    if (!$error) {
        $sql = file_get_contents($root . '/data/init.sql');

        if ($sql === false) {
            $error = 'Cannot find SQL file';
        }
    }

// Connect to the new database and try to run the SQL commands
    if (!$error) {
        $result = $pdo->exec($sql);
        if ($result === false) {
            $error = 'Could not run SQL: ' . print_r($pdo->errorInfo(), true);
        }
    }
    return $error;
}

function getAPI(PDO $pdo)
{

    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );

    $response = file_get_contents("http://api.richmondsunlight.com/1.0/bills/2018.json", false, stream_context_create($arrContextOptions));
    $response = json_decode($response, true);
    foreach ($response as $item) {
        $sql = "
        INSERT INTO
        bills
        (title, number, date, status, chamber, outcome)
        VALUES
        (:title, :number, :date, :status, :chamber, :outcome)
        ";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(array('title' => $item['title'], 'number' => $item['number'], 'date' => $item['date_introduced'],
            'status' => $item['status'], 'chamber' => $item['chamber'], 'outcome' => $item['outcome'],
        ));
        echo $item['title'];
    }

}


