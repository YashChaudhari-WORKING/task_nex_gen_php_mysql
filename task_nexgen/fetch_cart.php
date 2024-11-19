<?php

require_once 'db.php'; 
$productIds = isset($_GET['ids']) ? $_GET['ids'] : '';


if (empty($productIds)) {
    echo json_encode(['error' => 'No products in the cart']);
    exit;
}


$productIdsArray = explode(',', $productIds);


$placeholders = implode(',', array_fill(0, count($productIdsArray), '?'));
$query = "SELECT * FROM products WHERE id IN ($placeholders)";


try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($productIdsArray);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($products) {
        echo json_encode($products);
    } else {
        echo json_encode(['error' => 'No products found']);
    }
} catch (PDOException $e) {
  
    echo json_encode(['error' => 'Database error: ' . $e->getMessage()]);
}
?>
