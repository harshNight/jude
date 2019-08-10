const card_form = document.querySelector('#card-form');
let phone = card_form.querySelector('#patient_phone');
const all_input = Array.from(card_form.querySelectorAll('input'));
const all_select = Array.from(card_form.querySelectorAll('select'));
const inputs = all_input.concat(all_select);
let form_data = {};  // used to hold all inputs after formating
const card_category = card_form.querySelector('#card_category');
let company_name = card_form.querySelector('#company_name');


// AS AN ASSIGNMENT, USE FILTER TO GET ALL THE CHILD ELEMENTS OF THE INPUT GROUP

const submit_btn = inputs.filter(items => {  // gets all elements that does not have an ID i.e button
    if (!items.id) {
        return true;
    }
});
let input = inputs.filter(items => {   // gets all elemnts that have id i.e inputs and select
    if (items.id) {
        return items.id;
    }
});



card_form.addEventListener('submit', (event) => {
    event.preventDefault();
    input.forEach((items) => {
        if (items.id == 'company_name') {
            form_data[items.id] = items.value.split(' ')[0];
        } else {
            form_data[items.id] = items.value;
        }

    });
    console.log(form_data);
    let promise = $.post('../api/personal_acct_api.php', form_data);
    promise.then(resolve => {
        console.log(resolve)
    }, err => {
        console.log(err)
    })
});

card_category.addEventListener('change', (event) => {

    if (event.target.value == 2) {
        let promise = $.get('../api/company_api.php');
        promise.then(resolve => {
            console.log(resolve[0]);
            if (company_name.childElementCount == 0) {  // prevents dublication of options whe another option is selected
                resolve[0].forEach(element => {
                    let optionTag = document.createElement('option');
                    optionTag.setAttribute('value', element);
                    let OptionLabel = document.createTextNode(element);
                    optionTag.appendChild(OptionLabel);
                    company_name.appendChild(optionTag);
                });
            }


        }, err => {
            console.log(err)
        })
    } else if (event.target.value == 2) {
        if (company_name.childElementCount != 0) {  // prevents dublication of options whe another option is selected
            company_name.removeChild();
        }
    }
});