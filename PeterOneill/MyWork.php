<?php
include "Navbar.php"; 
?>
    <h1 class="mb-3">My Work</h1>
    <div class="text-wrap justify-content-center align-items-start" id="pagetext"><p class="text-center m-0">placeholder words about work---------------------------------------------------------------</p>
    </div>
    <textarea class="form-control w-100 h-100 text-wrap" id="textedit"></textarea>
        <div class="d-flex justify-content-between mt-auto">
        <button class="custom-button btn btn-secondary" id="cancelbutton">Cancel</button>

        <div class="d-flex gap-2">
            <button class="custom-button btn btn-primary" id="editbutton">Edit</button>
            <button class="custom-button btn btn-success" id="confirmbutton">Confirm</button>
        </div>
    </div>

    <script>
        const pageText = document.getElementById('pagetext');
        const editText = document.getElementById('textedit');
        const cancelEvent = document.getElementById('cancelbutton');
        const editEvent = document.getElementById('editbutton');
        const confirmEvent = document.getElementById('confirmbutton');
        function cancel(pageText, editText) {
            pageText.style.display = "flex";
            editText.style.display = "none";
            confirmEvent.style.display = "none";
        }
        function edit(pageText, editText) {
            editEvent.style.display = "none";
            pageText.style.display = "none";
            editText.style.display = "flex";
            editText.value = pageText.innerHTML;
        }
        function confirm() {
            cancelEvent.style.display = "none";
            pageText.innerHTML = editText.value;
            pageText.style.display = "flex";
            editText.style.display = "none";
        }
        cancelEvent.addEventListener('click', () => cancel(pageText,editText));
        editEvent.addEventListener('click', () => edit(pageText,editText));
        confirmEvent.addEventListener('click', confirm);
        cancel(pageText, editText);
    </script>
    
<?php include_once "Footer.php"; ?>
