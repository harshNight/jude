const listItems = document.querySelectorAll('.service-list-items li ');
const departmentImg = document.querySelector('#documentImg');
const departmentWriteUp = document.querySelector('#departmentWriteUp');
const userform = document.querySelector('#appointmentForm');
const allLists = document.querySelectorAll('.plus'); // WORKS ON THE INDIVIDUAL TABS
const appointmentBtn = document.querySelector('.mobile-appointment-btn'); //GETS THE APPOINTMENT BUTTON IN MOBILE VIEW
const mobileFormClose = document.querySelector('.mobile-appointment-form-close'); // CLOSES THE MOBILE APPOINTMENT FORM
const mobileAppointment = document.querySelector('.mobile-appointment'); // THIS THE MOBILE APPOINMENT FORM

// WORKS ON SUBSCRIPTION
const subscription_form = document.querySelector('.subscribe'); // subscription format the bottom of the page
const subscription_message = document.querySelector('.processing');

function subscribe(e) {
    e.target.style.display = 'none'; // move the subscription form out of view
    subscription_message.style.textAlign = "center";
    subscription_message.innerText = "Subscription was succcessful";
    setTimeout(function () { subscription_message.style.display = "none"; }, 2000);
    e.preventDefault();
}
subscription_form.addEventListener('submit', subscribe);

// END OF SUBSCRIPTION CODE

// illums notifications
const illums = document.querySelector('.i-flashes');
const headerSection = document.querySelector('.header-frame');
const headerDimention = headerSection.getBoundingClientRect();
const headerWidth = headerDimention.width * 0.89;
const headerHeight = headerDimention.height * 0.8;

const iflashContent = ['Best in Surgery', 'Best in maternity', 'Best in dental health'];
let currentFlashContent = 0;
function changePosition() {
    illums.style.opacity = 0;
    const flashRight = Math.floor(Math.random() * headerWidth);
    let flashTop = Math.floor(Math.random() * headerHeight);
    if (flashTop >= headerHeight) {
        flashTop -= headerHeight;
    }
    let flashRed = Math.floor(Math.random() * 255);
    let flashGreen = Math.floor(Math.random() * 255);
    let flashBlack = Math.floor(Math.random() * 255);
    illums.style.right = flashRight + 'px';
    illums.style.top = flashTop + 'px';
    illums.style.opacity = 1;
    illums.style.fontWeight = "bold";
    illums.style.border = `1px solid rgb(${flashRed},${flashGreen},${flashBlack})`;
    illums.innerText = iflashContent[currentFlashContent];
    currentFlashContent++;
    if (currentFlashContent >= iflashContent.length) {
        currentFlashContent = 0;
    }


}
setInterval(changePosition, 5000);

// end of illums notification

// MINI MENU STARTS HERE

const menu = document.querySelector('.hamburger-wrapper');
const navContent = document.querySelector('.navigation-wrapper');

function menuHider() {
    navContent.classList.toggle('navigation-wrapper__hider');
}

menu.addEventListener('click', menuHider);
//MINI MENE ENDS HERE



//the cbn
// doctor-div
// buttons
//current-slider
const track = document.querySelector('.cbn');
const slider = Array.from(track.querySelectorAll('.doctor-div'));
const arrowLeft = document.querySelector(".doctor-arrow-left");
const arrowRight = document.querySelector(".doctor-arrow-right");
let currentSlide = track.querySelector(".current-slider");
let slideSize = slider[0].getBoundingClientRect().width;

function slidePosition(slide, index) {
    slide.style.left = slideSize * index + 'px';
}
slider.forEach(slidePosition);

arrowRight.addEventListener('click', (event) => {
    if (!currentSlide.nextElementSibling) {
        event.target.classList.remove("show-arrow");
        event.target.classList.add("hide-arrow");
        return 0;
    }
    if (arrowLeft.classList.contains("hide-arrow")) {
        arrowLeft.classList.toggle("hide-arrow");
    }
    currentSlide.classList.remove("current-slider");
    currentSlide = currentSlide.nextElementSibling;
    currentSlide.classList.add("current-slider");
    track.style.transform = "translateX(-" + currentSlide.style.left + ")";
});

arrowLeft.addEventListener('click', (event) => {
    if (arrowRight.classList.contains("hide-arrow")) {
        arrowRight.classList.toggle("hide-arrow");
    }
    if (!currentSlide.previousElementSibling) {
        event.target.classList.remove("show-arrow");
        event.target.classList.add("hide-arrow");
        return 0;
    }
    currentSlide.classList.remove("current-slider");
    currentSlide = currentSlide.previousElementSibling;
    currentSlide.classList.add("current-slider");
    track.style.transform = "translateX(-" + currentSlide.style.left + ")";
});


appointmentBtn.addEventListener('click', (event) => {
    event.target.classList.add('mobile-hide-state');
    mobileAppointment.classList.add('mobile-show-state');
});

mobileFormClose.addEventListener('click', () => {
    mobileAppointment.classList.remove('mobile-show-state');
    appointmentBtn.classList.remove('mobile-hide-state');
});




function shout(e) {
    removeBorder(e);
    departmentImg.removeAttribute("src");
    departmentImg.
        departmentImg.setAttribute('src', `../img/${colors[e.target.id]}.jpg`);
    departmentWriteUp.innerHTML = writeups[e.target.id];
    e.target.classList.add('dept-active');
    e.preventDefault();
}

function removeBorder(e) {
    listItems.forEach(items => items.classList.remove('dept-active'));
}
listItems.forEach(items => items.addEventListener('click', shout));

allLists.forEach(items => items.addEventListener('click', (e) => {
    let tabstatus = e.target.nextElementSibling;
    let originalTarget = e.target;
    // console.log(e.target);
    if (originalTarget.classList.contains("fa-plus")) {
        originalTarget.classList.replace("fa-plus", "fa-minus");
        tabstatus.classList.remove("hide-service");
    } else {
        originalTarget.classList.replace("fa-minus", "fa-plus");
        tabstatus.classList.add("hide-service");
    }
}));


// the CNB DIV HAS AABSLUTE CHILD POSITIONING AND THUS AFFECTS THE HEIGHT

let cbnHeight = document.querySelector('.cbn');
const doctorDiv = Array.from(document.querySelectorAll('.doctors-profile'))[0];
cbnHeight.style.height = doctorDiv.getBoundingClientRect().right + "px";