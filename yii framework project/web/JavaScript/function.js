function storeInfo() {
    if (document.getElementById('RememberMe').checked === true) {
        window.localStorage.username = document.getElementById('name').value;
        window.localStorage.password = document.getElementById('password').value;
    } else {
        window.localStorage.clear();
    }
}

function preFilled() {
        document.getElementById('name').value = window.localStorage.getItem('username');
        document.getElementById('password').value=window.localStorage.getItem('password');
}

