document.addEventListener('DOMContentLoaded', (event) => {
    const abrir_modal = document.querySelector('.modal_abrir');
    const modal_section = document.querySelector('.modal_section');
    const cerrar_modal = document.querySelectorAll('.finalizar');

    // Abrir modal
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
});