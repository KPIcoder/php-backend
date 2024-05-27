<?php

require_once("./connection.php");


$sql_create_table = "CREATE TABLE property_offer
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  offer_type VARCHAR(10) NOT NULL,
  address VARCHAR(255) NOT NULL,
  room_count INT NOT NULL,
  price DECIMAL(10, 2) NOT NULL,
  posted_at DATETIME NOT NULL,
  letting_agency_id INT,
  FOREIGN KEY (letting_agency_id) REFERENCES letting_agency(id)
);
";

if($conn->query($sql_create_table)) {
    echo "Таблиця успішно створена";
} else { 
    echo "Помилка при створенні таблиці: " . $conn->error;
}

$sql_insert_data = "INSERT INTO property_offer (offer_type, address, room_count, price, posted_at, letting_agency_id) VALUES
('for sale', '123 Elm St, Springfield', 3, 250000.00, '2024-05-01 10:00:00', 1),
('rent', '456 Oak St, Metropolis', 2, 1500.00, '2024-05-02 11:00:00', 2),
('for sale', '789 Maple St, Smallville', 4, 300000.00, '2024-05-03 12:00:00', 3),
('rent', '101 Pine St, Gotham', 1, 1200.00, '2024-05-04 13:00:00', 4),
('for sale', '202 Birch St, Star City', 5, 450000.00, '2024-05-05 14:00:00', 4),
('rent', '303 Cedar St, Springfield', 3, 1600.00, '2024-05-06 15:00:00', 1),
('for sale', '404 Spruce St, Metropolis', 2, 220000.00, '2024-05-07 16:00:00', 2),
('rent', '505 Redwood St, Smallville', 4, 2000.00, '2024-05-08 17:00:00', 3);
";

if ($conn->query($sql_insert_data)) {
    echo "\nДані успішно додані до таблиці";
} else {
    echo "Помилка при додаванні даних: " . $conn->error;
}
    
$conn->close();
?>