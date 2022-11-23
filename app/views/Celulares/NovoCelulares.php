<?php
require_once('./././config.php');
require_once(DBAPI);
abresessao();

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);

$_SESSION['menu'] = 'SGT';

use \app\controllers\UsuariosController;

?>
<style>
    .table-condensed {
        font-size: 10px;
    }

    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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
        <?php if (!empty($mensagem)): ?>
            <?php echo $mensagem; ?>
        <?php endif; ?>
        <div class="portlet">
            <div class="portlet-header">
                <h3>
                    <i class="fa fa-plus"></i>
                    Novo Celular
                </h3>
            </div>
            <div class="portlet-content">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="col-sm-1" id='loader' style='display: none;'>
                            <img src='loading.gif' width='64px' height='64px'>
                        </div>
                    </div>
                </div>
                <form id="formadd" action="novocelulares" data-validate="parsley" class="form parsley-form" method="post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-2">
                                    <label for="select-input">Marca</label>
                                    <input type="text" id="marca" name="marca" class="form-control" required>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="select-input">Modelo</label>
                                        <input type="text" id="modelo" name="modelo" class="form-control">
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select-input">IMEI1</label>
                                        <input type="text" id="IMEI1" name="IMEI1" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="select-input">ICCID1</label>
                                    <input type="text" id="ICCID1" name="ICCID1" class="form-control" required>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select-input">IMEI2</label>
                                        <input type="text" id="IMEI2" name="IMEI2" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="select-input">ICCID2</label>
                                    <input type="text" id="ICCID2" name="ICCID2" class="form-control" required>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="senha">Numero de serie</label>
                                        <input type="text" id="nroSerie" name="nroSerie" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-lg-2">
                                        <label for="">Foto</label>
                                        <embed id="anexarfoto" src="<?= BASEURL_SGT ?>upload_foto"
                                               height="25px"></embed>
                                        <div class="progress" id="progressFoto" style="display: none;">
                                            <div class="progress-bar progress-bar-striped active" role="progressbar"
                                                 aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"
                                                 style="width: 80%">
                                                <span class="sr-only">45% Complete</span>
                                            </div>
                                        </div>
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <img id="imagem" src=" " width="100%"/>
                                                    <input type="text" readonly name="foto" id="foto" value=" "
                                                           style="display: none;  float: left">
                                                </td>
                                                <td>
                                                    <i alt="Remover anexo" class="fa fa-trash fa-1x" id="remove-foto"
                                                       aria-hidden="true"
                                                       style="display: none; padding-top: 7%; float: right; cursor: pointer"></i>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-3" style="float: left"></div>
                        <div class="col-sm-2" style="float: left">
                            <button type="submit" id="btn" name="btn" class="btn btn-success btn-lg btn-block"
                                    onclick="return validaForm()"><i class="fa fa-save"></i> Salvar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include(FOOTER_TEMPLATE); ?>
<script>
    $('#remove-foto').click(function () {
        $('#foto').css('display', 'none');
        $('#remove-foto').css('display', 'none');
        $('#foto').val('');
        $('#anexarfoto').css('display', 'block');

        alert('Anexo removido!');
    });

</script>
