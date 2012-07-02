<?php $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?> 
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Images Generator</title>
        <meta name="description" content="">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <header id="header">
            <h1>Images Generator</h1>
        </header>

        <div id="main" role="main">
        
            <div id="preview">
                <section>
                    <header><h2>Preview</h2></header>
                    <div class="content">
                        <figure>
                            <img src="<?php echo $url; ?>640x480/000000/FFFFFF" alt="" />
                            <figcaption><a href="<?php echo $url; ?>640x480/000000/FFFFFF"><?php echo $url; ?>640x480/000000/FFFFFF</a></figcaption>
                        </figure>
                    </div>
                </section>
            </div>

            <div id="parameters">
                <form>
                    <fieldset>
                        <legend>Parameters :</legend>
                        <label for="width">
                            <span class="text">Width :</span>
                            <input type="text" name="width" id="width" value="640" size="4" maxlength="4">
                        </label> -
                        <label for="height">
                            <span class="text">Height :</span>
                            <input type="text" name="height" id="height" value="480" size="4" maxlength="4">
                        </label> -
                        <label for="bgColor">
                            <span class="text">Background :</span>
                            <input type="text" name="bgColor" id="bgColor" value="000000" size="6" maxlength="6">
                        </label> -
                        <label for="fgColor">
                            <span class="text">Color :</span>
                            <input type="text" name="fgColor" id="fgColor" value="FFFFFF" size="6" maxlength="6">
                        </label> -
                        <label for="text">
                            <span class="text">Text :</span>
                            <input type="text" name="text" id="text" value="" size="12">
                        </label>
                    </fieldset>
                </form>
            </div>

        </div>

        <footer id="footer">
            By <a href="http://eric.giovannetti.pro">Eric Giovannetti</a> - Initial sources : <a href="http://http://www.dummyimage.com/">Dynamic Dummy Image Generator</a>, <a href="http://www.devshed.com/c/a/PHP/Building-an-Image-Generator-Class-with-PHP-5/">Dev Shed</a>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
        <script>

            $(document).ready(function() {
            	$('#parameters input').change(function() {
            		updateDemo();
            	});
            });

            function updateDemo() {
            	var url = '<?php echo $url; ?>';
            	$('#parameters input').each(function(count) {
            		if( $(this).val() ) {
            			switch(count) {
                            case 1:
                                url += 'x' + $(this).val();
                            break;
            				case 2:
            					url += '/' + $(this).val();
            				break;
            				case 3:
            					url += '/' + $(this).val();
            				break;
            				case 4:
                                url += '/' + $(this).val();
            				break;
            				default:
            					url += $(this).val();
            			}
            		}	
            	});
            	$('#preview img').attr('src',url).next('figcaption').find('a').attr('href',url).text(url);
            }

        </script>
    </body>
</html>