<?php

    // Em teste a linha abaixo não foi precisa pois eh feita em index.html
    //session_start(); 
    //$connect_ssh = $_SESSION['connection'];


    // Codigo abaixo sera executado quando clickar em "adicionar"
    if(isset($_POST['enviarZona'])){
        $objeto = new Zona($_POST['inputNameDominio'], $_POST['type']);
        $retorno = $objeto->add($connect_ssh);
        if($retorno){ //Executa se Adicionou com sucesso...

?>          <script type="text/javascript">
                alert(" <?php echo 'Zona adicionada com sucesso!! '; ?> ");
            </script>
<?php
        }else{

?>          <script type="text/javascript">
                alert(" <?php echo 'Erro ao adicionar Zona :('; ?> ");
            </script>
<?php
        }
    } 
?>



<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Zonas Diretas</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Zonas Diretas</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Zonas Diretas</li>
        </ol>
        <div class="clearfix">
        </div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->

    <!--BEGIN CONTENT-->
    <div class="page-content">
        <div id="tab-general">
            <div class="row mbl">
                <div class="col-lg-12">
                    <div class="col-md-12">
                        <div id="area-chart-spline" style="width: 100%; height: 300px; display: none;">
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">

                    <!-- Lista Abas -->
                    <div class="col-lg-12">
                        <ul id="generalTab" class="nav nav-tabs responsive">
                            <li class="active"><a href="#adicionar-tab" data-toggle="tab">Adicionar</a></li>

                            <li><a href="#note-tab" data-toggle="tab">Editar</a></li>

                            <!--<li><a href="#label-badge-tab" data-toggle="tab">Visualizar</a></li>-->
                        </ul>

                    <div id="generalTabContent" class="tab-content responsive">

                    <!-- ABA ADICIONAR DO CONTEUDO -->
                    <div id="adicionar-tab" class="tab-pane fade in active">
                        <div class="row">
                            <form action="" method="post">

                            <!-- First Columm First Tab-->
                            <div class="col-lg-6">

                                <h3>Basic Setting</h3><br>
                                <!-- Begin Campo Dominio -->
                                <div class="form-group">
                                    <input name="inputNameDominio" type="text" placeholder="Nome Dominio" class="form-control"/>
                                </div>
                                <!-- End Campo Dominio -->
                                
                                <div class="form-group">
                                    <select class="form-control" name="type">
                                        <option value="master">master</option>
                                        <option value="slave">slave</option>
                                    </select>
                                </div>

                                <br>
                                <!-- Begin Select File -->
                                <div class="form-group">
                                    <label for="inputName" class="col-md-3 control-label">Selecione arquivo</label>

                                    <input id="inputIncludeFile" type="file" placeholder="Inlcude some file"/>
                                </div>
                                <!-- End Select File -->

                                <br>
                                <button type="submit" class="btn btn-primary" name="enviarZona">Adicionar</button>

                            </div>

                            <div class="col-lg-6">
                                <h3>Advanced Setting</h3><br>
                                <div class="form-group">
                                    <input name="inputIp" type="text" placeholder="IP master or slave" class="form-control" size="2"/>
                                </div>

                                <div class="form-group mbn">
                                    <div class="checkbox">
                                        <label>
                                            <input tabindex="5" type="checkbox" />&nbsp; Allow-traffer
                                        </label>
                                    </div>
                                </div>
                            </div>

                            </form>

                        </div><br>

                        
                        

                    </div>
                    <!-- END -->
                    
                    <!-- ABA EDITAR DO CONTEUDO -->
                    <div id="note-tab" class="tab-pane fade">
                        <div class="row">
                            <div class="col-lg-12">

                                <form action="" method="post">

                                <h3>Pesquisar:</h3><br>
                                <div class="col-lg-6">
                                    <input name="domainPesquisar" type="text" placeholder="Nome" class="form-control"/>
                                    <input name="host" type="text" placeholder="Host" class="form-control"/>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="inputName" class="col-md-2 control-label">
                                            Type:</label>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <select class="form-control" name="type">
                                                    <option value="a">A</option>
                                                    <option value="cname">CNAME</option>
                                                    <option value="ns">NS</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <br><br><br><br>
                                <button type="submit" class="btn btn-primary" name="pesquisar">Search</button>

                                </form>

                                
                                <br><br>

                                

                                <?php

                                    if(isset($_POST['pesquisar'])){
                                        $domain = $_POST['domainPesquisar'];
                                        $type = $_POST['type']; //nao utilizando no momento..
                                        $objeto = new Zona($domain, $type);
                                        $array_pesquisa = $objeto->pesquisaZona($connect_ssh, $domain);
                                        if(!$array_pesquisa){
                                            echo "Algo errado :( !!";
                                        }else{
                                ?>

                                            <table class="table table-hover table-bordered">
                                                <tr>
                                                    <td>Type</td>
                                                    <td>File</td>
                                                    <td>Editar</td>
                                                    <td>Excluir</td>
                                                </tr>
                                                <tr>
                                                    
                                                    <?php for($i=0; $i < count($array_pesquisa); $i++){   ?>      
                                                            <td class="type"> <?php  echo $array_pesquisa[$i];  ?>  </td>
                                                    <?php } ?>

                                                    <td><a href=""></a><img src="images/conf.png" class="icons"></a></td>
                                                    <td><a href=""></a><img src="images/del.png" class="icons"></a></td>
                                                </tr>
                                            </table>

                                <?php
                                        }
                                    }
                                    $_POST['pesquisar'] = false;

                                ?>

                                



                                <!-- Table mostrando todos os dados -->
                                <br><br>
                                <h3>Dados de zonas diretas:</h3><br>

                                <!--<table class="table table-hover table-bordered"> -->
                                <table class="table table-hover table-bordered"> 
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nome</th>
                                        <th>TTL</th>
                                        <th>Class</th>
                                        <th>Type</th>
                                        <th class="colunas">Registro</th>
                                        <th>Editar</th>
                                        <th>Excluir</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td class="nome">asa.edu.br</td>
                                        <td class="ttl">3600</td>
                                        <td class="classe">IN</td>
                                        <td class="type">A</td>
                                        <td class="registro">192.168.0.1</td>
                                        <td><a href=""></a><img src="images/conf.png" class="icons"></a></td>
                                        <td><a href=""></a><img src="images/del.png" class="icons"></a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td class="nome">asa.edu.br</td>
                                        <td class="ttl">3600</td>
                                        <td class="classe">IN</td>
                                        <td class="type">A</td>
                                        <td class="registro">192.168.0.2</td>
                                        <td><a href=""></a><img src="images/conf.png" class="icons"></a></td>
                                        <td><a href=""></a><img src="images/del.png" class="icons"></a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td class="nome">dominio.com.br</td>
                                        <td class="ttl">3600</td>
                                        <td class="classe">IN</td>
                                        <td class="type">NS</td>
                                        <td class="registro">ns1.dominio.com.br</td>
                                        <td><a href=""></a><img src="images/conf.png" class="icons"></a></td>
                                        <td><a href=""></a><img src="images/del.png" class="icons"></a></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td class="nome">dominio.com.br</td>
                                        <td class="ttl">3600</td>
                                        <td class="classe">IN</td>
                                        <td class="type">NS</td>
                                        <td class="registro">ns2.dominio.com.br</td>
                                        <td><a href=""></a><img src="images/conf.png" class="icons"></a></td>
                                        <td><a href=""></a><img src="images/del.png" class="icons"></a></td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td class="nome">server1</td>
                                        <td class="ttl">3600</td>
                                        <td class="classe">IN</td>
                                        <td class="type">CNAME</td>
                                        <td class="registro">server.com.br</td>
                                        <td><a href=""></a><img src="images/conf.png" class="icons"></a></td>
                                        <td><a href=""></a><img src="images/del.png" class="icons"></a></td>
                                    </tr>
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                    </div>
                    <!-- END -->

                    <!-- ABA VISUALIZAR DO CONTEUDO -->                    
                    <div id="label-badge-tab" class="tab-pane fade">
                        <div class="row">
                            <div class="panel panel-grey">
                                <div class="panel-heading">ContextualColumn</div>
                                <div class="panel-body">
                                    <table class="table table-hover table-bordered">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Column</th>
                                            <th>Column</th>
                                            <th>Column</th>
                                            <th>Column</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="active">active</td>
                                            <td class="success">success</td>
                                            <td class="warning">warning</td>
                                            <td class="danger">danger</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td class="active">active</td>
                                            <td class="success">success</td>
                                            <td class="warning">warning</td>
                                            <td class="danger">danger</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td class="active">active</td>
                                            <td class="success">success</td>
                                            <td class="warning">warning</td>
                                            <td class="danger">danger</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td class="active">active</td>
                                            <td class="success">success</td>
                                            <td class="warning">warning</td>
                                            <td class="danger">danger</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td class="active">active</td>
                                            <td class="success">success</td>
                                            <td class="warning">warning</td>
                                            <td class="danger">danger</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END -->
                    </div>
                    </div>
                </div>
        </div>
    </div>
    <!--END CONTENT-->
    <!--BEGIN FOOTER-->
    <div id="footer">
        <div class="copyright">
            <a href="http://themifycloud.com">2015 © KAdmin Responsive Multi-Purpose Template</a>
        </div>
    </div>
    <!--END FOOTER-->
</div>
<!--END PAGE WRAPPER-->