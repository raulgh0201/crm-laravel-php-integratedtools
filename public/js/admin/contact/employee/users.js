//Anterior
/*window.addEventListener("load", mostrar);
function mostrar(){
    var x = document.getElementById('componente');
    if (x.style.display === 'none') {
        x.style.display = 'block';
    }else{
        x.style.display = 'none';
    }
}*/

window.onload = function() {
    let addContactBtn = document.getElementById('show-new-user-form');
    let addContactModal = document.getElementById('add-contact-modal');
    let closeContactModal = document.getElementsByClassName('close-modal');
    let modalStyle = document.getElementsByClassName('modal-style');

    addContactModal.style.display = 'none';

    addContactBtn.onclick = () => {
        if(addContactModal.style.display == 'none'){
            addContactModal.style.display = 'block';
        }else{
            addContactModal.style.display = 'none';
        }
    }

    for(let i = 0; i < closeContactModal.length; i++){
        closeContactModal[i].onclick = () => {
            for(let x = 0; x < modalStyle.length; x++){
                modalStyle[x].style.display = 'none';
            }
        }

    }
}

