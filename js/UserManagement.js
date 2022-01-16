var modal = document.getElementById("myModal"); // Popup form

var btn = document.getElementById("addNewButton"); // Add new user button

var span = document.getElementsByClassName("close")[0]; // <span> element that closes the modal

var editBtn = document.getElementById("editUser"); // Edit user button

var modalSID = document.getElementById("modelSID"); // SID row in the popup form

var modalNote = document.getElementById("modelNote"); // Note in the popup form

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
    modalSID.style.display = "none";
    modalNote.style.display = "block";
    document.getElementById("uName").value = "";
    document.getElementById("uAddress").value = "";
    document.getElementById("uTelNo").value = "";
    document.getElementById("uEmail").value = "";
    document.getElementById("uNIC").value = "";
}

function editUser(sid, name, address, pNo, email, nic) {
    modal.style.display = "block";
    modalSID.style.display = "block";
    modalNote.style.display = "none";
    document.getElementById("uSID").innerHTML = sid;
    document.getElementById("uName").value = name;
    document.getElementById("uAddress").value = address;
    document.getElementById("uTelNo").value = pNo;
    document.getElementById("uEmail").value = email;
    document.getElementById("uNIC").value = nic;
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