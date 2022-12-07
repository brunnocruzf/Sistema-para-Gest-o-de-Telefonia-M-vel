<?php

//alterar
//require_once('C:\xampp\htdocs\portaldev\config.php');
//include BASEURL_NOTAS.'Core/Model.php';
//use Core\Model;
//require_once('../../config.php');
//require_once('functions.php');
//abresessao();
//require_once ('C:\xampp\htdocs\portal\NotasFiscais\vendor\autoload.php');
//use Core\Model;


function before($that, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $that));
}

;

// use strrevpos function in case your php version does not include it
function strrevpos($instr, $needle)
{
    $rev_pos = strpos(strrev($instr), strrev($needle));
    if ($rev_pos === false)
        return false;
    else
        return strlen($instr) - $rev_pos - strlen($needle);
}

// Flag que indica se há erro ou não
$erro = null;
// Quando enviado o formulário
if (isset($_FILES['arquivoComprovante'])) {
    // Configurações
    $extensoes = array(".dwg", ".txt", ".pdf", ".docx", ".jpg",".xlsx",".png",".doc",".msg");
    // $caminho = "\\tm-ws\\anexosComprovantes\\";

    $caminho =   $_SERVER['DOCUMENT_ROOT'].'/sgt/app/views/fotos/';
    // alterar para portal


//$filename = 'C:\\xampp\htdocs\portal\\formularios\\forms\\templates\adtoForm\\functions\anexosComprovantes\\';
// if (file_exists($filename)) {
//     echo "The file $filename exists";
// } else {
//     echo "The file $filename does not exist";
// }
    // Recuperando informações do arquivo
    $nome = $_FILES['arquivoComprovante']['name'];
    $temp = $_FILES['arquivoComprovante']['tmp_name'];

    // Verifica se a extensão é permitida
    if (!in_array(strtolower(strrchr($nome, ".")), $extensoes)) {
        $erro = 'Extensão inválida';
    }
    // Se não houver erro
    if (!$erro) {
        // Gerando um nome aleatório para a imagem
        $nomeAleatorio = before(".", $nome) . strrchr($nome, ".");
        $nomeAleatorio = str_replace("'", "", $nomeAleatorio); //especifico para remover aspas simples
        $nomeAleatorio = str_replace("#", "", $nomeAleatorio); //especifico para remover #
        $nomeAleatorio = str_replace(" ", "", $nomeAleatorio); //especifico para remover espaços
        $nomeAleatorio = rand(0,9999)."_" . $nomeAleatorio;

        // Movendo arquivo para servidor
        if (!move_uploaded_file($temp, $caminho . $nomeAleatorio))
            $erro = 'Não foi possível anexar o arquivo';
    }
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(function ($) {
        // Definindo página pai
        var pai = window.parent.document;
        $("#uploadComprovante").on('click', function (){
             pai.getElementById("progressFoto").style.display = "flex";
        });

        <?php if (isset($erro)): // Se houver algum erro   ?>

        // Exibimos o erro
        alert('<?php echo $erro ?>');

        <?php elseif (isset($nome)): // Se não houver erro e o arquivo foi enviado   ?>
        pai.getElementById("anexarfoto").style.display = "none";

        pai.getElementById("foto").value = "<?php echo $nomeAleatorio ?>";
        pai.getElementById("imagem").style.display = "flex";
        pai.getElementById("imagem").src = "<?php echo BASEURL_SGT.'app/views/fotos/'.$nomeAleatorio ?>";



        pai.getElementById("foto").style.display = "flex";
        pai.getElementById("remove-foto").style.display = "flex";

       // alert('Arquivo anexado com sucesso!');
         pai.getElementById("progressFoto").style.display = "none";

        //parent.location.reload();

        // Adicionamos um item na lista (ul) que tem ID igual a "anexos"

        <?php endif ?>
        console.log(pai.getElementById("foto").value);
        // Quando enviado o arquivo
        $("#arquivoComprovante").change(function () {
            // Se o arquivo foi selecionado
            if (this.value != "") {
                // Enviamos o formulário
                 $("#uploadComprovante").submit();
            }
        });
        console.log(pai.getElementById("foto").value);
    });

</script>
<style>
    body, form{
        margin: 0px !important;
    }
</style>

<form id="uploadComprovante" action="upload_foto#" method="post" enctype="multipart/form-data" >
    <input class="btn btn-default " type="file" name="arquivoComprovante" id="arquivoComprovante"/>
</form>

