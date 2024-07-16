
function agregarCategoria(){
    modalCategoriaForm();
    $('#categoriaId').val(0);
    $('#buttonSubmit').val('Enviar');
}
function modalCategoriaForm(){
    $('#modalCategoria').addClass('modal--show');
}
function buscarCategoria( input ){
    modalCategoriaForm();
    $('#estado').val( input.getAttribute('data-estado') );
    $('#nombre').val( input.getAttribute('data-nombre') );
    $('#categoriaId').val( input.getAttribute('data-id') );
    $('#buttonSubmit').val('Guardar Cambios');
}

function cerrarModal(){
    $('#modalCategoria').removeClass('modal--show');
}