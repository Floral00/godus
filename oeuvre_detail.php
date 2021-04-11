<?php

include('session.php');
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

function commander_oeuvre($DATABASE, $id, $prix, $dim, $impression) {
    $req_panier_exist = "
        select  commande.COM_ID 
        from    commande,
                user
        where   user.LOGIN = '".$_SESSION['login']."'
        and     user.USER_ID = commande.USER_ID
        and     commande.COM_LIVRAISON = 'en attente'
    ";


    $query_panier_exist = $DATABASE->query($req_panier_exist);
    if($query_panier_exist) {
        $res_exist = $query_panier_exist->fetch_all(MYSQLI_ASSOC);
    }
    else {
        $res_exist = array("req_oeuvre"=> $req_panier_exist);
        return $res_exist;
    }
    //Une commande est déjà existante
    if(count($res_exist) != 0) {
        $req_ajout_commande = "
        insert into 
        oeuvre_commande (
            OECOM_PRIX, 
            OECOM_DIM_IMPR, 
            OECOM_TYP_IMPR, 
            COM_ID, 
            oeuvre_id
        )
        values (
            '$prix',
            '$dim',
            '$impression',
            ".$res_exist[0]['COM_ID'].",
            $id
        )  
        ";
        $query_ajout_commande = $DATABASE->query($req_ajout_commande);
        if($query_ajout_commande) {
            return array("res"=> "success");
            $res_ajout_commande = $query_ajout_commande->fetch_all(MYSQLI_ASSOC);

        }
        else {
            return array("res"=> "echec");
            $res_ajout_commande = array("req_ajout_commande"=> $req_ajout_commande);

        }
    }
    else {
        $req_id = "
            select  *
            from    user 
            where   LOGIN = '".$_SESSION['login']."'
        ";
        $query_info = $DATABASE->query($req_id);
        if($query_info) {
            $res_info = $query_info->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $res_info = array("req_id"=> $req_id);
            return $res_info;
        }
        $req_creation_commande = "
            insert into 
            commande(
                USER_ID,
                COM_ADRESSE,
                COM_LIVRAISON,
                COM_PAIEMENT,
                COM_TYPE_LIVRAISON
            ) 
            values (
                ".$res_info[0]['USER_ID'].",
                '".$res_info[0]['ADRESSE']."',
                'en attente',
                'en attente',
                'normal'
            )
        ";
        $query_crea_commande = $DATABASE->query($req_creation_commande);
        if($query_crea_commande) {
            $query_panier_exist = $DATABASE->query($req_panier_exist);
            if($query_panier_exist) {
                $res_exist = $query_panier_exist->fetch_all(MYSQLI_ASSOC);
                $req_ajout_commande = "
                    insert into 
                    oeuvre_commande (
                        OECOM_PRIX, 
                        OECOM_DIM_IMPR, 
                        OECOM_TYP_IMPR, 
                        COM_ID, 
                        oeuvre_id
                    )
                    values (
                         $prix,
                        '$dim',
                        '$impression',
                        '".$res_exist[0]['COM_ID']."',
                        '$id'
                    )  
                ";
                $query_ajout_commande = $DATABASE->query($req_ajout_commande);
                if($query_ajout_commande) {
                    return array("res"=> "success");
                }
                else {
                    return array("res"=> "echec");
                    $res_ajout_commande = array("req_ajout_commande"=> $req_ajout_commande);
                }
                return $res_ajout_commande;
            }
            else {
                $res_exist = array("req_oeuvre"=> $req_panier_exist);
                return $res_exist;
            }
        }
        else {
            $res_crea_commande = array("req_creation_commande2"=> $req_creation_commande);
            return $res_crea_commande;
        }
    }
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
        case 'commander_oeuvre':
            $allowed = array();
            $allowed[] = 'action';
            $allowed[] = 'prix';
            $allowed[] = 'id';
            $allowed[] = 'dim';
            $allowed[] = 'impression';
            $sent=array_keys($_POST);
            if($allowed !== $sent ) {
                die('erreur');
            }
            $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_STRING);
            $prix = filter_input(INPUT_POST, "prix", FILTER_SANITIZE_STRING);
            $dim = filter_input(INPUT_POST, "dim", FILTER_SANITIZE_STRING);
            $impression = filter_input(INPUT_POST, "impression", FILTER_SANITIZE_STRING);
            if(isset($_SESSION['login'])) {
                $data = commander_oeuvre($DATABASE, $id, $prix, $dim, $impression);
                //var_dump($data);
                echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
            else {
                echo 'non connecte';
            }
            break;
        default:
            break;
    }
    die();
}
include('database.php');
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
                <b><h1 id="titre_oeuvre"></h1></b>
            </div>

        </div>
        <div class="row">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-5 col-xs-5 d-inline-flex justify-content-center">
                <img id="img_oeuvre" class="w-50" src=""/>
            </div>
            <div class="col-md-6 col-xs-6">
                <h2><b>Informations</b></h2>
                <h4 id="auteur_oeuvre">Auteur:</h4>
                <h4 id="dim_oeuvre">Dimensions:</h4>
                <br/>
                <h2><b>Options commande</b></h2>
                <h4>Format</h4>
                <select name="dimension" class="form-control form-control" id="dim_select">
                    <option value="0.3">Très Petit</option>
                    <option value="0.6">Petit</option>
                    <option value="1" selected>Normal</option>
                    <option value="1.4">Grand</option>
                    <option value="2"> Très Grand</option>
                </select>
                <br/>
                <h4>Impression</h4>
                <select name="impression" class="form-control form-control" id="impression_select">
                    <option value="0.3">offset</option>
                    <option value="0.6">numérique</option>
                    <option value="1" selected>jet encre</option>
                    <option value="1.4">thermique</option>
                    <option value="2">laser</option>
                </select>
                <br/>

            </div>
        </div>
        <div class="row">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-5 col-xs-5">
                <h2>Description</h2>
                <p id="desc_oeuvre">dsfdsf</p>
            </div>
            <div class="col-md-6 col-xs-6">
                <h4 id="prix_oeuvre">Prix:</h4>
                <button id="commander_oeuvre" class="btn btn-success">Commander</button>

            </div>
        </div>

    </div>
    <!-- The Modal -->
    <div id="myModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="img01" style="width:500px">
        <div id="caption"></div>
    </div>
    <script type="text/javascript">
        var prix = 0;
        var prix_calc = 0;
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
        $('#dim_select').change(function(){
            prix_calc = prix*$('#dim_select option:selected').val()* $('#impression_select option:selected').val();
            $('#prix_oeuvre').attr('value', prix*$('#dim_select option:selected').val()* $('#impression_select option:selected').val());
            $('#prix_oeuvre').html('<b>Prix: </b>'+ prix*$('#dim_select option:selected').val()* $('#impression_select option:selected').val() + '€')
        });
        $('#impression_select').change(function(){
            prix_calc = prix*$('#dim_select option:selected').val()* $('#impression_select option:selected').val();
            $('#prix_oeuvre').attr('value', prix*$('#dim_select option:selected').val()* $('#impression_select option:selected').val());
            $('#prix_oeuvre').html('<b>Prix: </b>'+ prix*$('#dim_select option:selected').val()* $('#impression_select option:selected').val() + '€')
        });

        $('#commander_oeuvre').on('click',function(){
            console.log(prix_calc);
            commander_oeuvre();
        });

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
                    $('#titre_oeuvre').html('<b>'+data[0].OEUVRE_NOM+'</b>');
                    $('#img_oeuvre').attr('src', 'img/'+data[0].OEUVRE_IMG);
                    $('#desc_oeuvre').text(data[0].OEUVRE_DESCRIPTION);
                    $('#auteur_oeuvre').html('<b>Auteur: </b>'+data[0].OEUVRE_AUTEUR);
                    $('#dim_oeuvre').html('<b>Dimensions: </b>'+data[0].OEUVRE_TAILLE);
                    $('#prix_oeuvre').html('<b>Prix: </b>'+ data[0].OEUVRE_PRIX + '€');
                    prix = data[0].OEUVRE_PRIX;
                    prix_calc = prix;
                }
                catch(e) {
                    console.log(e);
                    console.log(json_data);
                }
            });
        }
        function commander_oeuvre() {
            $.ajax({
               method:"POST",
               url:"oeuvre_detail.php",
               scriptCharset: "iso-8859-1",
               cache: false,
               data:{
                   action:  'commander_oeuvre',
                   prix:    prix_calc,
                   id:      id,
                   dim:     $('#dim_select option:selected').text(),
                   impression: $('#impression_select option:selected').text()
               }

            }).done(function(json_data){
                try {
                    console.log(json_data);
                    var data= JSON.parse(json_data);
                    console.log(data.res);
                    if(data.res = "success") {
                        console.log("ici");
                        alert("Votre oeuvre a été ajoutée au panier");
                    }
                }
                catch(e){
                    console.log(e);
                    console.log(json_data);
                }
            })
            ;
        }
    </script>

</body>
</html>