window.addEventListener("load", showEditContactForm());
function showEditContactForm(){
    var editUserForm = document.getElementById('edit-details-contact');
    editUserForm.style.display = 'block';
    
}

function closeEditContactForm(){
    var editUserForm = document.getElementById('edit-details-contact');
    editUserForm.style.display = 'none';
}