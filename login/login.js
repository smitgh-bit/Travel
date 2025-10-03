// Toggle Password Visibility
function togglePassword(id) {
    const input = document.getElementById(id);
    // Get the span which is the next element sibling of the input
    const icon = input.nextElementSibling.querySelector('i'); 

    // Check the current type of the input
    if (input.type === "password") {
        // Change type to text to show the password
        input.type = "text";
        // Change the icon to eye-slash
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        // Change type back to password to hide it
        input.type = "password";
        // Change the icon back to eye
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}