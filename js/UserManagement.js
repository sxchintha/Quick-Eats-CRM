var modal = document.getElementById("myModal"); // Popup form

var btn = document.getElementById("addNewButton"); // Add new user button

var span = document.getElementsByClassName("close")[0]; // <span> element that closes the modal

var editBtn = document.getElementById("editUser"); // Edit user button

var modalSID = document.getElementById("modelSID"); // SID row in the popup form

var modalNote = document.getElementById("modelNote"); // Note in the popup form

var btnAdd = document.getElementById("btnAdd"); // Add user button in the popup form

var btnUpdate = document.getElementById("btnUpdate"); // Update user button in the popup form

var btnDelete = document.getElementById("btnDelete"); // Delete user button in the popup form

var userForm = document.getElementById("userForm"); // Add/Update users form

var modelTitle = document.getElementById("modelTitle"); // Title of the popup form

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    modalSID.style.display = "none";
    modalNote.style.display = "block";

    btnAdd.style.display = "inline";
    btnUpdate.style.display = "none";
    btnDelete.style.display = "none";

    modelTitle.innerHTML = "Add new user";

    userForm.reset();
}

function setDetails(sid, name, address, pNo, email, nic) {
    document.getElementById("uSID").innerHTML = sid;
    document.getElementById("sendSID").value = sid; // To send the SID with form data
    document.getElementById("uName").value = name;
    document.getElementById("uAddress").value = address;
    document.getElementById("uTelNo").value = pNo;
    document.getElementById("uEmail").value = email;
    document.getElementById("uNIC").value = nic;
}

function editUser(sid, name, address, pNo, email, nic) {
    modal.style.display = "block";
    modalSID.style.display = "block";
    modalNote.style.display = "none";

    btnAdd.style.display = "none";
    btnUpdate.style.display = "inline";
    btnDelete.style.display = "none";

    modelTitle.innerHTML = "Update user details";

    window.setDetails(sid, name, address, pNo, email, nic);

}

function deleteUser(sid, name, address, pNo, email, nic) {
    modal.style.display = "block";
    modalSID.style.display = "block";
    modalNote.style.display = "none";

    btnAdd.style.display = "none";
    btnUpdate.style.display = "none";
    btnDelete.style.display = "inline";
    document.getElementById("btnClear").style.display = "none";

    modelTitle.innerHTML = "Remove user";

    window.setDetails(sid, name, address, pNo, email, nic);
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}