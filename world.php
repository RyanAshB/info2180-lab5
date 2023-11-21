<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

// Establish a connection to the database
$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

// Check if the 'country' parameter is set in the GET request
if (isset($_GET['country'])) {
    $country = $_GET['country'];

    // Use a prepared statement to avoid SQL injection
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->bindParam(':country', $country, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Output the HTML table directly
    if (!empty($results)) {
        echo '<table>
                <thead>
                    <tr>';
        
        // Assuming the first row in the result contains all necessary keys
        foreach ($results[0] as $key => $value) {
            echo '<th>' . ucfirst(str_replace('_', ' ', $key)) . '</th>'; // Capitalize and replace underscores with spaces
        }
        
        echo '</tr>
                </thead>
                <tbody>';
        
        // Iterate through the results and create rows
        foreach ($results as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }
        
        echo '</tbody>
            </table>';
    } else {
        echo '<p>No results found for the provided country.</p>';
    }
} else {
    // Handle the case where 'country' parameter is not set
    echo '<p>Please provide a country name.</p>';
}
?>
