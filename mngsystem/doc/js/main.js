const case_table = document.querySelector('#case_table');
const case_tbody = document.querySelector('#case_tbody');

window.addEventListener('load', function () {
    data = {
        'appointment_form': ''
    }

    let promise = jQuery.get('../api/all_patient_api.php', data);
    let count = 0;
    const actions = ['Profile', 'History', 'Proceed'];
    promise.then(
        resolve => {
            console.log(resolve);
            resolve.forEach(element => {
                count++;
                let tr = document.createElement('tr');
                let td = document.createElement('td');
                let sn = document.createTextNode(count);
                td.appendChild(sn);
                tr.append(td);
                for (elem in element) {
                    let td = document.createElement('td');
                    let nodeText = document.createTextNode(element[elem].toUpperCase());
                    td.appendChild(nodeText);
                    tr.append(td);
                };

                actions.forEach(ele => {
                    let td = document.createElement('td');
                    let btn_ = document.createElement('a');
                    btn_.classList.add('btn_action');
                    if (ele == 'Profile') {
                        btn_.classList.add('btn-profile');
                        btn_.setAttribute('href', 'profile.html');
                        btn_.setAttribute('id', element['appointment_id']);
                    } else if (ele == 'History') {
                        btn_.classList.add('btn-history');
                        btn_.setAttribute('href', 'history.html');
                        btn_.setAttribute('id', element['appointment_id']);
                    } else if (ele == 'Proceed') {
                        btn_.classList.add('btn-proceed');
                        btn_.setAttribute('href', 'proceed.html');
                        btn_.setAttribute('id', element['appointment_id']);

                    }
                    let btn_nodeText = document.createTextNode(ele);
                    btn_.appendChild(btn_nodeText);
                    td.appendChild(btn_);
                    tr.append(td);
                });
                case_tbody.append(tr);
            });
        },
        err => {
            console.log(err+ 'THERE WAS AN ERORSSS');
        }
    );

});

case_tbody.addEventListener('click', (event) => {
    event.preventDefault();
    if (event.target.closest('a')) { // checks if the target is inside an a tag or if it is null
        let appointment_id = event.target.id;
        if (localStorage.getItem('appointment_id') != appointment_id) { // appoinment id changes, update localstorage;
            localStorage.setItem('appointment_id', event.target.id);
        }
        location.href = event.target.href;  // move the page to the anchor href value
    }
})

