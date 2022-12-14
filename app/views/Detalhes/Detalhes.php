<?php

error_reporting(0);

require_once($_SERVER['DOCUMENT_ROOT'].'/sgt/config.php');
require_once(DBAPI);
abresessao();

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);
$_SESSION['menu'] = 'Telefonia';

use app\controllers\DetalhesController;
$detalhesController = new DetalhesController();
$linhas = $detalhesController->dadosLinha();

$users = $detalhesController->dadosUser();

?>
    <div id="content">
        <div id="content-header">
            <h1>SGT - SISTEMA PARA GESTÃO DE TELEFONIA MÓVEL</h1>
        </div> <!-- #content-header -->

        <div id="content-container">
            <div class="portlet">


                <div class="portlet-header">
                    <h3><span  class="badge" style="background-color: #bdbdbd; padding-left: 11px; padding: 5px" onclick="history.back()"><i class="fa fa-arrow-left"></i></span>
                        <i class="fa fa-table"></i>
                        SGT - SISTEMA PARA GESTÃO DE TELEFONIA MÓVEL
                    </h3>
                </div> <!-- /.portlet-header -->

                <div class="portlet-content">
                    <div class="portlet">
                        <?php

                        ?>
                        <div class="user">
                            <div class="card mb-3" style="max-width: 100%">
                                <div class="row g-0">

                                    <div class="col-md-4">
                                        <?php
                                        if (!is_null($usuario[0])):
                                        ?>
                                        <img src="<?= BASEURL_SGT . 'app/views/fotos/' . $usuario[8] ?>"
                                             style="width: 65px; float: right" class="img-fluid rounded-start"
                                             alt="...">
                                        <?php endif;?>
                                    </div>

                                    <div class="col-md-5" id="dadosUser">
                                        <?php
                                        if (!is_null($usuario[0])):
                                            ?>
                                        <div class="card-body">

                                                <h5 class="card-title">Nome do usuário: <?= $usuario[2]; ?></h5>
                                                <p class="card-text">Matricula: <?= $usuario[4]; ?></p>
                                                <p class="card-text">Centro de Custo: <?= $usuario[3]; ?></p>
                                                <p class="card-text"><small class="text-muted">Email do usuário: <?= $usuario[6]; ?></small></p>
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-danger" type="submit" onclick="removeUser(<?=$celulares[0]?>)" id="removeUser" style="padding-top: 3px; padding-bottom: 3px" data-toggle="tooltip"
                                                    data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-success" type="submit" id="addUser"  style="padding-top: 3px; padding-bottom: 3px"  data-toggle="tooltip"
                                                    data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                            <?php
                                                else:
                                            ?>
                                                <p>Relacionar usuário</p>
                                        <button class="btn btn-success" type="submit" id="addUser" data-toggle="tooltip"
                                                data-placement="top" title="Tooltip on top">
                                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                        </button>
                                        <?php
                                        endif;
                                        ?>
                                    </div>

                                    <div class="col-md-4">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-md-8">
                                        <br>
                                        <br>
                                        <br>
                                    </div>

                                    <div class="col-md-4">

                                    </div>
                                    <div class="col-md-8" id="dadosLinha">
                                        <?php
                                        if (!is_null($telefones[0])):
                                            ?>
                                            <div class="card-body">
                                                <h5 class="card-title">Número da linha: <?= formataTelefone($telefones[3]); ?></h5>
                                                <p class="card-text">Plano: <?= $telefones[5]; ?></p>
                                                <p class="card-text"  style="font-size: 12px; margin-bottom: 0px">Conta: <?= $telefones[2]; ?></p>
                                                <p class="card-text"  style="font-size: 12px; margin-bottom: 0px">Tipo da linha: <?= $telefones[6]; ?></p>
                                            </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-danger" type="submit" onclick="removeTel(<?=$celulares[0]?>)" id="removeTelefone" style="padding-top: 3px; padding-bottom: 3px" data-toggle="tooltip"
                                                    data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-close" aria-hidden="true"></i>
                                            </button>
                                            <button class="btn btn-success" type="submit" id="addLinha"  style="padding-top: 3px; padding-bottom: 3px"  data-toggle="tooltip"
                                                    data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-refresh" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                        <?php
                                        else:
                                            ?>
                                            <p>Relacionar linha</p>
                                            <button class="btn btn-success" type="submit" id="addLinha" data-toggle="tooltip"
                                                    data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                    </div>


                                    <div class="col-md-4">
                                        <br>
                                        <br>
                                        <br>
                                    </div>
                                    <div class="col-md-8">
                                        <br>
                                        <br>
                                        <br>
                                    </div>

                                    <div class="col-md-4">
                                        <img src="<?= BASEURL_SGT . 'app/views/fotos/' . $celulares[8] ?>"
                                             style="width: 65px; float: right" class="img-fluid rounded-start">
                                    </div>
                                    <div class="col-md-8">
                                        <?php
                                        if (!is_null($celulares[0])):
                                            ?>
                                            <div class="card-body">
                                                <h5 class="card-title">Marca: <?= $celulares[1]; ?></</h5>
                                                <p class="card-text">Modelo: <?= $celulares[2]; ?></</p>
                                                <p class="card-text"  style="font-size: 13px">Imei 1: <?= $celulares[3]; ?></p>
                                                <p class="card-text"  style="font-size: 13px">Imei 2: <?= $celulares[5]; ?></p>
                                                <p class="card-text"  style="font-size: 13px">ICCID1: <?= $celulares[4]; ?></p>
                                                <p class="card-text"><small class="text">Nro Serie: <?= $celulares[7]; ?></p>
                                                <p class="card-text">Observações: <?= $celulares[6]; ?></p>
                                            </div>

                                        <?php
                                        else:
                                            ?>
                                            <button class="btn btn-success" type="submit" data-toggle="tooltip"
                                                    data-placement="top" title="Tooltip on top">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                            </button>
                                        <?php
                                        endif;
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> <!-- /.portlet -->
                </div> <!-- /.portlet-content -->
            </div> <!-- /.portlet -->
        </div>
    </div> <!-- /#content-container -->
