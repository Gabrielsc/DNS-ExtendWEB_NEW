<?php
    // Importando codigos PHP!!
    include 'functions.php';
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

        <?php

            echo "";
            $connect_ssh = ssh2_connect('192.168.0.109', 22);
            ssh2_auth_password($connect_ssh, 'root', 'adminuser');
            $return = ssh2_exec($connect_ssh, "echo testeeee >> /etc/resolv.conf");


            //echo nl2br("\n\n");
        ?>
        
        
        <h3>Read file</h3><br>
        <form action="" method="post">

            <label>Path file: </label>
            <input type="text" name="way1">
            <input type="submit" name="enviar" value="Enviar">
            <br><br>
            <?php

                if(isset($_POST['enviar'])){

                    //Ler arquivo
                    $way1 = $_POST['way1'];
                    $data = file_get_contents($way1);
                    //echo $data;
                    $convert = explode("\n", $data);
                    for ($i=0;$i<count($convert);$i++) {
                        echo nl2br("$convert[$i] \n"); 
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
                //$way1 = $_POST['way2'];
                //$string = $_POST['string'];
                /*
                if(isset($_POST['enviar'])){
                    $way2 = $_POST['way2'];
                    $string = $_POST['string'];
                    file_put_contents("teste1", $string);
                    echo file_get_contents("teste1");
                }*/

                if(isset($_POST['enviar'])){

                    //escrevendo
                    $way3 = $_POST['way3'];
                    $string = $_POST['string'];
                    file_put_contents($way3, "$string \n", FILE_APPEND);

                    //$fp = fopen($way3, "a");
                    //$escreve = fwrite($fp, "exemplo de escrita");
                    //fclose($fp);

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