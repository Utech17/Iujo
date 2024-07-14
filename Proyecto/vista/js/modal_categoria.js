document.addEventListener('DOMContentLoaded', (event) => {
    const abrir_modal = document.querySelector('.modal_abrir');
    const modal_section = document.querySelector('.modal_section');
    const cerrar_modal = document.querySelectorAll('.finalizar');

    // Abrir modal agregar
    abrir_modal.addEventListener('click', (e) => {
        e.preventDefault();
        modal_section.classList.add('modal--show');
    });

    // Cerrar modal
    cerrar_modal.forEach((boton) => {
        boton.addEventListener('click', (e) => {
            e.preventDefault();
            modal_section.classList.remove('modal--show');
        });
    });

    // Obtener todos los botones de editar
    const abrir_modales_editar = document.querySelectorAll('.editarCategoria');

    // Abrir modal editar
    abrir_modales_editar.forEach((boton) => {
        boton.addEventListener('click', (e) => {
            e.preventDefault();
            const modal_editar_id = boton.getAttribute('data-id');
            const modal_editar_nombre = boton.getAttribute('data-nombre');
            const modal_editar_estado = boton.getAttribute('data-estado');

            // Asignar valores al formulario de edición
            document.getElementById('editarId').value = modal_editar_id;
            document.getElementById('editarNombre').value = modal_editar_nombre;
            document.getElementById('editarEstado').value = modal_editar_estado;

            modal_section_editar.classList.add('modal--show');
        });
    });
});