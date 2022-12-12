<?php
$loguser = $_SESSION['login'];
?>

<nav id="sidebar">
    <ul id="main-nav" class="open-active">
        <li class="dropdown active">

            <a href="javascript:;">
                <i class="fa  fa-phone" aria-hidden="true" style="transform: rotate(90deg);"></i>
                <span>SISTEMA SGT</span>
                <span class="caret"></span>
            </a>

            <ul class="sub-nav">
                <li>
                    <a href="<?php echo BASEURL_SGT; ?>meusTelefones/<?php echo $_SESSION['matricula']; ?>"><i
                                class="fa fa-phone" aria-hidden="true" style="transform: rotate(90deg);"></i>
                        Minhas Linhas
                    </a>
                </li>
                <?php if($_SESSION['admin'] == "1"): ?>
                <li>
                    <a href="<?php echo BASEURL_SGT; ?>celulares"><i class="fa fa-phone-square" aria-hidden="true"
                                                                     style="transform: rotate(90deg);"></i>
                        Celulares
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASEURL_SGT; ?>telefones"><i class="fa fa-wifi" aria-hidden="true"
                                                                     style="transform: rotate(90deg);"></i>
                        Linhas
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASEURL_SGT; ?>usuarios"><i class="fa fa-users"></i>
                        Usuários
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASEURL_SGT; ?>relatorios"><i class="fa fa-line-chart"></i>
                        Relatórios
                    </a>
                </li>
                <li>
                    <a href="<?php echo BASEURL_SGT; ?>upload"><i class="fa fa-database"></i>
                        Importar dados
                    </a>
                </li>
                <?php endif;?>
            </ul>


    </ul>

</nav> <!-- #sidebar -->
<script src="assets/js/libs/jquery.cookie.js"></script>
<style>
    .ui-sortable-helper {
        background-color: silver;
    }

    .sortable-placeholder {
        margin: 150px;
        height: 50px;
        opacity: 5;
        visibility: visible;
        background-color: #44444475;
    }
</style>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
