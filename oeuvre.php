<?php

function get_oeuvre($DATABASE) {

    $req = "
        select  OEUVRE_ID,
                OEUVRE_AUTEUR,
                OEUVRE_PRIX,
                OEUVRE_AUTEUR,
                OEUVRE_IMG,
                OEUVRE_NOM
        from    oeuvre
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
    $DATABASE->query("SET NAMES 'utf8'");
    $DATABASE->query("SET CHARACTER SET utf8");
    $DATABASE->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
    switch($action) {
        case 'get_oeuvre':
            $allowed = array();
            $allowed[] = 'action';
            $allowed[] = 'type';
            $sent=array_keys($_POST);
            if($allowed !== $sent ) {
                die('erreur');
            }
            $data = get_oeuvre($DATABASE);
            echo json_encode($data, JSON_PRETTY_PRINT);
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
            <div class="col-md-3 col-xs-3">
                <a href="oeuvre_detail.php?id=1"><h1>NOS OEUVRES</h1></a>
            </div>
            <div class="col-md-4 col-xs-4"></div>

        </div>
        <div class="row">
            <div class="col-xs-1 col-md-1"></div>
            <div class="col-xs-10 col-md-10">
                <div id="div_tab_data" class="table-responsive">
                    <div id="load_tab_data"></div>
                    <table
                            id="table_oeuvre"
                            class="table table-striped"

                    >
                        <thead>
                        <tr>
                            <th data-field="OEUVRE_NOM"           data-visible="true"     data-sortable="true"    data-align="center">Oeuvre</th>
                            <th data-field="OEUVRE_AUTEUR"        data-visible="true"     data-sortable="true"    data-align="center">Auteur</th>
                            <th data-field="OEUVRE_IMG"           data-visible="true"     data-sortable="false"   data-align="center">Aperçu</th>
                            <th data-field="OEUVRE_PRIX"          data-visible="true"     data-sortable="false"   data-align="center">Prix</th>
                            <th data-field="DETAIL"               data-visible="true"     data-sortable="false"   data-align="center">Détail</th>
                        </tr>
                        </thead>
                        <tbody id = "body_oeuvre">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Pied de page -->
    <?php
    include("footer.php");
    ?>
    <script type="text/javascript">
        $(document).ready(function() {
            tab_data_height();
            get_oeuvre();
        });
        function tab_data_height() {
            var tab_height_b = $(window).height()*0.80;
            console.log(tab_height_b);
            $('#table_oeuvre').data('height', tab_height_b);
            $('#table_oeuvre').bootstrapTable('resetView', {height: tab_height_b});
        }

        function get_oeuvre() {

            $.ajax({
                method:"POST",
                url: "oeuvre.php",
                data: {
                    action: 'get_oeuvre',
                    type: 'tt'
                }
            }).done(function(json_data) {
                try{
                    var data = JSON.parse(json_data);
                    var tab_data = [];
                    var html = '';
                    for(var i=0; i< data.length; i++) {

                        html = html +'<tr>';
                        html = html +'<td>'+data[i].OEUVRE_NOM+'</td>';
                        html = html +'<td>'+data[i].OEUVRE_AUTEUR+'</td>';
                        html = html +'<td><img src="img/'+data[i].OEUVRE_IMG+'" style="height: 100px"/></td>';
                        html = html +'<td>'+data[i].OEUVRE_PRIX+'</td>';
                        html = html +'<td><a class="btn btn-success" href="oeuvre_detail.php?id='+data[i].OEUVRE_ID+'">Detail</a></td>';
                        html = html +'</tr>';
                    }
                    console.log(html);
                    $('#body_oeuvre').html(html);

                }
                catch(e) {
                    console.log(e);
                    console.log(json_data);
                }

            }).fail(function(){
                console.log('erreur recup oeuvres');
            }).always(function(){

            })
        }
    </script>

</body>
</html>

