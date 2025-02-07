document.getElementById("edit-twit-submit").addEventListener("click", function (event) {
    let inputs = document.querySelectorAll("input, textarea");
    let isValid = true;

    inputs.forEach((input) => {
        if (input.value.trim() === "") {
            isValid = false;
            input.style.border = "2px solid red";
        } else {
            input.style.border = "";
        }
    });

    if (!isValid) {
        event.preventDefault();
        alert("Please fill in all fields!");
    } else {
        alert("Twit was changed successfully!")
    }
});