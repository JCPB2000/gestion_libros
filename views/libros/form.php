<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Libro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Agregar Nuevo Libro</h2>
    <form id="formLibro">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" required>
        </div>
        <div class="mb-3">
            <label for="autor" class="form-label">Autor</label>
            <input type="text" class="form-control" id="autor" required>
        </div>
        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.getElementById("formLibro").addEventListener("submit", function(event) {
    event.preventDefault();

    const titulo = document.getElementById("titulo").value;
    const autor = document.getElementById("autor").value;

    axios.post("http://localhost/gestion_libros/public/api/libros", {
        titulo: titulo,
        autor: autor
    })
    .then(response => {
        alert("Libro agregado con éxito");
        location.href = "/gestion_libros/public/libros"; // Redirigir a la lista de libros
    })
    .catch(error => {
        console.error("Error al agregar libro:", error);
    });
});
</script>

</body>
</html>
