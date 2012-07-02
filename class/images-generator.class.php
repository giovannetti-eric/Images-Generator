<?php

    class ImageGenerator {

        private $width;
        private $height;
        private $bgColor;
        private $color;
        private $text;
        private $img;

        public function __construct( $width = 640, $height = 480, $bgColor = '000000', $color = 'FFFFFF',  $text = '' ) {

            $this->width   = intval($width);
            $this->height  = intval($height);
            $this->bgColor = $this->hexaCssToDecimal($bgColor);
            $this->color   = $this->hexaCssToDecimal($color);
            $this->text    = empty($text) ? $width.' × '.$height : $text;
            $this->buildImageStream();

        }

        // create image stream
        private function buildImageStream() {

            $maxDimension = 9999;

            if( !is_int($this->width) || !is_int($this->height) ) {
                throw new Exception('Dimensions are not an integer.');
            }

            if( $this->width > $maxDimension || $this->height > $maxDimension ) {
                throw new Exception('Dimension not allowed (max value : '. $maxDimension .').');
            }

            if( !$this->img = imagecreate($this->width, $this->height) ){
                throw new Exception('Error creating image stream.');
            }

            // allocate background color on image stream
            imagecolorallocate( $this->img, $this->bgColor[0], $this->bgColor[1], $this->bgColor[2] );

            // allocate text color on image stream
            $color = imagecolorallocate( $this->img, $this->color[0], $this->color[1], $this->color[2] );

            // text parameters
            $font     = 'fonts/mplus-1c-medium.ttf';
            $fontSize = max( min( $this->width / strlen( $this->text ) * 1.15, $this->height * 0.5 ), 5 );

            if( !$textBox = imagettfbbox( $fontSize, 0, $font, $this->text ) ) {
                throw new Exception('Error getting text box.');
            }

            // calculate text coordinates for centering
            $textWidth  = ceil( $textBox[4] - $textBox[1] );
            $textHeight = ceil( abs($textBox[7]) + abs($textBox[1]) );
            $textX      = ceil( ($this->width  - $textWidth)  / 2 );
            $textY      = ceil( ($this->height - $textHeight) / 2 + $textHeight );

            if( !imagettftext( $this->img, $fontSize, 0, $textX, $textY, $color, $font, $this->text ) ) {
                throw new Exception('Error creating image text.');
            }

        }

        // convert hexadecimal CSS color number to decimal number
        private function hexaCssToDecimal($hex) {

            // remove preceding hash if present
            $hex = ($hex[0] == '#') ? substr($hex, 1) : $hex;

            $hexLenght = strlen($hex);

            if( !is_numeric('0x'.$hex) ) {
                throw new Exception($hex.' is not a numeric value.');
            }

            if ( $hexLenght == 3 || $hexLenght == 6 ) {
                // split hexadecimal CSS color into RGB color (shorthand or longhand version)
                $RGB = str_split($hex, $hexLenght/3);
                foreach ($RGB as $color => $c) {
                    // convert hexadecimal CSS shorthand to longhand if necessary
                    $hexLenght == 3 ? $c .= $c : $c;
                    // convert the color to a decimal value
                    $RGB[$color] = hexdec('0x{'.$c.'}');
                }
            } else {
                throw new Exception($hex.' is an invalid CSS color.');
            }

            return $RGB;

        }


        // display image stream on the browser
        public function displayImage() {

            header("Content-type: image/png");

            // display image
            imagepng($this->img);

            // free up memory
            imagedestroy($this->img);

        }

    }

?>