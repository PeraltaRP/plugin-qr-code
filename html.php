<?php
function load_page(){
?>
   
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
        <h1>Qr Code Tainacan</h1>
     
        <div class="container">
            <h1 class="mt-4 mb-4">Pesquisa Item Tainacan</h1>              
                <div class="col-12">
                <?autocomplete()?>
                </div>
            
                <!-- <div class="col-12">
                    <button type="submit" class="btn btn-primary">Sign in</button>
                </div> -->
            </form>
        </div>
    </body>

    </html>
<?
}
