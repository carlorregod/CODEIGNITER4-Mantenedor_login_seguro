<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <?php
        helper('form');
        $session = session();
    ?>
</head>
<body>

    <h1>Prueba de ingreso al sistema</h1>
    <h4>Bienvenido <?php echo $session->get('userData.firstname').' '.$session->get('userData.firstname'); ?></h4>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Accusantium, soluta, rerum cum atque minus placeat laboriosam, saepe numquam sequi aperiam temporibus cumque illum! Adipisci aliquam earum, quo suscipit illo ratione.</p>
    <?php echo form_open(base_url().'/logout',['id'=>'logout', 'class'=>'logout','method'=>'POST']); ?>
    <?php echo form_submit('salir', 'Salir del sistema',['class'=>'button button-block', 'id'=>'salir']);?>
	<?php echo form_close(); ?>

</body>
</html>