const loginForm = document.querySelector('.login-form');
const username = loginForm.querySelector('#username').value;
const password = loginForm.querySelector('#password').value;
const alertError = document.querySelector('.alert')
const responseDiv = document.querySelector('.response');

function transferMsg(data) {
    let errorBox = document.createElement('h4');
    let msg = document.createTextNode(data);
    errorBox.appendChild(msg);
    responseDiv.appendChild(errorBox);
}
// CREATE A FUNCTION TO LOG ERROR TO YOUR ERROR FILE

loginForm.addEventListener('submit', (event) => {
    const username = loginForm.querySelector('#username').value;
    const password = loginForm.querySelector('#password').value;
    let userlogin = {
        'username': username,
        'pwd': password
    };
    let promise = $.post('./api/loginapi.php', userlogin);
    promise.then(resolve => {
        if (resolve.response == 'success') {
            window.location = "./card/index.php";
        } else {
            if (!responseDiv.querySelector('h4')) {
                transferMsg('incorrect username/password');
            }

        }
    },
        err => {
            console.log(err)
            transferMsg('OPERATION FAILED');
        }
    );
    // console.log(promise);
    event.preventDefault();
})