<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TODO</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
            <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
        <!-- css files -->
        <link rel="stylesheet" href="css/style.css"/>
        <link rel="stylesheet" href="css/all.min.css"/>
<body>
<div class="cont" id="myDIV">
        <h1 class="header">to do list </h1>
        <input type="text" placeholder="Name..."  maxlength="50">
        <span class="add-file" id="myInput">add file</span>
</div>
<div class="mylist">
    <?php
    include_once 'phpclasses.php';
    ?>
    <?php
    $classA = new php_classes();
    $arr = $classA->get();
    foreach($arr as $arrs){
    ?>
<div class="target">
    <span class="id"> <?php echo htmlspecialchars($arrs['id']) ?></span>
    <span class="text"><?php echo htmlspecialchars($arrs['textt']) ?></span>
    <span class="far fa-times-circle close"></span>
    <span class="far fa-edit edit edit1"></span>
    <span class="far fa-check-circle save"></span>
</div>
<?php
    }
    ?>
</div>
<script src="script/script.js"></script>
</body>
</html>