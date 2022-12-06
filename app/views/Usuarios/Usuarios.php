<?php
require_once($_SERVER['DOCUMENT_ROOT'].'\sgt\config.php');
require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';
include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);
//require_once '../vendor/autoload.php';

use \app\controllers\UsuariosController;

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
            <a class="btn btn-sm btn-primary" style="margin-bottom: 15px" href="<?php echo BASEURL_SGT?>usuarios/novo" type="button"><i class="fa fa-plus-square"></i> Novo Usuário</a>
            <br>
            <?php if (!empty($mensagem)): ?>
                <?php echo $mensagem; ?>
            <?php endif; ?>
            <div class="portlet">
                <div class="portlet-header">
                    <h3>
                        <i class="fa fa-phone-square" style="transform: rotate(90deg);"></i>
                        Telefones
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
                                <th  width="1%"></th>
                                <th data-filterable="true" data-sortable="true" style="width: 30px">NOME</th>
                                <th data-filterable="true" data-sortable="true" data-direction="asc"width="20%" >Matricula</th>
                                <th data-filterable="true" data-sortable="true" data-direction="asc"width="20%" >Login</th>
                                <th data-filterable="true" data-sortable="true" data-direction="asc"width="20%" >E-mail</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                                <tr>
                                    <td width="7%">
                                        <center>
                                            <a href="usuarios/edit/<?= $usuario['id']?>"><i class="fa fa-pencil-square-o ui-tooltip" data-toggle="tooltip" data-placement="top" title="Editar" aria-hidden="true" style="color:black;"></i></a>
                                            <a href="#" >
                                                <i onclick="deletar(<?php echo $usuario['id'] ?>)" class="fa fa-trash ui-tooltip" aria-hidden="true"
                                                            style="color:black; margin-left: 5px; margin-right: 5px;" data-toggle="tooltip" data-placement="top" title="Excluir" aria-hidden="true" ></i>
                                            </a>
                                        </center>
                                    </td>
                                    <td>
                                        <?php if(strlen($usuario['foto'])>5):?>
                                              <center><img src="<?= BASEURL_SGT.'app/views/fotos/'.$usuario['foto'] ?>" style="border-radius:50%;  width: 35px; height: 45px;"> </center></td>
                                        <?php else: ?>
                                                <span></span>
                                        <?php endif;?>
                                    </td><td><?php echo $usuario['nome'] ?></td>
                                    <td><?php echo $usuario['matricula'] ?></td>
                                    <td width="7%"><?php echo  $usuario['login']   ?></td>
                                    <td width="11%"><?php echo $usuario['email'] ?></td>
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
            if (window.confirm("Deseja excluir: "+numero+" ?")) {
                $.ajax({
                    type: "GET",
                    url: '<?php echo BASEURL_SGT?>usuarios/delete/' + numero,
                    dataType: 'json',
                    success: function (data) {
                        console.log(data.mensagem);
                        alert(data.mensagem);
                        window.location.href = "<?php echo BASEURL_SGT?>usuarios";
                    },
                    error: function () {
                        alert("Erro ao Excluir!");
                        window.location.href = "<?php echo BASEURL_SGT?>usuarios";
                    }
                });
            }
        }
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<?php include(FOOTER_TEMPLATE); ?><?php
