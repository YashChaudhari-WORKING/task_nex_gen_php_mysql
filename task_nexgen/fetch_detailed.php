<?php
require_once 'db.php';
$productId = isset($_GET['id']) ? $_GET['id'] : null;

if ($productId) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute(['id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($product) {
        echo json_encode([
            'title' => $product['title'],
            'description' => $product['description'],
            'price' => $product['price'],
            'img' => $product['img'], 
            'sold' => $product['sold']
        ]);
    } else {
        echo json_encode(['error' => 'Product not found']);
    }
} else {
    echo json_encode(['error' => 'No product ID provided']);
}
?>
