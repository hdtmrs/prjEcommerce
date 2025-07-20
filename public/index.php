<?php

    use app\library\Cart;
    use app\library\Product;
    
    require '../vendor/autoload.php';

    session_start();

    

    $product = [
        1 => ['id' => 1, 'name' => 'geladeira', 'price' => 1000, 'quantity' => 1],
        2 => ['id' => 2, 'name' => 'mouse', 'price' => 2000, 'quantity' => 1],
        3 => ['id' => 3, 'name' => 'teclado', 'price' => 100, 'quantity' => 1],
        4 => ['id' => 4, 'name' => 'monitor', 'price' => 50, 'quantity' => 1],
    ];

    if(isset($_GET['id'])) {
        $id = strip_tags($_GET['id']);
        $productInfo = $product[$id];
        $productObj = new Product;
        $productObj->setId($productInfo['id']);
        $productObj->setName($productInfo['name']);
        $productObj->setPrice($productInfo['price']);
        $productObj->setQuantity($productInfo['quantity']);

        $cart = new Cart;
        $cart->add($productObj);

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="./mycart.php">Go to cart</a>

        <ul>
            <?php foreach($product as $item): ?>
                <li><?php echo ucfirst($item['name'])?> |
                    <a href=" ?id=<?php echo $item['id'] ?> ">add</a> |
                    R$ <?php echo number_format($item['price'],2,',','.') ?>
                </li>
            <?php endforeach ?>
        </ul>
    
</body>
</html>