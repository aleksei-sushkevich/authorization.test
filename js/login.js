const authForm = document.forms.auth_form; 

const button = document.getElementById('log_in');


button.onclick = function logIn(event){
    event.preventDefault();
    const login = authForm.elements.login.value;
    const password = authForm.elements.password.value;
    const loginMsg = document.getElementById('login_msg');
    const passwordMsg = document.getElementById('password_msg');

    loginMsg.textContent = login === '' ? 'The field cannot be empty' : '';
    passwordMsg.textContent = password === '' ? 'The field cannot be empty' : '';

    if(login === '' || password === ''){
        return;
    }

    const obj = {
        login : login,
        password : password
    };

    fetch('../php/login.php', {method : 'POST', body : JSON.stringify(obj)})
    .then(response=>response.json()).then(result=>{
        if(result.message === "success"){
            window.location.href = '../success';
            return;
        }
        if(result.message === 'unsuccess login'){
            loginMsg.textContent = 'Incorrect login';
            return;
        }
        if(result.message === 'unsuccess password'){
            passwordMsg.textContent = 'Incorrect password';
            return;
        }
    });
}