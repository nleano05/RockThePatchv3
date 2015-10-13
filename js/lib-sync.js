function syncLoginForms() {
    var loginForm = document.getElementsByName("login-form");
    if(loginForm.length > 0) {
        var userNameOrEmailLoginForm1 = loginForm[0].elements['login-user-name-or-email'];
        var userNameOrEmailLoginForm2 = loginForm[1].elements['login-user-name-or-email'];
        var passwordLoginForm1 = loginForm[0].elements['login-password'];
        var passwordLoginForm2 = loginForm[1].elements['login-password'];

        if(typeof userNameOrEmailLoginForm1 != "undefined" && typeof userNameOrEmailLoginForm2 != "undefined") {
            userNameOrEmailLoginForm1.onchange = function() {
                userNameOrEmailLoginForm2.value = userNameOrEmailLoginForm1.value;
            };

            userNameOrEmailLoginForm2.onchange = function() {
                userNameOrEmailLoginForm1.value = userNameOrEmailLoginForm2.value;
            };
        }

        if(typeof passwordLoginForm1 != "undefined" && typeof passwordLoginForm2 != "undefined") {
            passwordLoginForm1.onchange = function() {
                passwordLoginForm2.value = passwordLoginForm1.value;
            };

            passwordLoginForm2.onchange = function()
            {
                passwordLoginForm1.value = passwordLoginForm2.value;
            };
        }
    }
}