<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Error <?php echo $this->code ?></title>
    </head>
    <body>
        <h2><?php echo $this->message; ?></h2>
        <h1><?php echo $this->code; ?></h1>
    </body>
</html>