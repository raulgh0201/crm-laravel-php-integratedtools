
window.addEventListener("load", showEditUserForm());
function showEditUserForm(){
    var editUserForm = document.getElementById('edit-details-modal');
    editUserForm.style.display = 'block';
    
}

function closeEditUserForm(){
    var editUserForm = document.getElementById('edit-details-modal');
    editUserForm.style.display = 'none';
}


/*console.log('abierto');
(function () {
    document.onload = () => {
        let openEditDetailsModal = document.getElementById("open-edit-details-modal");
        let editDetailsModal = document.getElementById("edit-details-modal");
        editDetailsModal.style.display = "none";

        openEditDetailsModal.onclick = () => {
            editDetailsModal.style.display = "block";

        }
    }
});*/