let require = /^$|\s+/;
let notNum = /\d|[/?<>;:{}!@#$%^&*()+=]/;
let notAlpha = /[^a-zA-Z\s:\u00C0-\u00FF]/g;
let email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



export function validateit() {
    let submit_btn = document.querySelector('#submit');
    let span = document.querySelector('.span');
    if(submit_btn) {
        submit_btn.addEventListener('click', function (e){
            e.preventDefault();
            let inps = document.querySelectorAll("input, select");
            inps.forEach(inp => {
                let errors = [];
                inp.getAttributeNames().forEach(attribute => {
                    switch (attribute) {
                        case 'require':
                          if (require.test(inp.value)) {
                              errors.push('This field is require');
                              // notValid(inp, span, 'This field is require');
                          } else {
                              valid(inp, span);
                          }
                          break;
                        case 'notnum':
                          if (notNum.test(inp.value)) {
                              errors.push('Only letters');
                              // notValid(inp, span, 'Only letters');
                          } else {
                              valid(inp, span);
                          }
                          break;
                        case 'notalpha':
                            if (notAlpha.test(inp.value)) {
                                errors.push('Only num');
                                // notValid(inp, span, 'Only letters');
                            } else {
                                valid(inp, span);
                            }
                            break;
                        case 'email':
                            if (!email.test(inp.value)) {
                                errors.push('Incorrect email');
                            } else {
                                valid(inp, span);
                            }
                            break;
                        case 'max20':
                            if (inp.value.length > 20) {
                                errors.push('Max length 20');
                            } else {
                                valid(inp, span);
                            }
                            break;
                        case 'min16':
                            if (inp.value.length < 16) {
                                errors.push('Enter full number');
                            } else {
                                valid(inp, span);
                            }
                            break;
                        case 'max6':
                            if (inp.value.length > 6) {
                                errors.push('Max length 6');
                            } else {
                                valid(inp, span);
                            }
                            break;
                        case 'money':
                            if (inp.value.length < 2) {
                                errors.push('This field require');
                            } else {
                                valid(inp, span);
                            }
                            break;
                    }
               });
               if (errors.length != 0) {
                   showError(errors, inp);
               }
            });
        });
    }
}

function showError(errors, inp) {
    inp.classList.add('is-danger');
    let spanTag = document.createElement('span');
    spanTag.classList.add('red');
    if(!inp.parentNode.querySelector('span')){
        inp.parentNode.insertBefore(spanTag, inp.nextSibling);
        if (errors[0] != null){
            spanTag.innerHTML = errors[0];
        }
    } else {
        if (errors[0] != null){
            inp.parentNode.querySelector('span').innerHTML = errors[0];
        }
    }
}

function valid(inp) {
    inp.classList.remove('is-danger');
    inp.classList.add('is-success');
    if(inp.parentNode.querySelector('span')) {
        inp.parentNode.querySelector('span').remove();
    }
}