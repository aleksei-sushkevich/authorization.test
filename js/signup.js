const signupForm = document.forms.signup_form;

const signupButton = document.getElementById('create_account');

signupButton.onclick = function signup(event){
    event.preventDefault();

    const obj = {
        login : signupForm.elements.login.value,
        password : signupForm.elements.password.value,
        password_confirm : signupForm.elements.password_confirm.value,
        email : signupForm.elements.email.value,
        name : signupForm.elements.name.value
    };

    fetch('../php/signup.php', {method : 'POST', body : JSON.stringify(obj)})
    .then(response=>response.json()).then(result=>{
        if(result.message === "success"){
            window.location.href = '../success';
            return;
        }
        for(let message in result){
            const spanMessage = document.getElementById(message);
            if(spanMessage){
               spanMessage.textContent = result[message];
            }
        }
    });
}
