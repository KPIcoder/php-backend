<?php
require_once("./connection.php");

$sql = "SELECT * FROM letting_agency";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'width=300, height=250>";
    echo "<tr><th>ID</th><th>Company Name</th><th>Offers</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["id"]."</td>";
        echo "<td>".$row["name"]."</td>";
        echo "<td><a href='view_offers.php?id=".$row["id"]."'>View Offers</a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<br>
        <a href='http://localhost/add_agency.php'>Додати компанію</a>";
} else {
    echo "0 результатів";
}

$conn->close();