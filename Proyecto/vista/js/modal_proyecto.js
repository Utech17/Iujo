document.addEventListener("DOMContentLoaded", function () {
  // Variables globales para los modales de agregar
  const abrir_modal = document.querySelector(".modal_abrir");
  const modal_section = document.querySelector(".modal_section");
  const cerrar_modal = document.querySelectorAll(".finalizar");

  // Abrir modal agregar
  abrir_modal.addEventListener("click", function (e) {
    e.preventDefault();
    modal_section.classList.add("modal--show");
  });

  // Cerrar modal general
  cerrar_modal.forEach(function (boton) {
    boton.addEventListener("click", function (e) {
      e.preventDefault();
      modal_section.classList.remove("modal--show");
    });
  });

  // Variables globales para los modales de edición
  const modal_section_editar = document.querySelector(".modal_section_editar");
  const cerrar_modalEditar = document.querySelectorAll(".finalizarEditar");
  const abrir_modales_editar = document.querySelectorAll(".editarProyecto");

  // Abrir modal editar
  abrir_modales_editar.forEach(function (boton) {
    boton.addEventListener("click", function (e) {
      e.preventDefault();
      const modal_editar_id = boton.getAttribute("data-id");
      const modal_editar_nombre = boton.getAttribute("data-nombre");
      const modal_editar_descripcion = boton.getAttribute("data-descripcion");
      const modal_editar_estado = boton.getAttribute("data-estado");

      // Asignar valores al formulario de edición
      document.getElementById("editarId").value = modal_editar_id;
      document.getElementById("editarNombre").value = modal_editar_nombre;
      document.getElementById("editarDescripcion").value =
        modal_editar_descripcion;
      document.getElementById("editarEstado").value = modal_editar_estado;

      modal_section_editar.classList.add("modal--show");
    });
  });

  // Cerrar modal Editar
  cerrar_modalEditar.forEach(function (boton) {
    boton.addEventListener("click", function (e) {
      e.preventDefault();
      modal_section_editar.classList.remove("modal--show");
    });
  });
});
