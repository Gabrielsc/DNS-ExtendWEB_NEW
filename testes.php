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
        
        
        <h3>Editando resolv.conf</h3><br>
        <form action="" method="post">

            <label>NameServer: </label>
            <input type="text" name="nameserver">
            <input type="submit" name="enviar" value="Enviar">

            <?php
                            
                if(isset($_POST['enviar'])){
                    $command = "echo nameserver 8.8.4.4 >> /etc/resolv.conf";
                    $result = shell_exec($command);
                    echo "Enviado!!";
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