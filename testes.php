<?php
    //$connect_ssh
    
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


            
        <form action="" method="post">
            <label>Dominio</label>
            <input name="dominio" type="text" placeholder="empresa.com.br">
            <button type="submit" class="btn btn-primary" name="inverter">Search</button>
        </form>

        <?php
            $dominio = $_POST['dominio'];
            if(isset($dominio)){
                echo dominioInvertido($dominio);
            }
        ?>
        
        
    </div>
    <!--END CONTENT-->


    <div id="footer">
        <div class="copyright">
            <a href="http://themifycloud.com">2015 © KAdmin Responsive Multi-Purpose Template</a>
        </div>
    </div>

</div>