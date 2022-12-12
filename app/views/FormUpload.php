<?php
require_once('././config.php');

require_once(DBAPI);
abresessao();
$_SESSION['menu'] = 'SGT';

include(ESTILO_TEMPLATE);
include(HEADER_TEMPLATE);
include(MENU_TEMPLATE);

?>
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
        <?php if (!empty($mensagem) && $mensagem != "Arquivo enviado."): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $mensagem; ?>
            </div>
        <?php elseif (!empty($mensagem) && $mensagem == "Arquivo enviado."): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>
        <div class="animated fadeIn">

        </div>


        <div class="portlet">

            <div class="portlet-header">

                <h3>
                    <i class="fa fa-database"></i>
                    Importação de dados
                </h3>

            </div> <!-- /.portlet-header -->

            <div class="portlet-content">
                <div class="portlet">
                    <table class="table table-striped table-condensed table-bordered table-hover table-checkable">
                        <tbody>
                        <tr>
                            <td>
                                <form enctype="multipart/form-data" method="post"
                                      action='<?php echo BASEURL_SGT ?>upload'>
                                    <div class="form-group row">
                                        <input class="btn btn-file" type="file" name="arquivo[]" multiple="multiple"
                                               style="margin-left: 5px" required/>
                                        <input name="enviar" type="submit" value="Enviar" class="btn btn-default"
                                               style="margin-left: 15px">
                                    </div>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div> <!-- /.portlet -->
            </div> <!-- /.portlet-content -->
        </div> <!-- /.portlet -->
    </div>

</div> <!-- /#content-container -->

<?php include(FOOTER_TEMPLATE); ?>


