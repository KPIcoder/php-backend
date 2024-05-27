<?php
require_once("./connection.php");

$sql_total_offers = "SELECT COUNT(*) AS total_offers FROM property_offer";
$result_total_offers = $conn->query($sql_total_offers);
$total_offers = $result_total_offers->fetch_assoc()['total_offers'];

$sql_total_agencies = "SELECT COUNT(*) AS total_agencies FROM letting_agency";
$result_total_agencies = $conn->query($sql_total_agencies);
$total_agencies = $result_total_agencies->fetch_assoc()['total_agencies'];

$sql_last_offer = "SELECT * FROM property_offer ORDER BY posted_at DESC LIMIT 1";
$result_last_offer = $conn->query($sql_last_offer);
$last_offer = $result_last_offer->fetch_assoc();

$sql_offers_last_month = "SELECT COUNT(*) AS offers_last_month FROM property_offer WHERE posted_at >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_offers_last_month = $conn->query($sql_offers_last_month);
$offers_last_month = $result_offers_last_month->fetch_assoc()['offers_last_month'];

$sql_most_offers_agency = "
    SELECT la.name, COUNT(po.id) AS offer_count
    FROM letting_agency la
    JOIN property_offer po ON la.id = po.letting_agency_id
    GROUP BY la.id
    ORDER BY offer_count DESC
    LIMIT 1
";
$result_most_offers_agency = $conn->query($sql_most_offers_agency);
$most_offers_agency = $result_most_offers_agency->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KPI Page</title>
</head>
<body>
    <h2>KPI Page</h2>
    <p>Total records in property_offer: <?php echo $total_offers; ?></p>
    <p>Total records in letting_agency: <?php echo $total_agencies; ?></p>
    <p>Number of records added in the last month (property_offer): <?php echo $offers_last_month; ?></p>
    
    <h3>Last record in property_offer:</h3>
    <?php if ($last_offer): ?>
        <p>ID: <?php echo $last_offer['id']; ?></p>
        <p>Offer Type: <?php echo $last_offer['offer_type']; ?></p>
        <p>Address: <?php echo $last_offer['address']; ?></p>
        <p>Room Count: <?php echo $last_offer['room_count']; ?></p>
        <p>Price: <?php echo $last_offer['price']; ?></p>
        <p>Posted At: <?php echo $last_offer['posted_at']; ?></p>
    <?php else: ?>
        <p>No records found in property_offer.</p>
    <?php endif; ?>

    <h3>Agency with the Most Offers:</h3>
    <?php if ($most_offers_agency): ?>
        <p>Agency Name: <?php echo $most_offers_agency['name']; ?></p>
        <p>Number of Offers: <?php echo $most_offers_agency['offer_count']; ?></p>
    <?php else: ?>
        <p>No records found in property_offer.</p>
    <?php endif; ?>
</body>
</html>
