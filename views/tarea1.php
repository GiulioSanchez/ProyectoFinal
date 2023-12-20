<!DOCTYPE html>
<html lang="en">

<head>
    <title>Superhero Explorer Tarea 1</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            background-color: #ffffff;
            margin-top: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .p-5 {
            background-color: #007bff;
            color: #ffffff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        table {
            background-color: #ffffff;
        }

        th {
            background-color: #343a40;
            color: #ffffff;
        }

        #heroesTable tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #heroesTable tr:hover {
            background-color: #cce5ff;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="">
            <div class="p-5">
                <h3 class="text-center mb-4">Superhero</h3>
                <div class="mb-3">
                    <label for="publisher" class="form-label">Select Publisher:</label>
                    <select class="form-select" aria-label="Default select example" id="publisher">

                    </select>
                </div>
            </div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Race</th>
                    </tr>
                </thead>
                <tbody id="heroesTable"></tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script>

        document.addEventListener("DOMContentLoaded", () => {
            function $(id) {return document.querySelector(id)}

            (function () {
                fetch(`../controllers/publisher.controller.php?operacion=listarPublishers`)
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        let tagOption;
                        console.log(datos)
                        datos.forEach(dato => {
                            tagOption = document.createElement("option");
                            tagOption.value = dato.id;
                            tagOption.innerHTML = dato.publisher_name
                            $("#publisher").appendChild(tagOption);
                        });
                    });
            })();

            const listarSuperHeroes = () => {
                const parametros = new FormData()
                parametros.append("operacion", "listarSuperHeroes")
                parametros.append("publisher_id", $("#publisher").value)

                fetch(`../controllers/Superheroes.controller.php?`, {
                    method: 'POST',
                    body: parametros
                })
                    .then(respuesta => respuesta.json())
                    .then(datos => {
                        datos.forEach(dato => {
                            console.log(datos)
                            datos.forEach(dato => {
                            const heroeRow = document.createElement("tr");

                            Object.values(dato).forEach(value => {
                                const heroeData = document.createElement("td");
                                heroeData.innerHTML = value;
                                heroeRow.appendChild(heroeData);
                            });
                            $("#heroesTable").appendChild(heroeRow)
                        });
                    });
            })};

            $("#publisher").addEventListener("change", (e)=> {
                listarSuperHeroes();
            })
        })
    </script>
</body>

</html>
