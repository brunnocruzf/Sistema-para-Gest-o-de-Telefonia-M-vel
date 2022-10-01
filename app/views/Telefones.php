<?php
require_once('C:\xampp\htdocs\sgt\config.php');
require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';
include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);
$_SESSION['menu'] = 'SGT';
//require_once '../vendor/autoload.php';

use \app\controllers\TelefonesController;

?>
    <style>
        .table-condensed {
            font-size: 10px;
        }
    </style>
    <div id="content">
        <div id="content-header">
            <h1>SISTEMA DE GESTÃO DE TELEFONIA</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <a class="btn btn-sm btn-primary" style="margin-bottom: 15px" href="novoTelefone" type="button"><i class="fa fa-plus-square"></i> Nova Linha</a>
            <br>
            <?php if (!empty($mensagem)): ?>
                <?php echo $mensagem; ?>
            <?php endif; ?>
            <div class="portlet">
                <div class="portlet-header">
                    <h3>
                        <i class="fa fa-wifi" style="transform: rotate(90deg);"></i>
                        Linhas
                    </h3>
                </div> <!-- /.portlet-header -->
                <div class="portlet-content">

                    <div class="portlet">
                        <table
                                class="table table-striped table-bordered table-hover table-highlight table-checkable"
                                data-provide="datatable"
                                data-display-rows="15"
                                data-info="true"
                                data-paginate="true"
                        >
                            <thead>
                            <tr>
                                <th data-filterable="false" data-sortable="false">Opções</th>
                                <th data-filterable="true" data-sortable="true" width="1%">Número</th>
                                <th data-filterable="true" data-sortable="true" data-direction="asc"width="20%" >Nome</th>
                                <th data-filterable="true" data-sortable="true" width="5%">Matricula</th>
                                <th data-filterable="true" data-sortable="true">Plano</th>
                                <th data-filterable="true" data-sortable="true" width="22%">CC</th>
                                <th data-filterable="true" data-sortable="true">Tipo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($telefones as $telefone): ?>
                                <tr>
                                    <td width="7%">
                                        <center>
                                            <a href="faturas/<?= $telefone['linha'] ?>"><i class="fa fa-file-pdf-o ui-tooltip" aria-hidden="true" style="color:black;"
                                                                                                  data-toggle="tooltip" data-placement="top" title="Fatura" aria-hidden="true"></i></a>
                                            <a href="edit/<?= $telefone['linha'] ?>" alt="Editar"><i class="fa fa-pencil-square-o ui-tooltip" data-toggle="tooltip" data-placement="top" title="Editar" aria-hidden="true" style="color:black;"></i></a>
                                            <a href="#" ><i onclick="deletar(<?php echo $telefone['linha'] ?>)" class="fa fa-trash ui-tooltip" aria-hidden="true"
                                                                                                 style="color:black; margin-left: 5px; margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="Excluir" aria-hidden="true" ></i></a>
                                            <a href="faturas/<?= $telefone['linha'] ?>"><i class="fa fa-file-pdf-o ui-tooltip" aria-hidden="true" style="color:black;"
                                                                                                  data-toggle="tooltip" data-placement="top" title="Fatura" aria-hidden="true"></i></a>
                                        </center>
                                    </td>
                                    <td><input type="hidden" value="" id="numero"><?php echo formataTelefone($telefone['linha']) ?></td>
                                    <td><?php echo  $telefone['nome'] ?></td>
                                    <td width="7%"><?php echo  $telefone['matricula']   ?></td>
                                    <td width="11%"><?php echo $telefone['plano'] ?></td>
                                    <td><?php
                                        $telcontroller = new TelefonesController();
                                        $CCLinha = $telcontroller->buscaCClinha($telefone['linha']);

                                            echo $CCLinha['cc']?$CCLinha['cc']:"<p style='color:red'>NÃO POSSUI CENTRO DE CUSTO<P>";

                                        ?></td>
                                    <td width="7%"><?php echo $telefone['tipo'] ?></td>
                                    <!-- <td style="display: none"></td>-->
                                </tr>
                            <?php endforeach ?>

                            </tbody>
                        </table>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
    <script type="text/javascript">
        function deletar(numero) {
           // var numero = $("#numero").val();
            if (window.confirm("Deseja excluir numero: "+numero+" ?")) {
                $.ajax({
                    type: "POST",
                    url: '<?= BASEURL_SGT ?>delete/' + numero,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.mensagem);
                        alert(data.mensagem);
                        window.location.href = "<?= BASEURL_SGT ?>telefones";
                    },
                    error: function () {
                        alert("Erro ao Excluir!");
                        window.location.href = "<?= BASEURL_SGT ?>telefones";
                    }
                });
            }
        }

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include(FOOTER_TEMPLATE); ?>