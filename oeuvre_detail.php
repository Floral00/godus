<?php

function get_oeuvre($DATABASE, $id) {
    $DATABASE->query("SET NAMES 'utf8'");
    $DATABASE->query("SET CHARACTER SET utf8");
    $DATABASE->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
    $req = "
        select  OEUVRE_ID,
                OEUVRE_TYPE,
                OEUVRE_PRIX,
                OEUVRE_AUTEUR,
                OEUVRE_TAILLE,
                OEUVRE_DESCRIPTION,
                OEUVRE_IMG,
                OEUVRE_NOM
        from    oeuvre
        where   OEUVRE_ID = $id
    ";
    $query_oeuvre = $DATABASE->query($req);
    if($query_oeuvre) {
        $res_oeuvre = $query_oeuvre->fetch_all(MYSQLI_ASSOC);
    }
    else {
        $res_oeuvre = array("req_oeuvre"=> $req);
    }
    return $res_oeuvre;
}
if(isset($_POST['action'])){
    $action = filter_input(INPUT_POST, "action", FILTER_SANITIZE_STRING);
    $DATABASE = mysqli_connect('localhost', 'root', 'root', 'peinture_sudog');
    switch($action) {
        case 'get_info':
            $allowed = array();
            $allowed[] = 'action';
            $allowed[] = 'id';
            $sent=array_keys($_POST);
            if($allowed !== $sent ) {
                die('erreur');
            }
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
            $data = get_oeuvre($DATABASE, $id);
            //var_dump($data);
            echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            break;
        default:
            break;
    }
    die();
}
include('database.php');
include('session.php');
include("debut.php");

?>
<body>
    <!-- Barre de navigation -->
    <?php
    include("navbar.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-5 col-xs-5">
                <h1 id="titre_oeuvre">Titre</h1>
            </div>
            <div class="col-md-1 col-xs-1"></div>
        </div>
        <div class="row">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-5 col-xs-5 d-inline-flex justify-content-center">
                <img id="img_oeuvre" class="w-50" src=""/>
            </div>
            <div class="col-md-6 col-xs-6"></div>
        </div>
        <div class="row">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-5 col-xs-5">
                <h2>Description</h2>
                <p id="desc_oeuvre">dsfdsf</p>
            </div>
            <div class="col-md-1 col-xs-1"></div>
        </div>

    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01" style="width:500px">
        <div id="caption"></div>
    </div>
    <script type="text/javascript">

        let id = new URLSearchParams(window.location.search).get('id');
        var modal = document.getElementById("myModal");
        var img = document.getElementById("img_oeuvre");
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        var span = document.getElementsByClassName("close")[0];
        $(document).ready(function() {
            if(id !== null) {
                get_oeuvre(id);
            }
        });
        img.onclick = function() {
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }
        span.onclick = function() {
            modal.style.display = "none";
        }
        function get_oeuvre(id) {
            $.ajax({
                method:"POST",
                url:"oeuvre_detail.php",
                scriptCharset: "iso-8859-1",
                cache: false,
                data: {
                    action: 'get_info',
                    id: id
                }
            }).done(function(json_data){
                try {
                    console.log(json_data);
                    var data = JSON.parse(json_data);
                    console.log(data);
                    $('#titre_oeuvre').text(data[0].OEUVRE_NOM);
                    $('#img_oeuvre').attr('src', 'img/'+data[0].OEUVRE_IMG);
                    $('#desc_oeuvre').text(data[0].OEUVRE_DESCRIPTION);
                }
                catch(e) {
                    console.log(e);
                    console.log(json_data);
                }
            });
        }
    </script>

</body>
</html>