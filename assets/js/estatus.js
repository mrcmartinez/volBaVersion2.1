function confirmBaja() {
    var respuesta = confirm("Esta seguro de realizar el cambio?");
    if (respuesta==true) {
        return true;
    }else{
        return false;
    }
}