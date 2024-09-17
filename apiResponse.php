<?php

// Step 1: Initialize cURL and fetch data from the API
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.cricapi.com/v1/currentMatches?apikey=fbce46a1-2439-408b-86d8-0ea3ae875368&offset=0',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$response = curl_exec($curl);
curl_close($curl);

// Decode JSON response
$dataArray = json_decode($response, true);

// Check if JSON decoding was successful
if ($dataArray === NULL) {
    die('Error decoding JSON data: ' . json_last_error_msg());
}

// Print data for debugging (optional)
/*echo "<pre>";
print_r($dataArray);
echo "</pre>";*/

// Step 2: Further process the data
if (isset($dataArray['data']) && is_array($dataArray['data'])) {
    foreach ($dataArray['data'] as $item) {
        // Extract relevant data
        $match_id = $item['id'];
        $match_name = $item['name'];
        $description = $item['status'];

        // Output data (for debugging)
        echo "ID: $match_id\n";
        echo "Name: $match_name\n";
        echo "Description: $description\n";
        echo "-----------------------\n";

        // Step 3: Optionally, connect to MySQL and insert data
        // Example MySQL code (you'll need to modify according to your table schema)

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cric";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO matches (name, matchType, status)
                VALUES ('$match_id', '$match_name', '$description')";
  echo $sql;
  //exit();
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);

    }
} else {
    echo "No match data found or incorrect data format.";
}

?>
