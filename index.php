<?php
    if(isset($_GET['id'])) {
        $id = strip_tags($_GET['id']);
        var_dump($id);
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
    <ul>
        <li>Geladeira<a href="?id=1">Add</a> R$ 1000</li>
        <li>Mouse<a href="?id=2">Add</a> R$ 2000</li>
        <li>Teclado<a href="?id=3">Add</a> R$ 100</li>
        <li>Monitor<a href="?id=4">Add</a> R$ 50</li>
    </ul>
</body>
</html>