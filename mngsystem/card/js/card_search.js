const full_search = document.querySelector('#patient-fullsearch-form');
const search_by_ID = document.querySelector('#patient-search-form');
const patient_ID = search_by_ID.querySelector('#patientID');
const patient_name = full_search.querySelector('#patientName');
const patient_phone = full_search.querySelector('#patientPhn');
const info = Array.from(document.querySelectorAll('.span-info'));
let error_tag = document.querySelector('.error-tag');

search_by_ID.addEventListener('submit', (event) => {
    event.preventDefault();
    patient_details = {
        'patient_ID': patient_ID.value,
        'form': 'ID_search'
    };
    let promise = $.post('../api/patient_search_api.php', patient_details);
    promise.then(resolve => {
        console.log(resolve);
        if (resolve['result'] === true) {
            window.location.href = `profile.php?id=${resolve[0]}`;
        } else {
            error_tag.style.transform = 'scale(1,1)';
        }
    }, err => {
        console.log(err);
        // display error
        // log error
    });
});

full_search.addEventListener('submit', (event) => {
    event.preventDefault();
    patient_details = {
        'patient_name': patient_name.value,
        'patient_tel': patient_phone.value,
        'form': 'fullname_search'
    };
    let promise = $.post('../api/patient_search_api.php', patient_details);
    promise.then(resolve => {
        console.log(resolve);
        if (resolve['result'] === true) {
            window.location.href = `profile.php?id=${resolve[0]}`;
        } else {
            // display error
        }
    }, err => {
        console.log(err);
        // display error
        // log error
    });
});

function hideForm(event, index) {
    event.target.parentElement.style.display = 'none';
    info[index].parentElement.style.display = "flex";
}

info[0].addEventListener('click', (event) => {
    hideForm(event, 1);
});

info[1].addEventListener('click', (event) => {
    hideForm(event, 0);
});

