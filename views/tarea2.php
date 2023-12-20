<!DOCTYPE html>
<html lang="es">

<head>
    <title>Bandos Tarea2</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3.2 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <!-- -->
    <style>
        body {
            background-color: #f5f5f5;
            color: #333;
            font-family: 'Arial', sans-serif;
        }

        header,
        footer {
            background-color: #4285f4;
            color: #ffffff;
            padding: 10px;
        }

        main {
            padding: 20px;
        }

        h2 {
            color: #4285f4;
        }

        .container {
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
    <header>
       
    </header>

    <main>
        <h4 class="text-center mt-5">Número de Héroes y Villanos en cada Facción</h4>
        <div class="container mt-10">
            <div>
                <div class="container">
                    <canvas id="lienzo"></canvas>
                </div>
            </div>
        </div>
    </main>

    <footer>
    
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const contexto = document.querySelector("#lienzo");
        const grafico = new Chart(contexto, {
            type: 'bar',
            data: {
                labels: [],
                datasets: [{
                    label: "SuperHeroes",
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
            fetch(`../controllers/Bandos.controller.php?operacion=listarBandos`)
                .then(respuesta => respuesta.json())
                .then(datos => {
                    console.log(datos)
                    grafico.data.labels = datos.map(bandos => bandos.nombre_bando);
                    grafico.data.datasets[0].data = datos.map(bandos => bandos.superheroe);

                    grafico.update();
                })
                .catch(e => {
                    console.error(e)
                });
        })();
    </script>

    <!-- -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>
