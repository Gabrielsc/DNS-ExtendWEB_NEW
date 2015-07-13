
<!--BEGIN PAGE WRAPPER-->
<div id="page-wrapper">
    <!--BEGIN TITLE & BREADCRUMB PAGE-->
    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
        <div class="page-header pull-left">
            <div class="page-title">
                Ports</div>
        </div>
        <ol class="breadcrumb page-breadcrumb pull-right">
            <li><i class="fa fa-home"></i>&nbsp;<a href="ports.php">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="hidden"><a href="#">Ports</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
            <li class="active">Ports</li>
        </ol>
        <div class="clearfix">
        </div>
    </div>
    <!--END TITLE & BREADCRUMB PAGE-->


    <!--BEGIN CONTENT-->
    <div class="page-content">
                

                    <h3>Verificar portas abertas</h3>

                    <label>dominio</label>
                    <input type="text" id="domain">
                    <label>Port</label>
                    <input type="text" id="port">
                    <button id="action">Analisar</button>

                    <script src="http://code.jquery.com/jquery-2.1.3.min.js"></script>
                    <script>
                        // https://www.mashape.com/jack/dns-tools
                        $('#action').click(function(){
                            var domain = $("#domain").val();
                            var port = $("#port").val();
                            var url = "https://jack-dns-tools.p.mashape.com/dnstools.php?_method=CHKPRT&host="+domain+"&port="+port;

                            $.ajaxSetup({
                              headers : {
                                'X-Mashape-Key' : '6dllx0hZjtmsh72KZ0VdbEnS0g7Jp16Y9SmjsnIv2uQTMGSBK0'
                              }
                            });
                            $.getJSON(url,function(json){
                                if (json.result) {
                                    alert("Porta aberta!!");
                                }else{
                                    alert("Porta fechada!!");
                                }

                                
                            });
                        });
                    </script>

               
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