<?php
require_once('././config.php');

require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);

$_SESSION['menu'] = 'SGT';

use \app\controllers\TelefonesController;
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
<script>
    $(document).ready(function () {
        $(function () {
            $('#matricula').change(function (e) {
                e.preventDefault();
                var smatricula = $("#matricula").val();
                $.ajax({
                    type: "get",
                    url: '<?php echo BASEURL_SGT?>usuarios/buscaPorMatricula/' + smatricula,
                    dataType: 'json',
                    beforeSend: function () {
                        $("#loader").show();
                    },
                    success: function (data) {
                        console.log(data);
                        $('#nome').val(data.NOME);
                        $('#email').val(data.EMAIL);
                        $('#cc').val(data.CodCC+" - "+data.CC);
                    },
                    complete: function (data) {
                        $("#loader").hide();
                    },
                    error: function () {
                        alert("Matricula não localizada!");
                    }
                });
            });
        });
    });
    function validaForm(){
        var pegaTipo = document.getElementById("tipo");
        var tipo = pegaTipo.value;

        var pegaCC = document.getElementById("cc");
        var centrocusto = pegaCC.value;

        if(tipo == "Selecione"){
            alert("Tipo de plano inválido. Selecione particular ou empresa.");
            pegaTipo.focus();
            return false;
        }else if(centrocusto == "Selecione"){
            alert("Centro de custo inválido.");
            pegaCC.focus();
            return false;
        }else{
            return true;
        }

    }

</script>
<style>
    .table-condensed {
        font-size: 10px;
    }
</style>

<div id="content">
    <div id="content-header">
        <h1>SGT - SISTEMA PARA GESTÃO DE TELEFONIA MÓVEL</h1>
    </div> <!-- #content-header -->
    <div id="content-container">
        <?php if (!empty($mensagem)): ?>
                <?php echo $mensagem; ?>
        <?php endif; ?>
        <div class="portlet">
            <div class="portlet-header">
                <h3><span  class="badge" style="background-color: #bdbdbd; padding-left: 11px; padding: 5px" onclick="history.back()"><i class="fa fa-arrow-left"></i></span>
                    <i class="fa fa-phone-square" style="transform: rotate(90deg);"></i>
                    TELEFONES
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
                <form id="formadd" action="novoTelefone" data-validate="parsley" class="form parsley-form" method="post">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações da conta</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="select-input">Empresa referente *</label>
                                        <select class="form-control" name="empresa" required>
                                            <option value="TMSA">TMSA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="select-input">Conta referente *</label>
                                        <select class="form-control" name="conta">
                                            <option value="AXOON TMSA">AXOON TMSA</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading">Responsável pela linha</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="select-input">Matrícula</label>
                                        <input id="matricula" name="matricula" class="form-control input-sm" type="text" value=""></input>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="select-input">Nome Completo</label>
                                        <input type="text" id="nome" name="nome" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="select-input">Email</label>
                                        <input type="text" id="email" name="email" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="select-input">Centro de custo*</label>
                                        <select class="form-control" id="cc" name="CC" id="tipo">
                                            <option value="Selecione">Selecione</option>
                                            <?php
                                                $telController = new TelefonesController();
                                                $CCs = $telController->buscaCC();
                                                foreach ($CCs as $CC){
                                                    echo "<option value='".$CC['cc']." - " .$CC['cc_descricao']."'>".$CC['cc']." - ".$CC['cc_descricao']."</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-heading">Informações da linha</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group">
                                    <div class="col-md-3">
                                        <label for="select-input">Número *</label>
                                        <input type="number" id="numero" name="numero" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="select-input">ICCID</label>
                                            <input type="number" id="iccid" name="iccid" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="select-input">Tipo de telefone *</label>
                                            <select class="form-control" name="tipo" id="tipo">
                                                <option value="Selecione">Selecione</option>
                                                <option value="EMPRESA">Empresa</option>
                                                <option value="PARTICULAR">Particular</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="select-input">Plano*</label>
                                            <select class="form-control" name="plano" required>
                                                <option value="PLANO SMART TMSA">PLANO SMART TMSA</option>
                                                <option value="PLANO CENTRAL TMSA - POA">PLANO CENTRAL TMSA - POA</option>
                                                <option value="PLANO CENTRAL TMSA - SPO">PLANO CENTRAL TMSA - SPO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="select-input">Cota</label>
                                            <input type="number" id="cota" name="cota" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="select-input">Observações</label>
                                            <textarea class="form-control" name="observacoes" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="ativo" value="SIM" class="form-control">
                            </div>
                            <br>
                            <div class="col-sm-2">
                                <button type="submit" id="btn" name="btn" class="btn btn-success btn-lg btn-block" onclick="return validaForm()"><i class="fa fa-save"></i>Salvar</button>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include(FOOTER_TEMPLATE); ?>
