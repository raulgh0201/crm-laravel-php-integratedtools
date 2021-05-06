window.onload = function() {
    let addContactBtn = document.getElementById('add-contact-btn');
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