<?php
    include ('konekcija.php');       
?>
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" crossorigin="anonymous">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>  
        <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css">
       
        <meta charset="UTF-8">
        <title>Unos filmova</title>
        <style>
            body {        
                font-family: 'Roboto', sans-serif;                    
            }
            p.error {
                color: red;
                text-align: left;
            } 
            .table .text-center {
                text-align: center
            }
            .table .text-left {
                text-align: left
            }  
        </style>        
    </head>
    <body>       
        <nav class = "navbar navbar-inverse">
            <div class="container">
                <button type = "button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                     <span class="sr-only">Toggle navigation</span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                     <span class="icon-bar"></span>
                </button>
                <a class = "navbar-brand" href="index.php">Kolekcija filmova</a>
                <div class = "navbar-collapse collapse">
                     <ul class="nav navbar-nav navbar-right">
                         <li class="active"><a href="#">Pregled filmova</a></li>
                         <li><a href = "unos.php">Unos filmova</a></li>
                     </ul>
                </div>
            </div>
        </nav>                     
        <div class="container">
            <a href = "index.php?slovo=A">A </a>|
            <a href = "index.php?slovo=B">B </a>|
            <a href = "index.php?slovo=C">C </a>|
            <a href = "index.php?slovo=D">D </a>|
            <a href = "index.php?slovo=E">E </a>|
            <a href = "index.php?slovo=F">F </a>|
            <a href = "index.php?slovo=G">G </a>|
            <a href = "index.php?slovo=H">H </a>|
            <a href = "index.php?slovo=I">I </a>|
            <a href = "index.php?slovo=J">J </a>|
            <a href = "index.php?slovo=K">K </a>|
            <a href = "index.php?slovo=L">L </a>|
            <a href = "index.php?slovo=M">M </a>|
            <a href = "index.php?slovo=N">N </a>|
            <a href = "index.php?slovo=O">O </a>|
            <a href = "index.php?slovo=P">P </a>|
            <a href = "index.php?slovo=R">R </a>|
            <a href = "index.php?slovo=S">S </a>|
            <a href = "index.php?slovo=T">T </a>|
            <a href = "index.php?slovo=U">U </a>|
            <a href = "index.php?slovo=V">V </a>|
            <a href = "index.php?slovo=Z">Z </a>|
        <?php
        if (isset($_GET['slovo'])) {
            $select = "SELECT * FROM filmovi WHERE naslov like '".$_GET['slovo']."%'";            
            $rezultat = $mysqli->query($select);       
            if ($rezultat) {                
                echo '<table align = "center">';
                    while ($redak = $rezultat->fetch_assoc()) {
                        echo '<tr><td align = "center"><img src = "slike/'.$redak['slika'].'" width="100px"></td></tr>';
                        echo '<tr><td align = "center"><i>'.$redak['naslov'].' ('.$redak['godina'].')</i></td></tr>';
                        echo '<tr><td align = "center" height = "50" valign ="top"><i>'.'Trajanje: '.$redak['trajanje'].' min</i></td></tr>';
                    }    
                echo '</table>';
            }
        }
        ?>
        </div>        
        <div class="navbar navbar-default navbar-fixed-bottom">            
            <div class="pull-left">
                <p class="navbar-text">Seminarski rad PHP</p>
            </div>
            <div class="pull-right">    
                <p class="navbar-text">Mario Čaljkušić</p>
            </div>
        </div>
    </body>
</html>