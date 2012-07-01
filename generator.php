<?php
    try {

        require_once('class/images-generator.class.php');

        $width      = isset($_GET['width'])      ? $_GET['width']      : '640';
        $height     = isset($_GET['height'])     ? $_GET['height']     : '480';
        $background = isset($_GET['background']) ? $_GET['background'] : '000000';
        $color      = isset($_GET['color'])      ? $_GET['color']      : 'FFFFFF';
        $text       = isset($_GET['text'])       ? $_GET['text']       : '';

        // create new instance of 'ImageGenerator' class
        $imgGen = new ImageGenerator( $width, $height, $background, $color, $text );

        // display image stream on the browser
        $imgGen->displayImage();

    } catch(Exception $e){
        echo $e->getMessage();
        exit();
    }
?>