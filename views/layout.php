<?php
require __DIR__.'views/../vendor/autoload.php';
require_once '../Classes/sessao.php';
require_once '../Classes/Firebase.php';


$sessao = Sessao::getInstancia();
$sessao->requerLogin();

$firebaseConnection = Firebase::getInstance();
$database = $firebaseConnection->getDatabase();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Lateral em PHP</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/dashboard.css">
    <link rel="stylesheet" href="../styles/layout.css">
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2 sidebar bg-dark">
            <nav class="nav flex-column">
                <div id="header-bar">
                    <img src="../img/OIG3.3Kje.lad.png" >
                    <p>Pos Dash</p>
                </div>
                <a class="nav-link active" href="" id="link-dashboard">Dashboard</a>
                <a class="nav-link" href="" id="link-clientes">Gerenciar Clientes</a>
                <a class="nav-link" href="" id="link-produtos">Gerenciar Produtos</a>
                <a class="nav-link" href="" id="link-vendas">Realizar Vendas</a>
                <a class="nav-link" href="" id="link-sair">Sair</a>
            </nav>
        </div>
        <div class="col-md-9 col-lg-10 content" id="main-content">
            <div id="dashboard-content" style="display: none;"><?php include_once('dash.php');?></div>
            <div id="clientes-content" style="display: none;"><?php include_once('../Cliente.html');?></div>
            <div id="produtos-content" style="display: none;"><?php include_once('../Produto.html');?></div>
            <div id="vendas-content" style="display: none;"><?php include_once('../Vendas.html');?></div>
            <div id="sair-content" style="display: none;"></div>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../scripts/layout.js"></script>
<script src="">
    
</script>


</body>
</html>
