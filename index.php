<?php
//error_reporting(0);

require_once 'vendor/autoload.php';

use \PlugRoute\PlugRoute;
use \PlugRoute\RouteContainer;
use \PlugRoute\Http\RequestCreator;
use \PlugRoute\Http\Request;
use core\Controller;

$route = new PlugRoute(new RouteContainer(), RequestCreator::create());

$route->get('/', 'app\controllers\index@login');
$route->post('/loga', 'app\controllers\index@loga');
$route->get('/logout', 'app\controllers\index@logout');

//rotas para upload
$route->post('/upload', 'app\controllers\CsvController@uploadCsv');
$route->get('/upload', 'app\controllers\CsvController@uploadCsv');

//rotas para telefones
$route->get('/novoTelefone', 'app\controllers\TelefonesController@novoTelefone');
$route->post('/novoTelefone', 'app\controllers\TelefonesController@novoTelefone');
$route->get('/edit/{nro}', 'app\controllers\TelefonesController@editTelefone');
$route->post('/edit/editSalvaTelefone', 'app\controllers\TelefonesController@editSavalTelefone');
$route->post('/delete/{nro}', 'app\controllers\TelefonesController@deleteTelefone');
$route->get('/telefones', 'app\controllers\TelefonesController@telefones');

//rotas para faturars
$route->get('/faturas/{nro}', 'app\controllers\FaturasController@index');
$route->get('/fatura/{nro}/{date}', 'app\controllers\FaturasController@viewFatura');
$route->get('/printFatura/{nro}/{date}', 'app\controllers\FaturasController@printFatura');

//rotas para relatorios
$route->get('/relatorios', 'app\controllers\RelatoriosController@index');
$route->get('/relatorios/faturas', 'app\controllers\RelatoriosController@RelatoriosFat');
$route->get('/relatorios/maiorConsumo', 'app\controllers\RelatoriosController@maiorConsumo');
$route->get('/relatorios/faturas/{date}', 'app\controllers\RelatoriosController@detalhesFat');
$route->get('/relatorios/exportRateio/{date}', 'app\controllers\RelatoriosController@exportRateioCC');
$route->get('/relatorios/exportRH/{date}', 'app\controllers\RelatoriosController@exportRH');
$route->get('/relatorios/valorLinha/{date}', 'app\controllers\RelatoriosController@valorLinha');
$route->get('/relatorios/contratos', 'app\controllers\RelatoriosController@contratos');

$route->get('/relatorios/celularesporcc', 'app\controllers\RelatoriosController@celularesporcc');

//rotas para meus telefones
$route->get('/meusTelefones/{mat}', 'app\controllers\MeusTelefonesController@index');

//rotas para usu??rios
$route->get('/usuarios', 'app\controllers\UsuariosController@usuarios');
$route->get('/usuarios/novo', 'app\controllers\UsuariosController@novoUsuario');
$route->post('/usuarios/novoUsuario', 'app\controllers\UsuariosController@novoUsuario');
$route->get('/usuarios/delete/{nro}', 'app\controllers\UsuariosController@delete');
$route->get('/upload_foto', 'app\controllers\UsuariosController@foto');
$route->post('/upload_foto', 'app\controllers\UsuariosController@foto');
$route->get('/usuarios/edit/{nro}', 'app\controllers\UsuariosController@editUser');
$route->post('/usuarios/edit/', 'app\controllers\UsuariosController@editSaveUser');
$route->get('/usuarios/buscaPorMatricula/{matricula}', 'app\controllers\UsuariosController@buscaPorMatricula');
$route->get('/usuarios/processa/{matricula}', 'app\controllers\UsuariosController@processa');

//rotas para celulares
$route->get('/celulares', 'app\controllers\CelularesController@celulares');
$route->get('/celulares/novo', 'app\controllers\CelularesController@novoCelulares');
$route->post('/celulares/novocelulares', 'app\controllers\CelularesController@novoCelulares');
$route->get('/celulares/delete/{nro}', 'app\controllers\CelularesController@delete');
$route->get('/upload_celular', 'app\controllers\CelularesController@foto');
$route->post('/upload_celular', 'app\controllers\CelularesController@foto');
$route->get('/celulares/edit/{nro}', 'app\controllers\CelularesController@editCelular');
$route->post('/celulares/edit/', 'app\controllers\CelularesController@editSaveCelular');
$route->get('/celulares/buscaPorMatricula/{matricula}', 'app\controllers\CelularesController@buscaPorMatricula');

//Rotas para Detalhes
$route->get('/detalhes/{acesso}/{nro}', 'app\controllers\DetalhesController@detalhes');
$route->get('/detalhe/{acesso}/{nro}/{user}', 'app\controllers\DetalhesController@detalhesEditUser');
$route->get('/detalheLinha/{acesso}/{nro}/{user}', 'app\controllers\DetalhesController@detalhesEditLinha');
$route->get('/detalheLinha/removeUserCel/{id}','app\controllers\DetalhesController@removeUserCel');
$route->get('/detalheLinha/removeTelCel/{nro}','app\controllers\DetalhesController@removeTelCel');
$route->get('/detalhe/existeUser/{matricula}','app\controllers\DetalhesController@existeUser');


$route->notFound(function (){
    echo 'Rota n??o encontrada';
});

$route->get('/teste', 'app\controllers\index@teste');

$route->on();