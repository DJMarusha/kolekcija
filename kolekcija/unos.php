<?php
    include ('konekcija.php');   
    if (isset($_POST['pohrani']) && isset($_POST['naslov']) && isset($_POST['zanr']) && isset($_POST['godina']) && isset($_POST['trajanje']) && !($_FILES['slika']['name'] == "")) {   
        $naslov = $_POST ['naslov'];
        $id_zanr = $_POST ['zanr'];
        $godina = $_POST ['godina'];
        $trajanje = $_POST ['trajanje'];
        $direktorij = './slike/';
        $ime_datoteke = basename($_FILES['slika']['name']);
        $datoteka = $direktorij . $ime_datoteke;
        $insert = 'INSERT INTO filmovi (naslov, id_zanr, godina, trajanje, slika) VALUES (?, ?, ?, ?, ?)';
        if (!($pp_upit = $mysqli->prepare ($insert))) {
            echo '<p style = "color:red;">Došlo je do greške: (' . $mysqli->errno . ') ' . $mysqli->error.'</p>';
        }
        else if (!($pp_upit->bind_param ("siiis", $naslov, $id_zanr, $godina, $trajanje, $ime_datoteke))) {
            echo '<p style = "color:red;">Došlo je do greške: (' . $mysqli->errno . ') ' . $mysqli->error.'</p>';
        }        
        else if (!(move_uploaded_file($_FILES['slika']['tmp_name'], $datoteka))) {
            echo '<p style = "color:red;">Pogreška prilikom prijenosa datoteke sa slikom filma!</p>';
        }
        else {
            if(!($pp_upit->execute())) {                
              echo '<p style = "color:red;">Pogreška prilikom zapisivanja filma u kolekciju!</p>';       
            }             
            else {           
                echo '<script type="text/javascript">alert("Film je spremljen u kolekciju filmova!");window.location.replace("unos.php")</script>';
            }    
        }
    }
    
    if (isset ($_GET['akcija'])) {
        $delete = 'DELETE FROM filmovi WHERE id = ?';
        $id = $_GET['id'];    
        if (!($pp_upit = $mysqli->prepare ($delete))) {
            echo '<p style = "color:red;">Došlo je do greške: (' . $mysqli->errno . ') ' . $mysqli->error.'</p>';
        }
        else if (!($pp_upit->bind_param ("i", $id))) {
            echo '<p style = "color:red;">Došlo je do greške: (' . $mysqli->errno . ') ' . $mysqli->error.'</p>';
        }        
        else {
            if(!($pp_upit->execute())) {                
              echo '<p style = "color:red;">Pogreška prilikom brisanja filma iz kolekcije!</p>';       
            }             
            else {
                echo '<script type="text/javascript">alert("Film je izbrisan iz kolekcije filmova!");window.location.replace("unos.php")</script>';        
            }
        }       
    }
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
                         <li><a href = "index.php">Pregled filmova</a></li>
                         <li class="active"><a href="#">Unos filmova</a></li>
                     </ul>
                </div>
            </div>
        </nav>                     
        <div class="container">             
        <form method = 'POST' class="form-horizontal" enctype="multipart/form-data"  role="form" >           
            <div class="form-group">
                <label for="naslov" class="control-label col-sm-2">Naslov filma:</label>
                <div class="col-sm-10">
                    <?php
                        echo '<input type = "text" class="form-control form-rounded" name = "naslov" value = "'.(!isset($_POST['naslov'])?'':$_POST['naslov']).'">';                            
                    ?>
                </div>
            </div>
            <div>
                <?php
                    if (isset($_POST['pohrani']) && $_POST['naslov'] == "") {                        
                                echo '<p class = "error">Naslov filma mora biti upisan!</p>';                             
                    }                        
                ?>
            </div>
            <div class="form-group">
                <label for="zanr" class="control-label col-sm-2">Žanr filma:</label>
                <div class="col-sm-3">
                    <?php
                        $select = 'SELECT id, naziv from zanr';
                        if (!($rezultat = $mysqli->query ($select))) {
                            echo '<p class = "error">Došlo je do greške: (' . $mysqli->errno . ') ' . $mysqli->error.'</p>';
                        }       
                        else {                       
                            echo '<select name = "zanr">';
                            echo '<option value = "" selected>Izaberi:</option>';
                                while ($redak = $rezultat->fetch_assoc()) {
                                    echo '<option value = "'.$redak['id'].'"'.(isset($_POST['zanr']) && ($_POST['zanr'] == $redak['id'])?("selected"):'').' >'.$redak['naziv'].'</option>';
                                }                            
                            echo '</select>';
                        }                        
                    ?>    
                </div>
            </div>
                <?php
                    if (isset($_POST['pohrani']) && $_POST['zanr'] == "") {
                                echo '<p class = "error">Žanr mora biti odabran!</p>';
                    }                        
                ?>                        
            <div class="form-group">
                <label for="godina" class="control-label col-sm-2">Godina proizvodnje:</label>
                <div class="col-sm-3">
                    <select name = "godina">
                        <option value = "" selected>Izaberi:</option>
                            <?php
                                $danas = getdate();
                                $trenutna_godina = $danas['year'];
                                $godina = 1900; 
                                while ($godina <= $trenutna_godina) {
                                    echo '<option value = "'.$godina.'"'.(isset($_POST['godina']) && ($_POST['godina'] == $godina)?("selected"):'').'>'.$godina.'</option>';
                                    $godina++;
                                }
                            ?>
                    </select>
                </div>
            </div>
                <?php
                    if (isset($_POST['pohrani']) && $_POST['godina'] == "") {                        
                        echo '<p class = "error">Godina proizvodnje mora biti odabrana!</p>';                           
                    }                        
                ?>     
                <div class="form-group">
                    <label for="trajanje" class="control-label col-sm-2">Trajanje filma (min.):</label>
                    <div class="col-sm-1">
                        <?php
                            if (!isset($_POST['trajanje'])) {
                                echo '<input type = "number" name = "trajanje" value = "" min = "1" max = "300" class="form-control form-rounded">';
                            }
                            else {
                                echo '<input type = "number" name = "trajanje" value = "'.$_POST['trajanje'].'" min = "1" max = "300" class="form-control form-rounded">';
                            }
                        ?>
                    </div>
                </div>
                <?php
                    if (isset($_POST['pohrani']) && $_POST['trajanje'] == "") {
                        echo '<p class = "error">Trajanje filma mora biti upisano!</p>';
                    }                        
                ?>          
                <div class="form-group">
                    <label for="slika" class="control-label col-sm-2">Slika naslovnice:</label>
                    <div class="col-sm-3">                      
                        <input type = "file" name = "slika" accept="image/*" >                                               
                    </div>
                </div>    
                <?php
                    if (isset($_POST['pohrani']) && $_FILES['slika']['name'] == "") {                        
                                echo '<p class = "error">Slika naslovnice mora biti odabrana!</p>';                         
                    }                       
                ?>       
                <div class="btn-group">
                        <input type = "submit" name = "pohrani" value = "Spremi film u kolekciju" class="btn btn-success">                                                   
                </div>            
        </form>             
        </div>       
<?php
    $select = 'SELECT id, slika, naslov, godina, trajanje FROM filmovi ORDER by 1 DESC';
    $rezultat = $mysqli->query($select);    
    echo '<table width = "500px" align = "center" border = "0" class = "table table-striped">';
        echo '<tr>';
            echo '<th class="text-center">Slika</th><th class="text-left">Naslov filma</th><th class="text-center">Godina</th><th class="text-center">Trajanje</th><th class="text-center">Akcija</th>';
        echo '</tr>';
        if ($rezultat) {
            while ($redak = $rezultat->fetch_assoc()) {
                echo '<tr>';
                    echo '<td align = "center"><img src = "slike/'.$redak['slika'].'" width="100px"></td>';
                    echo '<td>'.$redak['naslov'].'</td>';
                    echo '<td align = "center">'.$redak['godina'].'</td>';
                    echo '<td align = "center">'.$redak['trajanje'].' min</td>';
                    echo '<td align = "center"><a href = "unos.php?akcija=obrisi&id='.$redak['id'].'">[Obriši]</a></td>';
                echo '</tr>';
            }
        }   
    echo '</table>';
?>
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