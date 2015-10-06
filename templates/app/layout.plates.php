<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link type="text/css" rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" />

        <title><?=$this->e($title)?></title>

        <?=$this->section('javascript')?>
        <?=$this->section('css')?>
    </head>
    <body>
        <div class="container">
            <?=$this->section('content')?>
        </div>
    </body>
</html>
