


<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Relatorio comportamental - {name} - {date}</title>
<!-- Bootstrap CSS -->  
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<link rel="stylesheet" href="<?= base_url('assets/reports/style.css') ?>">
<div class="capa">
   <img src="<?= base_url('assets/reports/blue_logo.png') ?>" style="width: 200px;align-items: end;align-self: end;">

<?= $templateFinal ?>

<script>
    var options = {
        series: [{
            name: '',
            data: <?= json_encode($values) ?>,
        }],
        chart: {
            height: 500,
            type: 'radar',
        },
        yaxis: {
            max: 100 // Define o valor máximo do eixo y como 100
        },
        xaxis: {
            categories: <?= json_encode($names) ?>
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
<style>
button {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      padding: 15px 30px;
      font-size: 16px;
      z-index: 9999;
    }

    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.9); /* Cor de fundo semi-transparente */
      z-index: 999; /* Para garantir que esteja acima de todos os outros elementos */
    }

    /* Estilo para remover a camada de sobreposição durante a impressão */
    @media print {
      #overlay {
        display: none;
      }
    }
  </style>
<div class="overlay" id="overlay"></div>
 <!-- Div para o fundo escurecido -->
<button id="printButton"  type="button" onclick="imprimirEPular()" class="btn btn-primary btn-lg">Baixar ou Imprimir</button>

  <script>
    function imprimirEPular() {
      // Ocultar botão antes de imprimir
      document.getElementById('printButton').style.display = 'none';

      // Imprimir a página atual
      window.print({  printBackground: true });

      // Redirecionar para inperson.com imediatamente após a impressão
      window.history.back();
    }
  </script>