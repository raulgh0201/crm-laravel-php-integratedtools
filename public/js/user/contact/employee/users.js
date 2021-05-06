window.addEventListener("load", mostrar);
function mostrar(){
    var x = document.getElementById('componente');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    }else{
        x.style.display = 'none';
    }
}
