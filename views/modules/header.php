<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $this->title; ?></title>

    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/libs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/styles.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <?php
    foreach ($styles as $style) {
        echo '<link rel="stylesheet" href="' . constant('URL') . 'public/css/' . $style . '">';
    }
    ?>
    <?php
    foreach ($jsFiles as $file) {
        echo '<script src="' . constant('URL') . 'public/js/' . $file . '">';
    }
    ?>
</head>

<body>