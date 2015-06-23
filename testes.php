<?php
    // Importando codigos PHP!!
    include 'functions.php';
    include "Zona.php";

    $connect_ssh = ssh2_connect('192.168.0.109', 22);
    ssh2_auth_password($connect_ssh, "root", "adminuser");
    
?>

<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Pagina de Testes</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Pagina de Testes</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Pagina de Testes</li>
        </ol>
        <div class="clearfix">
        </div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

    <!--BEGIN CONTENT-->
    <div class="page-content">
        
        <h3>Adicionar Domain</h3><br>
        <form action="" method="post">

            <label>Dados: </label>
            <input type="text" name="domain">
            <input type="text" name="type">
            <input type="submit" name="enviar" value="Enviar">
            <br><br>
            
            <?php //Ler arquivo

                if(isset($_POST['enviar'])){
                    $objeto = new Zona($_POST['domain'], $_POST['type']);
                    $returno = $objeto->add($connect_ssh);

                    if($returno){
                        echo "Tudo certo!! :)";
                    }
                }

            ?>
            
        </form>

        <h3>Write file</h3><br>
        <form action="" method="post">

            <label>Path file: </label>
            <input type="text" name="way3">
            <label>String: </label>
            <input type="text" name="string">
            <input type="submit" name="enviar" value="Enviar">
            <br><br>

            <?php

                if(isset($_POST['enviar'])){

                    //escrevendo
                    $way3 = $_POST['way3'];
                    $string = $_POST['string'];
                    file_put_contents($way3, "$string \n", FILE_APPEND);

                    //lendo
                    $data = file_get_contents($way3);
                    echo $data;
                }

                    
            ?>

        </form>
        
        
    </div>
    <!--END CONTENT-->


    <div id="footer">
        <div class="copyright">
            <a href="http://themifycloud.com">2015 © KAdmin Responsive Multi-Purpose Template</a>
        </div>
    </div>

</div>