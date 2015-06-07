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

            echo "Dados sessao atual: ".session_encode();
            echo nl2br("\n\n");

            echo "Command: ".$_SESSION['command'];
            //$shell = ssh2_shell($connect_ssh, 'xterm');
            //fwrite( $shell, 'ls -la;'.PHP_EOL);
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
                    $way = $_POST['way1'];
                    $data = file_get_contents($way);
                    //echo $data;
                    $convert = explode("\n", $data);
                    for ($i=0;$i<count($convert);$i++) {
                        echo nl2br("$convert[$i] \n"); //write value by index
                    } 
                }

                
            ?>
            
        </form>

        <h3>Read file</h3><br>
        <form action="" method="post">

            <label>Path file: </label>
            <input type="text" name="way2">
            <input type="submit" name="enviar" value="Enviar">
            <br><br>

            <?php

                $filename = $_POST['way2'];
                //echo $filename;
                $handle = fopen ($filename, "r");
                $conteudo = fread ($handle, filesize ($filename));
                fclose ($handle);

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