<!DOCTYPE html>
<html lang="es">

<head>
    <title>Bandos de los Publishers tarea3</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- Estilos personalizados -->
    <style>
        body {
            background-color: #f8f9fa;
            color: #212529;
            font-family: 'Arial', sans-serif;
        }

        h1 {
            color: #007bff;
            text-align: center;
            margin-top: 50px;
        }

        .container {
            margin-top: 20px;
        }

        .select-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .chart-container {
            width: 70%;
            margin: auto;
        }

        canvas {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <h1>LOS BANDOS DE LOS PUBLISHERS</h1>
    <div class="container">
        <div class="select-container p-3">
            <select class="form-select" aria-label="Default select example" id="publisher"></select>
        </div>
        <div class="chart-container">
            <canvas id="lienzo"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            function $(id) { return document.querySelector(id) }
            const contexto = document.querySelector("#lienzo");
            const grafico = new Chart(contexto, {
                type: 'bar',
                data: {
                    labels: [],
                    datasets: [{
                        label: "Bandos",
                        data: [],
                        backgroundColor: [
                            'rgba(255, 92, 51, 0.7)',
                            'rgba(79, 195, 247, 0.7)',
                            'rgba(255, 202, 40, 0.7)',
                            'rgba(103, 58, 183, 0.7)',
                            'rgba(0, 176, 80, 0.7)',
                            'rgba(255, 138, 0, 0.7)'
                        ],
                        borderColor: [
                            'rgba(255, 92, 51, 1)',
                            'rgba(79, 195, 247, 1)',
                            'rgba(255, 202, 40, 1)',
                            'rgba(103, 58, 183, 1)',
                            'rgba(0, 176, 80, 1)',
                            'rgba(255, 138, 0, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });

            (function () {
                fetch(`../controllers/Publisher.controller.php?operacion=listarPublishers`)
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        let tagOption;
                        datos.forEach(dato => {
                            tagOption = document.createElement("option");
                            tagOption.value = dato.id;
                            tagOption.innerHTML = dato.publisher_name;
                            $("#publisher").appendChild(tagOption);
                        });
                    })
            })()

            const buscarBandos = () => {
                const parametros = new FormData();
                parametros.append("operacion", "listarBandosPorPublisher");
                parametros.append("id", $("#publisher").value);

                fetch(`../controllers/Alignment.controller.php`, {
                    method: "POST",
                    body: parametros
                })
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        grafico.data.labels = datos.map(bandos => bandos.nombre_bando);
                        grafico.data.datasets[0].data = datos.map(bandos => bandos.superheroe);
                        grafico.update();
                    })
                    .catch(e => {
                        console.error(e);
                    });
            }

            $("#publisher").addEventListener("change", () => {
                buscarBandos();
            })
        });
    </script>

    <!---->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
