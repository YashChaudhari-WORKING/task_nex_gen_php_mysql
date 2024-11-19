<?php
include 'db.php';

$sql = "SELECT * FROM products ORDER BY RAND() LIMIT 10";
$stmt = $pdo->query($sql);

$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($products) {
    echo json_encode($products);
} else {
    echo json_encode(['error' => 'No products found']);
}
?>
