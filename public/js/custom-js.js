function togglePassword() {
    var x = document.getElementById("passworD");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}