document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".btn-eliminar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            if (confirm("¿Seguro que deseas eliminar este elemento?")) {
                fetch(`/gestion_libros/public/${this.getAttribute("data-type")}/delete/${id}`, { method: "POST" })
                    .then(response => response.json())
                    .then(data => { if (data.success) location.reload(); })
                    .catch(error => console.error("Error:", error));
            }
        });
    });

    document.querySelectorAll(".btn-editar").forEach(button => {
        button.addEventListener("click", function() {
            const id = this.getAttribute("data-id");
            const type = this.getAttribute("data-type");
            const newValue = prompt(`Ingrese el nuevo ${type === "libros" ? "título del libro" : "nombre del autor"}:`);

            if (newValue) {
                fetch(`/gestion_libros/public/${type}/update/${id}`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(type === "libros" ? { titulo: newValue } : { nombre: newValue })
                })
                .then(response => response.json())
                .then(data => { if (data.success) location.reload(); })
                .catch(error => console.error("Error:", error));
            }
        });
    });
});
