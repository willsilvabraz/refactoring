<?php
require __DIR__.'views/../vendor/autoload.php';
require_once '../Classes/sessao.php';
require_once '../Classes/Firebase.php';


$sessao = Sessao::getInstancia();
$sessao->requerLogin();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$firebase = Firebase::getInstance();
$database = $firebase->getDatabase();
$contatos = $database->getReference('vendas')->getSnapshot();
$vendas = $contatos->getValue();

$produtosMaisVendidos = [];
foreach ($vendas as $venda) {
    $produto = $venda['produto_id'];
    if (array_key_exists($produto, $produtosMaisVendidos)) {
        $produtosMaisVendidos[$produto]++;
    } else {
        $produtosMaisVendidos[$produto] = 1;
    }
}

arsort($produtosMaisVendidos);

$produtosMaisVendidos = array_slice($produtosMaisVendidos, 0, 5, true);

$labels = array_keys($produtosMaisVendidos);
$data = array_values($produtosMaisVendidos);

$dadosGraficoBarras = [
    'labels' => $labels,
    'datasets' => [
        [
            'label' => 'Quantidade de Vendas',
            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            'borderColor' => 'rgba(54, 162, 235, 1)',
            'borderWidth' => 1,
            'data' => $data
        ]
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico de Produtos Mais Vendidos</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="container">
    <div class="col-lg-6">
        <h2>Produtos Mais Vendidos</h2>
        <canvas id="graficoProdutosMaisVendidos"></canvas>
    </div>
</div>

<script>
var ctx = document.getElementById('graficoProdutosMaisVendidos').getContext('2d');
var graficoProdutosMaisVendidos = new Chart(ctx, {
    type: 'bar',
    data: <?php echo json_encode($dadosGraficoBarras); ?>,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
