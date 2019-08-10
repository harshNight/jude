const booking_form = document.querySelector('#appointmentForm');
const inputs = Array.from(booking_form.children);
const username = booking_form.querySelector('#username');


// inputs.forEach(items => {
//     if (items.type != 'submit') {
//         g[items.id] = items.value;
//         // console.log(items.id);

//     }
// })

// let sanitizeFormat = function (str, pattern) {
//     if (str.match(pattern)) {
//         return true;
//     }

// }
// function sanitizeUsername() {
//     return sanitizeFormat(username.value, /^[A-Za-z\s]+$/i);
// }
// function sanitizePhone() {
//     return sanitizeFormat(phone.value, /^\+[0-9]+|^[0]{1}[0-9]+$/)  // starts with + or 0
// }
// function sanitizeEmail() {
//     return sanitizeFormat(email.value, /^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z]{1,5}$/i)  // omokpo@gmail.com  jjeje@auchipoly.ok
// }
// function sanitizeBookingtype() {
//     return sanitizeFormat(booking_type.value, /^[A-Za-z]+$/i)  // omokpo@gmail.com  jjeje@auchipoly.ok
// }

let g = {
    username,
    phone,
    email,
    schedule_date,
    booking_type,
    sanitize: (str, pattern) => {
        if (str.match(pattern)) {
            return str;
        }
    }
};
Object.defineProperty(g, 'sanitize', {
    enumerable: false,
    configurable: true
})


booking_form.addEventListener('submit', function (e) {
    e.preventDefault();
    g.username = g.sanitize(username.value, /^[A-Za-z\s]+$/i);//sanitizeUsername();
    g.phone = g.sanitize(phone.value, /^\+[0-9]+|^[0]{1}[0-9]+$/);//sanitizePhone();
    g.email = g.sanitize(email.value, /^[A-Za-z0-9]+@[A-Za-z0-9]+\.[A-Za-z]{1,5}$/i);
    g.schedule_date = g.sanitize(schedule_date.value, /^[0-9\-]+$/i);
    g.booking_type = g.sanitize(booking_type.value, /^[A-Za-z]+$/i);
    for (let properties in g) {
        if (g[properties] == undefined) {
            let siblingSpan = this.querySelector(`#${properties}`).nextElementSibling;
            siblingSpan.classList.add('span-danger');
            siblingSpan.innerText = `${properties} not supported`;

            return false;
        }
    }
    delete g.sanitize;
    let promise = $.post('hth.php', g);
    promise.then(
        resolve => console.log(resolve),
        reject => console.log(reject)
    );
    console.log(g);
});

booking_form.addEventListener('click', function (e) {  // REMOVE THE SPAN WHEN AN INPUT IS CLICKED
    if (e.target.id != "appointmentForm" && e.target.id != "") {  // SUBMIT BUTTON IS = ""
        e.target.nextElementSibling.innerText = '';
    }
});