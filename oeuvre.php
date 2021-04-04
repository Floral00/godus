<?php
include('database.php');
include('session.php');
include("debut.php");
?>
<body>
    <!-- Barre de navigation -->
    <?php
    include("navbar.php");
    ?>


    <!-- Pied de page -->
    <?php
    include("footer.php");
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-1 col-xs-1"></div>
            <div class="col-md-3 col-xs-3">
                <h1>NOS OEUVRES</h1>
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
                            class="table table-stripped">
                        <thead>
                        <tr>
                            <th data-field="OEUVRE_TITRE"           data-visible="true"     data-sortable="true"    data-align="center">Oeuvre</th>
                            <th data-field="AUTEUR"                 data-visible="true"     data-sortable="true"    data-align="center">Auteur</th>
                            <th data-field="IMG"                    data-visible="true"     data-sortable="false"   data-align="center">Aperçu</th>
                            <th data-field="DETAIL"                 data-visible="true"     data-sortable="false"   data-align="center">Détail</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            tab_data_height();
            get_balade();
        });
        function tab_data_height() {
            var tab_height_b = $(window).height()*0.80;
            $('#table_oeuvre').data('height', tab_height_b);
            $('#table_oeuvre').bootstrapTable('resetView', {height: tab_height_b});
        }
    </script>
</body>
</html>

