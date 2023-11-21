<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if (isset($_GET['country'])) {
    $country = $_GET['country'];

    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->bindParam(':country', $country, PDO::PARAM_STR);
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!empty($results)) {
        echo '<table>
                <thead>
                    <tr>';
        
        foreach ($results[0] as $key => $value) {
            echo '<th>' . ucfirst(str_replace('_', ' ', $key)) . '</th>'; 
        }
        
        echo '</tr>
                </thead>
                <tbody>';
        
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
    echo '<p>Please provide a country name.</p>';
}
?>
