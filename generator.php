<?php
    try {

        require_once('class/images-generator.class.php');

        $width      = !empty($_GET['width'])      ? $_GET['width']      : '640';
        $height     = !empty($_GET['height'])     ? $_GET['height']     : '480';
        $background = !empty($_GET['background']) ? $_GET['background'] : '000000';
        $color      = !empty($_GET['color'])      ? $_GET['color']      : 'FFFFFF';
        $text       = !empty($_GET['text'])       ? $_GET['text']       : '';

        // create new instance of 'ImageGenerator' class
        $imgGen = new ImageGenerator( $width, $height, $background, $color, $text );

        // display image stream on the browser
        $imgGen->displayImage();

    } catch(Exception $e){
        echo $e->getMessage();
        exit();
    }
?>