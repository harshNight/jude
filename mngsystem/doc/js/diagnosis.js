const patientID = document.querySelector('#patient_ID');
const appointmentID = document.querySelector('#appointment_id');
const date_created = document.querySelector('#date_created');
const d_form = document.querySelector('#form_diagnosis');
let advise = document.querySelector('#advise');
const btn_reset = document.querySelector('#btn-reset');
const btn_submit = document.querySelector('#btn-submit');
const final_box = document.querySelector('.final');
const default_symptom_textarea = document.querySelector('#symptoms');
const default_diagnosis_textarea = document.querySelector('#diagnosis');
const btn_group = document.querySelector('#btn-group');
let old_textarea_value=''; // USED TO HOLD THE INITIAL VALUE OF DIAGNOSIS TEXTAREA BEFORE EDITING

window.addEventListener('load',()=>{
    let data = {
        // check for and sanitize the local storage
        'form': 'security',
        'appointment_id': localStorage.getItem('appointment_id')
    }
   let promise = $.post('../api/diagnosis_api.php', data);
   promise.then(resolve=>{
                if(resolve==false){
                    window.location.href="index.html";
                    return false;
                }
        // console.log(resolve);
        patientID.value = resolve['patient_ID'];
        appointmentID.value = resolve['appointment_id'];
        date_created.value = resolve['date_created']
        patientID.setAttribute('disabled', true);
        appointmentID.setAttribute('disabled', true);
        date_created.setAttribute('disabled', true);
        if(resolve['service'] !=2){
            
            // for symptoms textarea
            if(resolve['symptoms'] !=null){
                default_symptom_textarea.setAttribute('disabled',true);
                default_symptom_textarea.value = resolve['symptoms'];
                let btn_symp = document.querySelector('#btn_symptom');
                btn_symp.setAttribute('id', 'btn_symp_edit');
                btn_symp.innerText = "Edit";
            }
            

            // for diagnosis textarea
            if(resolve['diagnosis'] !=null){
                default_diagnosis_textarea.setAttribute('disabled',true);
                default_diagnosis_textarea.value = resolve['diagnosis'];
                let btn_diag = document.querySelector('#btn_diagnosis');
                btn_diag.setAttribute('id', 'btn_diag_edit');
                btn_diag.removeAttribute('disabled');
                advise.setAttribute('disabled', true);
                btn_diag.innerText = "Edit";
            }
        }
   },
   err=>{
       console.log(err);
   });
   promise =null; //async is still one threaded
   
});



// FOR CHANGING THE PRESCRIPTION STATE AND THE SAVE BUTTON
d_form.addEventListener('click',(event)=>{
    event.preventDefault();
    if(event.target.closest('button')){
        let symptomArea ;
        let span_alert;
        if(event.target.id =='btn_diagnosis'){
            symptomArea = event.target.parentElement.parentElement.previousElementSibling;
            span_alert =  event.target.parentElement.previousElementSibling;
        }else{
            symptomArea = event.target.parentElement.previousElementSibling;
            span_alert =  event.target.previousElementSibling;
        }
         // THIS IS FOR THE EDIT BUTTON TO DISABLE THE SYSMPTOM TEXTAREA
         if(event.target.id =='btn_symp_edit'){
            default_symptom_textarea.removeAttribute('disabled');
            event.target.setAttribute('id', 'btn_symptom');
            event.target.innerText = "Save";
            old_textarea_value = default_symptom_textarea.value;
             return false;
         }   
         
         if(event.target.id =='btn_diag_edit'){
            default_diagnosis_textarea.removeAttribute('disabled');
            event.target.setAttribute('id', 'btn_diagnosis');
            event.target.innerText = "Save";
            event.target.setAttribute('disabled', true);
            advise.removeAttribute('disabled');
            old_textarea_value = default_diagnosis_textarea.value;
             return false;
         } 
        if(symptomArea.value.length>7){
            const data = {
                'appointment_id': appointmentID.value,
                'symptoms': symptomArea.value,
                'sender':event.target.id
            };

                span_alert.style.display  = 'none';
                
                
                if(old_textarea_value != data.symptoms){
                    event.target.style.border='2px solid red';
                    event.target.setAttribute('disabled',true);
                    event.target.innerHTML = 'saving..';
                    // if old and new data are different
                    let promise =$.post('../api/diagnosis_api.php', data);
                        promise.then(resolve =>{
                                    if(resolve==1){
                                        setTimeout(function(){
                                        event.target.innerHTML = 'saved';
                                        event.target.style.backgroundColor = 'green';
                                        event.target.style.color='white';
                                        event.target.style.border='none';
                                        symptomArea.setAttribute('disabled', true);
                                        symptomArea.style.height = '50px';
                                        },1500);
                                    }   
                            },
                            err=>{
                                console.log(err)
                            }
                        );
                }else{
                    event.target.innerHTML = 'No change made';
                    event.target.setAttribute('disabled',true);
                    setTimeout(function(){
                        event.target.innerHTML = 'save';
                        },1500);
                }

                if(data.sender =='btn_diagnosis'){
                    event.target.previousElementSibling.setAttribute('disabled', true);
                    btn_reset.removeAttribute('disabled');
                    btn_submit.removeAttribute('disabled');
                        if(advise.value == 2){
                            final_box.classList.add('show-final');
                        }
                        if(advise.value == 1){
                            event.target.innerHTML = 'saving';
                        }
                }
                
                
                   
        }else{
           span_alert.style.display = 'block';
        }       
    }
});

advise.addEventListener('change', (event)=>{
    if(event.target.value !=0){
        // enable the save button and exit button at the button
        event.target.nextElementSibling.removeAttribute('disabled');
         if(event.target.value==2){
             // increase the final height by adding the show-final class
          }
    }else{
        // disabled the save diagnosis button and the save & reset button
        event.target.nextElementSibling.setAttribute('disabled', true);
        btn_reset.setAttribute('disabled', true);

    }
  
});

btn_reset.addEventListener('click', (event)=>{
    if(!confirm('Do you want to delete this appointment from record?') ){
        return false;
    }
    let data = {
        // check for and sanitize the local storage
        'form': 'terminate',
        'appointment_id': appointmentID.value
    }
   let promise = $.post('../api/diagnosis_api.php', data);
   promise.then(resolve=>{
                    if(resolve==false){
                        // DEAL WITH THE ERROR OF NOT DELETING THE APPOINTMENT
                    }else{
                        window.location.href="index.html";
                    }
                },
                err=>{
                    console.log(err);
                }
            );
});

btn_submit.addEventListener('click', (event)=>{
    window.location.href="index.html";
});