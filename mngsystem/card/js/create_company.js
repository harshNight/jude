const company_form = document.querySelector('#create-company-form');
const company_name = company_form.querySelector('#company_name');
const company_addr = company_form.querySelector('#company_addr');
const company_phone = company_form.querySelector('#company_phone');
const company_btn = company_form.querySelector('#company_btn');
// CREATE COMPANY FORM

company_form.addEventListener('submit', (event) => {
    event.preventDefault();
    company_details = {
        'company_name': company_name.value,
        'company_addr': company_addr.value,
        'company_phone': company_phone.value
    }
    let promise = $.post('../api/create_company_api.php', company_details);
    promise.then(resolve => {
        console.log(resolve);
        company_btn.setAttribute('disable', true);
        // check for the response Text before you redirect

        setTimeout(() => {
            window.location.href = './p_acct.php';
        }, 10000);

    },
        err => {
            console.log(err);
        })
})


