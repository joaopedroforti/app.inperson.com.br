<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currículo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        h4 {
            background-color: #f2f2f2;
            padding: 10px;
            border-bottom: 2px solid #ddd;
        }
        h5 {
            background-color: #e6e6e6;
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
        }
        li {
            margin-bottom: 5px;
        }
        .section {
            margin-bottom: 20px;
        }
        @media print {
            body {
                margin: 0;
                padding: 20px;
            }
            h4, h5 {
                margin: 0;
                padding: 5px;
            }
            hr {
                display: none;
            }
        }
    </style>
</head>
<body>
    <?php
    // Supondo que $curriculo já tenha sido definido e passado para esta página
    displayCurriculum($curriculo);

    function displayCurriculum($curriculo_json) {
        $curriculo = json_decode($curriculo_json, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "<p>Erro ao decodificar JSON: " . htmlspecialchars(json_last_error_msg()) . "</p>";
            return;
        }

        echo "<div class='section'>";
        foreach ($curriculo as $sectionTitle => $sectionContent) {
            echo "<h4>" . htmlspecialchars($sectionTitle) . "</h4>";
            if (is_array($sectionContent)) {
                foreach ($sectionContent as $key => $value) {
                    if (is_array($value)) {
                        echo "<h5>" . htmlspecialchars($key) . "</h5>";
                        echo "<ul>";
                        foreach ($value as $subKey => $subValue) {
                            if (is_array($subValue)) {
                                echo "<li>" . htmlspecialchars($subKey) . ":";
                                echo "<ul>";
                                foreach ($subValue as $subSubKey => $subSubValue) {
                                    echo "<li>" . htmlspecialchars($subSubKey) . ": " . htmlspecialchars($subSubValue) . "</li>";
                                }
                                echo "</ul>";
                                echo "</li>";
                            } else {
                                echo "<li>" . htmlspecialchars($subKey) . ": " . htmlspecialchars($subValue) . "</li>";
                            }
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>" . htmlspecialchars($key) . ": " . htmlspecialchars($value) . "</p>";
                    }
                }
            } else {
                echo "<p>" . htmlspecialchars($sectionContent) . "</p>";
            }
        }
        echo "</div><hr>";
    }
    ?>

<br><br><br>
<b>Cúrriculo gerado por Inperson</b>


<script>
        // Função para abrir a caixa de diálogo de impressão e fechar a página após a impressão
        function printAndClose() {
            window.print(); // Abre a caixa de diálogo de impressão

            // Adiciona um listener de evento para detectar quando a impressão é concluída
            window.onafterprint = function() {
                window.close(); // Fecha a página após a impressão
            };
        }

        // Executa a função quando a página é carregada
        window.onload = printAndClose;
    </script>
</body>
</html>
