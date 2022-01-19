var modal = document.getElementById("myModal"); // Popup form

var btn = document.getElementById("addNewButton"); // Add new user button

var span = document.getElementsByClassName("close")[0]; // <span> element that closes the modal

var editBtn = document.getElementById("editUser"); // Edit user button

var modalSID = document.getElementById("modalSID"); // SID row in the popup form

var modalNote = document.getElementById("modalNote"); // Note in the popup form

var btnAdd = document.getElementById("btnAdd"); // Add user button in the popup form

var btnUpdate = document.getElementById("btnUpdate"); // Update user button in the popup form

var btnDelete = document.getElementById("btnDelete"); // Delete user button in the popup form

var btnClear = document.getElementById("btnClear"); // Clear form button

var userForm = document.getElementById("userForm"); // Add/Update users form

var modalTitle = document.getElementById("modalTitle"); // Title of the popup form


// Set which buttons and the title to show in the from
function addUserButton() {
    modal.style.display = "block";
    modalSID.style.display = "none";
    modalNote.style.display = "block";

    btnAdd.style.display = "inline";
    btnUpdate.style.display = "none";
    btnDelete.style.display = "none";
    btnClear.style.display = "inline";

    modalTitle.innerHTML = "Add new user";

    userForm.reset();
}

function editUserButton() {
    modal.style.display = "block";
    modalSID.style.display = "block";
    modalNote.style.display = "none";

    btnAdd.style.display = "none";
    btnUpdate.style.display = "inline";
    btnDelete.style.display = "none";
    btnClear.style.display = "inline";

    modalTitle.innerHTML = "Update user details";
}

function deleteUserButton() {
    modal.style.display = "block";
    modalSID.style.display = "block";
    modalNote.style.display = "none";

    btnAdd.style.display = "none";
    btnUpdate.style.display = "none";
    btnDelete.style.display = "inline";
    btnClear.style.display = "none";

    modalTitle.innerHTML = "Remove user";
}


// Set selected user's info in the form
function addSP() {
    window.addUserButton();
}

function setDetailsSP(sid, name, address, pNo, email, nic) {
    document.getElementById("uSID").innerHTML = sid;
    document.getElementById("sendSID").value = sid; // To send the SID with form data
    document.getElementById("uName").value = name;
    document.getElementById("uAddress").value = address;
    document.getElementById("uTelNo").value = pNo;
    document.getElementById("uEmail").value = email;
    document.getElementById("uNIC").value = nic;
}

function editUserSP(sid, name, address, pNo, email, nic) {
    window.editUserButton();
    window.setDetailsSP(sid, name, address, pNo, email, nic);

}

function deleteUserSP(sid, name, address, pNo, email, nic) {
    window.deleteUserButton();
    window.setDetailsSP(sid, name, address, pNo, email, nic);
}


// Set selected customer's info in the form
function addCus() {
    window.addUserButton();
    modalNote.style.display = "none";
}

function setDetailsCus(name, address, pNo, email) {
    document.getElementById("uName").value = name;
    document.getElementById("uAddress").value = address;
    document.getElementById("uTelNo").value = pNo;
    document.getElementById("uEmail").value = email;
    document.getElementById("currentTel").value = pNo; // To send the current telNo with form data
}

function editUserCus(name, address, pNo, email) {
    window.editUserButton();
    window.setDetailsCus(name, address, pNo, email);
    modalSID.style.display = "none";
    modalNote.style.display = "none";

}

function deleteUserCus(name, address, pNo, email) {
    window.deleteUserButton();
    window.setDetailsCus(name, address, pNo, email);
    modalSID.style.display = "none";
    modalNote.style.display = "none";
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