const message = document.getElementById('greeting');
message.textContent = 'Hello ' + getCookie('name');

const exitButton = document.getElementById('exit');
exitButton.onclick = function exit(){
    fetch('../php/exit.php')
    .then(()=>{
        window.location.href = '../';
        return;
    });
}

function getCookie(name) {
	var matches = document.cookie.match(new RegExp("(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"));
	return matches ? decodeURIComponent(matches[1]) : undefined;
}
 