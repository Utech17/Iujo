    function agregarItem(){
        modalItemForm();
        $('#itemId').val(0);
        $('#buttonSubmit').val('Enviar');
    }
    function modalItemForm(){
        $('#modalItem').addClass('modal--show');
    }
    function buscarItem( input ){
        modalItemForm();
        $('#estado').val( input.getAttribute('data-estado') );
        $('#nombre').val( input.getAttribute('data-nombre') );
        $('#cantidad').val( input.getAttribute('data-cantidad') );
        $('#presupuesto').val( input.getAttribute('data-presupuesto') );
        $('#itemId').val( input.getAttribute('data-id') );
        $('#buttonSubmit').val('Guardar Cambios');
    }

    function cerrarModal(){
        $('#modalItem').removeClass('modal--show');
    }

    function allowOnlyFloat(evt) {
        // Permitir: Backspace, Delete, Tab, Escape, Enter y .
        if ([46, 8, 9, 27, 13, 110, 190].indexOf(evt.keyCode) !== -1 ||
            // Permitir: Ctrl+A, Ctrl+C, Ctrl+V, Ctrl+X
            (evt.keyCode === 65 && (evt.ctrlKey === true || evt.metaKey === true)) ||
            (evt.keyCode === 67 && (evt.ctrlKey === true || evt.metaKey === true)) ||
            (evt.keyCode === 86 && (evt.ctrlKey === true || evt.metaKey === true)) ||
            (evt.keyCode === 88 && (evt.ctrlKey === true || evt.metaKey === true)) ||
            // Permitir: teclas de inicio y fin
            (evt.keyCode >= 35 && evt.keyCode <= 39)) {
            // Dejar funcionar el evento
            return;
        }
        // Asegurarse de que es un número
        if ((evt.shiftKey || (evt.keyCode < 48 || evt.keyCode > 57)) && (evt.keyCode < 96 || evt.keyCode > 105)) {
            evt.preventDefault();
        }
    }

    function validateFloatInput(input) {
        const value = input.value;
        const regex = /^[+-]?\d+(\.\d+)?$/;
        if (!regex.test(value)) {
            input.setCustomValidity("Por favor, ingrese un número decimal válido.");
        } else {
            input.setCustomValidity("");
        }
    }