<script type="text/javascript">
    $("#addLinha").click(
        function (){
            $('#addLinha').remove();
            $('#dadosLinha').append("<br><br><select  class='form-control'  id='selAddLinha' data-placeholder='Selecione a cidade' style='width:25%'><option value='#'>Selecione uma Linha!</option>" +
                                        <?php foreach ($linhas as $linha):?>
                                        "<option value='<?= $linha['linha']?>'><?= $linha['linha']?></option>"+
                                        <?php endforeach;?>
                                    "</select><button class='btn btn-success' onclick='saveLinha()' style='margin-top:5px' type='submit' id='addLinhaSave' data-toggle='tooltip' data-placement='top' title='Tooltip on top'><i class='fa fa-check-circle' aria-hidden='true'></i></button>");
        }
    );

    function saveLinha() {
        var linha = $("#selAddLinha").val();
        var url = '<?=BASEURL_SGT?>detalheLinha/celular/<?=$celular?>/'+linha

        console.log(url);

        $.ajax({
            type: "get",
            url: '<?= BASEURL_SGT ?>detalheLinha/celular/<?=$celular?>/'+linha,
            dataType: 'text',
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                alert('alterado com sucesso!');
                document.location.reload(true);
            },
            error: function () {
                alert("Erro!");
            }
        });
    }

        function saveUser() {
            var user = $("#selAddUser").val();
            var url = '<?=BASEURL_SGT?>detalhes/celular/<?=$celular?>/'+user
            console.log(url);
            $.ajax({
                type: "get",
                url: '<?= BASEURL_SGT ?>detalhe/celular/<?=$celular?>/'+user,
                dataType: 'text',
                beforeSend: function () {
                    $("#loader").show();
                },
                success: function (data) {
                    alert('alterado com sucesso!');
                    document.location.reload(true);
                },
                error: function () {
                    alert("Erro!");
                }
            });
        }

    function removeTel(tel) {

        var url = '<?=BASEURL_SGT?>detalheLinha/removeTelCel/'+tel
        console.log(url);
        $.ajax({
            type: "get",
            url: '<?=BASEURL_SGT?>detalheLinha/removeTelCel/'+tel,
            dataType: 'text',
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                alert('Removido com sucesso!');
                document.location.reload(true);
            },
            error: function () {
                alert("Erro!");
            }
        });
    }

    function removeUser(tel) {

        var url = '<?=BASEURL_SGT?>detalheLinha/removeUserCel/'+tel
        console.log(url);
        $.ajax({
            type: "get",
            url: '<?=BASEURL_SGT?>detalheLinha/removeUserCel/'+tel,
            dataType: 'text',
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                alert('Removido com sucesso!');
                document.location.reload(true);
            },
            error: function () {
                alert("Erro!");
            }
        });
    }


    $("#addUser").click(
        function (){
            $('#addUser').remove();
            $('#dadosUser').append("<br><br><select  class='form-control'  id='selAddUser' data-placeholder='Seleciona um usuario' style='width:25%'><option value='#'>Selecione um usuário!</option>" +
                                    <?php
                                        foreach ($users as $user):
                                    ?>
                                         "<option value='<?= $user['id']?>'><?= $user['nome']?></option>"+
                                    <?php
                                         endforeach;
                                     ?>
                                    "</select><button class='btn btn-success'  onclick='saveUser()' style='margin-top:5px' type='submit' id='addUserSave' data-toggle='tooltip' data-placement='top' title='Tooltip on top'><i class='fa fa-check-circle' aria-hidden='true'></i></button>");
        }
    );
</script>

<?php include(FOOTER_TEMPLATE); ?>

