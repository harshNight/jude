// console.log(window.location.search.replace('?', '').trim());  // gets the url
// CONFIRM THE URL AND SET IT TO GLOBAL
const span_patientID = document.querySelector('#span_patientID').innerHTML.trim();
console.log(span_patientID);
let filterer = new RegExp(/^[A-Z]{3}-[A-Z]{3}-.+$/);
if (!filterer) {
    // return the user back to the index page;
} else {
    //check if the id exist in the database
    patient_details = {
        'patient_ID': span_patientID,
        'form': 'profile_search'
    };
    let promise = $.post('../api/patient_search_api.php', patient_details);
    promise.then(resolve => {
        console.log(resolve);
        if (resolve['result'] === true) {
            const td = Array.from(document.querySelectorAll('.profile-table td'));
            console.log(td.filter((e) => {
                if (e.id) {
                    if (e.id == 'firstname') {
                        e.innerHTML = resolve[0]['surname'].toUpperCase();
                    } else if (e.id == 'othernames') {
                        e.innerHTML = resolve[0]['othernames'];
                    } else if (e.id == 'p_phone') {
                        e.innerHTML = resolve[0]['phone'];
                    } else if (e.id == 'p_addr') {
                        e.innerHTML = resolve[0]['address'];
                    } else if (e.id == 'p_origin') {
                        e.innerHTML = `${resolve[0]['LGA']}, ${resolve[0]['state']}.`;
                    } else if (e.id == 'p_gender') {
                        e.innerHTML = resolve[0]['sex'];
                    } else if (e.id == 'p_m_status') {
                        e.innerHTML = resolve[0]['marital_status'];
                    } else if (e.id == 'p_birth') {
                        e.innerHTML = resolve[0]['DOB'];
                    } else if (e.id == 'p_occupation') {
                        e.innerHTML = resolve[0]['occupation'];
                    } else if (e.id == 'p_religion') {
                        e.innerHTML = resolve[0]['religion'];
                    } else if (e.id == 'c_cardtype') {
                        e.innerHTML = (resolve[0]['card_type'] == 1) ? 'Single' : (resolve[0]['card_type'] == 2) ? 'Admission' : 'Antenatal';
                    } else if (e.id == 'c_category') {
                        e.innerHTML = (resolve[0]['card_category'] == 1) ? 'Private' : 'family/copoorate';
                    } else if (e.id == 'd_created') {
                        e.innerHTML = resolve[0]['date_created'];
                    }
                }
            }
            ));
            // window.location.href = `profile.php?id=${resolve[0]}`;
        } else {
            // error_tag.style.transform = 'scale(1,1)';
        }
    }, err => {
        console.log(err);
        // display error
        // log error
    });
}

// FOR CREATING NEW APPOINTMENT
const b = document.querySelector('#create_case');
const appointment_response = document.querySelector('#appointment-response');
const appointment_section = document.querySelector('.appointment-section');
const htable = document.querySelector('#htable');
b.addEventListener('click', (event) => {
    if (confirm('are you sure')) {

        let p_id = { 'p_id': span_patientID };
        let promise = $.post('../api/appointment_api.php', p_id)
        promise.then(resolve => {
            for (let property in resolve) {
                if (resolve.hasOwnProperty(property)) {
                    if (property != 'case_id' && property != 'service') {
                        table_creator(resolve, property)
                    }
                }
            }
        }, err => {
            console.log(err);
            // REMEMBER TO WORK ON THE ERROR PART
        });
        b.setAttribute('disabled', '');
        htable.style.width = '100%';
        appointment_section.style.transform = 'scale(0,0)';
        appointment_response.style.transform = 'scale(1,1)';
        // SEND DATA TO SERVER TO CHECK FOR ANY OPENED APPOINTMENT ELSE CREATE NEW APPOINTMENT
        // SEND DATA TO SERVER FOR CREATING NEW APPOINTMENT
    } else {
        event.preventDefault();
    }

});

function table_creator(resolv, prope) {
    let tr = document.createElement('tr');
    let td1 = document.createElement('td');
    let td2 = document.createElement('td');
    let tdata2 = document.createTextNode(resolv[prope]);
    let sprope = changer(prope)
    let tdata = document.createTextNode(sprope);

    td1.append(tdata);
    td2.append(tdata2);
    tr.append(td1);
    tr.append(td2);
    htable.append(tr);
}
function changer(property) {
    switch (property) {
        case 'patient_id':
            return property = 'patient ID';
            break;
        case 'appointment_id':
            return property = 'Appointment ID';
            break;
        case 'status':
            return property = 'Position';
            break;
        case 'date_created':
            return property = 'Date created';
            break;
        default:
            break;
    }
}

