window.onload = function() {
    let addClientBtn = document.getElementById('add-client-btn');
    let addClientModal = document.getElementById('add-client-modal');
    let closeClientModal = document.getElementsByClassName('close-modal');
    let modalStyle = document.getElementsByClassName('modal-style');

    addClientModal.style.display = 'none';

    addClientBtn.onclick = () => {
        if(addClientModal.style.display == 'none'){
            addClientModal.style.display = 'block';
        }else{
            addClientModal.style.display = 'none';
        }
    }

    for(let i = 0; i < closeClientModal.length; i++){
        closeClientModal[i].onclick = () => {
            for(let x = 0; x < modalStyle.length; x++){
                modalStyle[x].style.display = 'none';
            }
        }

    }
}