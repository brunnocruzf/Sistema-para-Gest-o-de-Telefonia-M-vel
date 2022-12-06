<?php

require_once($_SERVER['DOCUMENT_ROOT'].'\sgt\config.php');
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
                    <i class="fa fa-user-plus"></i>
                    Novo Usuário
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
                <form id="formadd" action="novoUsuario" data-validate="parsley" class="form parsley-form" method="post">
                    <div class="panel-body">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label for="select-input">Nome</label>
                                    <input type="text" id="nome" name="nome" class="form-control" required>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="select-input">Matricula</label>
                                        <input type="number" id="matricula" name="matricula" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select-input">Login</label>
                                        <input type="text" id="login" name="login" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="select-input">E-mail</label>
                                    <input type="text" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select-input">Empresa</label>
                                        <select class="form-control" name="empresa" id="empresa">
                                            <option value="Selecione">Selecione</option>
                                            <option value="EmpresaA">Empresa A</option>
                                            <option value="EmpresaB">Empresa B</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="select-input">Centro de Custo</label>
                                        <select class="form-control" name="cc_descricao" id="cc_descricao">
                                            <option value="Selecione">Selecione</option>
                                            <option value="administrativo">Administrativo</option>
                                            <option value="financeiro">Financeiro</option>
                                            <option value="RH">RH</option>
                                            <option value="Comercial">Comercial</option>
                                            <option value="Operacional">Operacional</option>
                                            <option value="logistica">Logistica</option>
                                            <option value="aloxarifado">Aloxarifado</option>
                                            <option value="TI">TI</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label class="form-check-label" for="radio1">Administrador</label>
                                    <div class="form-check-inline">
                                        <label class="form-check-label" for="radio2">
                                            <input type="radio" class="form-check-input" id="radio2"
                                                   name="admin" value="1">Sim
                                        </label>
                                        <label class="form-check-label" for="radio1">
                                            <input type="radio" class="form-check-input" id="radio1"
                                                   name="admin" value="0" checked>Não
                                        </label>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="senha">Senha</label>
                                        <input type="password" id="senha" name="senha" class="form-control">
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
                                            <tr>
                                                <td >
                                                     <img id="imagem" src=" " width="100%"/>
                                                    <input type="text" readonly name="foto" id="foto" value=" "
                                                           style="display: none;  float: left">
                                                </td>
                                                </td>
                                                <td>
                                                    <i alt="Remover anexo" class="fa fa-trash fa-1x" id="remove-foto"
                                                       aria-hidden="true"
                                                       style="display: none; padding-top: 7%; float: right; cursor: pointer"></i>
                                                </td>
                                            </tr>
                                            <tr>

                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="col-sm-1" style="float: right">
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
        $('#imagem').attr('src', '');

        alert('Anexo removido!');
    });

</script>