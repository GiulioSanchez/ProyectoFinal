<!doctype html>
<html lang="es">
  <head>
    <title>Vista Publisher</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />
  </head>

  <body>
    <header>
      <!-- place navbar here -->
    </header>
    <main>

    <div class="container">
    <div class="card mt-5 border-primary">
      <div class="card-header bg-primary text-light">TAREA N1</div>

      <div class="mb-3">
        <label for="publisher_name" class="form-lable">Vista Publisher:</label>
        <select name="publisher_name" id="publisher_name" class="form-control form-select shadow" required>
          <option value="">SELECIONAR</option>
        </select>
      </div>
            <script>
  // funcion autoejecutable para traer datos del backend
      (function() {

      fetch(`../controllers/publisher.controller.php?operacion=listar`)
       .then(respuesta => respuesta.json())
       .then(datos => {
       console.log(datos)

          datos.forEach(element => {
      
        const tagOption = document.createElement("option");
         tagOption.value = element.id
          tagOption.innerHTML = element.publisher_name
         $("#publisher_name").appendChild(tagOption);
      });
   })
     .catch(e => {
       console.error(e)
     });
  })();


    </script>




   
    </main>
    <footer>
      <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
