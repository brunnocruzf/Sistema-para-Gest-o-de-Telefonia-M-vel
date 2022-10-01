<?php

require_once('C:\xampp\htdocs\sgt\config.php');
require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';
include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);


use \app\controllers\TelefonesController;
?>
<style>
    .table-condensed {
        font-size: 10px;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        var smatricula = $("#matricula").val();
        $.ajax({
            type: "POST",
            url: 'http://portaldev.tmsa.ind.br/portaldev/SIPER/solicitacao/processa.php?matricula=' + smatricula,
            dataType: 'json',
            beforeSend: function () {
                $("#loader").show();
            },
            success: function (data) {
                console.log(data);
                $('#nome').val(data.NOME);
                $('#email').val(data.EMAIL);
                $('#cc').val(data.CC);
            },
            complete: function (data) {
                $("#loader").hide();
            },
            error: function () {
                alert("Matricula não localizada!");
            }
        });
        $(function () {
            $('#matricula').change(function (e) {
                e.preventDefault();
                var smatricula = $("#matricula").val();
                $.ajax({
                    type: "POST",
                    url: 'http://portaldev.tmsa.ind.br/portaldev/SIPER/solicitacao/processa.php?matricula=' + smatricula,
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
        <h1>SISTEMA DE GESTÃO DE TELEFONIA</h1>
    </div> <!-- #content-header -->
    <div id="content-container">
        <?php if (!empty($mensagem)): ?>
            <?php echo $mensagem; ?>
        <?php endif; ?>
        <div class="portlet">
            <div class="portlet-header">
                <h3>
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
                <form id="formadd" action="editSalvaTelefone" data-validate="parsley" class="form parsley-form" method="post">
                    <div class="panel panel-default">
                        <div class="panel-heading">Informações da conta</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="select-input">Empresa referente *</label>
                                        <select class="form-control" name="empresa" value="teste" required>
                                            <option value="<?php echo $telefone['empresa'] ?>"><?php echo $telefone['empresa'] ?></option>
                                            <option value="TMSA">TMSA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label for="select-input">Conta referente *</label>
                                        <select class="form-control" name="conta">
                                            <option value="<?php echo $telefone['conta'] ?>"><?php echo $telefone['conta'] ?></option>
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
                                        <input id="matricula" name="matricula" class="form-control input-sm" type="text" value="<?php echo $telefone['matricula'] ?>"></input>
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
                                        <label for="select-input">Centro de custos*</label>
                                        <select class="form-control" id="cc" name="CC" id="tipo">
                                            <?php
                                            $telcontroller = new TelefonesController();
                                            $CCLinha = $telcontroller->buscaCClinha($telefone['linha']);

                                            if($telefone['cc_descricao'] == '' && !$CCLinha['cc'] == ''){
                                                echo "<option value=".$CCLinha['cc'].">".$CCLinha['cc']."</option>";
                                            }elseif($CCLinha['cc'] == '' && !$telefone['cc_descricao']){
                                                echo "<option value=".$telefone['cc_descricao'].">".$telefone['cc_descricao']."</option>";
                                            }
                                            $CCs = $telcontroller->buscaCC();
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
                                        <input type="number" id="numero" name="numero" class="form-control" value="<?php echo $telefone['linha'] ?>" required>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="select-input">ICCID</label>
                                            <input type="number" id="iccid" name="iccid" class="form-control" value="<?php echo $telefone['iccid'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="select-input">Tipo de telefone *</label>
                                            <select class="form-control" name="tipo" id="tipo">
                                                <option value="<?php echo $telefone['tipo'] ?>"><?php echo $telefone['tipo'] ?></option>
                                                <option value="EMPRESA">Empresa</option>
                                                <option value="PARTICULAR">Particular</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="select-input">Plano*</label>
                                            <select class="form-control" name="plano" required>
                                                <option value="<?php echo $telefone['plano'] ?>"><?php echo $telefone['plano'] ?></option>
                                                <option value="PLANO SMART TMSA">PLANO SMART TMSA</option>
                                                <option value="PLANO CENTRAL TMSA - POA">PLANO CENTRAL TMSA - POA</option>
                                                <option value="PLANO CENTRAL TMSA - SPO">PLANO CENTRAL TMSA - SPO</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="select-input">Cota</label>
                                            <input type="number" id="cota" name="cota" class="form-control" value="<?php echo $telefone['cota'] ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="select-input">Observações</label>
                                            <textarea class="form-control" name="observacoes" rows="5"><?php echo $telefone['observacao'] ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="ativo" value="SIM" class="form-control">
                                <input type="hidden" name="linhaAntiga" value="<?php echo $telefone['linha'] ?>" class="form-control">
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
