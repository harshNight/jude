
const id_search_link = document.querySelector('#id-search-link');
const id_search_form = document.querySelector('#id_search_form');
const full_search_link = document.querySelector('#full-search-link');
const full_search_form = document.querySelector('.full-search-form');
const productID_form = document.querySelector('#id_search_form');
const btn_check_profile = productID_form.querySelector('#btn-check-profile');
const productID = productID_form.querySelector('#patient_id').value;



full_search_link.addEventListener('click', (e) => {
    e.target.parentElement.classList.add('hide');
    full_search_form.classList.remove('hide');
});

id_search_link.addEventListener('click', (e) => {
    e.target.parentElement.classList.add('hide');
    id_search_form.classList.remove('hide');
});

productID_form.addEventListener('submit', (e) => {
    window.location.href = "profile.html";
    e.preventDefault();
});