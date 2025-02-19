<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Libros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>

<?php include __DIR__ . "/../layouts/menu.php"; ?>

<div class="container mt-4">
    <h1>Libros</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formularioModal">Nuevo Libro</button>

    <table class="table mt-3">
        <thead class="table-dark">
            <tr>
                <th>Título</th>
                <th>Autor</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($libros as $libro): ?>
                <tr>
                    <td><?= htmlspecialchars($libro['titulo']) ?></td>
                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm btn-editar" data-id="<?= $libro['id'] ?>">Editar</button>
                        <button class="btn btn-danger btn-sm btn-eliminar" data-id="<?= $libro['id'] ?>">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            if (confirm("¿Seguro que deseas eliminar este libro?")) {
                axios.delete(`/gestion_libros/public/api/libros/delete/${id}`)
                    .then(response => location.reload())
                    .catch(error => console.error("Error al eliminar:", error));
            }
        });
    });

    document.querySelectorAll(".btn-editar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            axios.get(`/gestion_libros/public/api/libros/${id}`)
                .then(response => {
                    document.getElementById("titulo").value = response.data.titulo;
                    document.getElementById("autor").value = response.data.autor;
                    new bootstrap.Modal(document.getElementById("formularioModal")).show();
                })
                .catch(error => console.error("Error al cargar datos:", error));
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
