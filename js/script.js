function logout() {
    console.log("izlogovan");
    $.get("logout.php", function () {
        window.location = "login.php";
      });
}
