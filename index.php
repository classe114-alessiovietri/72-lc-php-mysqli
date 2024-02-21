<?php
    define("DB_SERVERNAME", "localhost");
    define("DB_USERNAME","root");
    define("DB_PASSWORD", "root");
    define("DB_NAME", "classe114_university");
    
    // Connect
    $conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // var_dump($conn);
    
    // Check connection
    if ($conn && $conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
    }
    else {
        echo '<h3>';
        echo 'Connessione stabilita con successo';
        echo '</h3>';

        // if (
        //     isset($_GET['id'])
        //     &&
        //     $_GET['id'] != ''
        //     &&
        //     is_numeric($_GET['id'])
        // ) {
        //     $departmentId = intval($_GET['id']);
        //     $sql = "SELECT * FROM departments WHERE id = ".$departmentId;
        //     //      SELECT * FROM departments WHERE id = 5 OR 1=1   -> SQL INJECTION
        // }
        // else {
        //     $sql = "SELECT * FROM departments WHERE id = 9999";
        // }
        // $result = $conn->query($sql);

        if (isset($_GET['id'])) {
            $stmt = $conn->prepare("SELECT * FROM departments WHERE id = ? OR name = ?");
            //                      SELECT * FROM departments WHERE id = 3 OR name = 'Dipartimento di Biologia OR 1=1'
            $stmt->bind_param("is", $departmentId, $departmentName);
            
            // set parameters and execute
            $departmentId = $_GET['id'];
            $departmentName = $_GET['name'];
        }
        else {
            $stmt = $conn->prepare("SELECT * FROM departments");
        }

        // get result
        $stmt->execute();
        $result = $stmt->get_result();

        var_dump($result);

        if ($result != null) {
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo '<ul>';
                        echo '<li>';
                            echo 'ID: '.$row['id'];
                        echo '</li>';
                        echo '<li>';
                            echo 'Name: '.$row['name'];
                        echo '</li>';
                        echo '<li>';
                            echo 'Address: '.$row['address'];
                        echo '</li>';
                        echo '<li>';
                            echo 'Phone: '.$row['phone'];
                        echo '</li>';
                        echo '<li>';
                            echo 'Email: '.$row['email'];
                        echo '</li>';
                        echo '<li>';
                            echo 'Website: '.$row['website'];
                        echo '</li>';
                        echo '<li>';
                            echo 'Head of department: '.$row['head_of_department'];
                        echo '</li>';
                    echo '</ul>';
                }
            }
            else {
                echo "0 results";
            }
        }
        else {
            echo "query error";
        }
        
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP + MySQLi</title>
    </head>
    <body>

        <header>
            HEADER
        </header>

        <main>
            MAIN
        </main>

        <footer>
            FOOTER
        </footer>
        
    </body>
</html>