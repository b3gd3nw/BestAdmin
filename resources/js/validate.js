import Axios from "axios";

let notNum = /\d|[/?<>;:{}!@#$%^&*()+=]/;
let notAlpha = /[^a-zA-Z\s:\u00C0-\u00FF]/g;
let email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;



export function validateit() {
    let is_exist = false;
    let submit_btn = document.querySelector('#submit');
    let calendar = document.querySelector('.datetimepicker-dummy-input');
    if (calendar) {
        calendar.setAttribute('require', '');
    }
    if (submit_btn) {
        let mail = form.querySelector('input[name="email"]');
        mail.addEventListener('change', function(e) {
            mailCheck(mail).then(data => {
                is_exist = data;
            })
        })
        submit_btn.addEventListener('click', function(e) {
            var counter = 0;
            let form = document.querySelector('#form');
            let inps = form.querySelectorAll("input, select, .tagsinput, .datetimepicker-dummy-input");
            inps.forEach(inp => {
                let errors = [];
                inp.getAttributeNames().forEach(attribute => {
                    switch (attribute) {
                        case 'require':
                            if (inp.value.length === 0) {
                                errors.push('This field is require');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'notnum':
                            if (notNum.test(inp.value)) {
                                errors.push('Only letters');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'notalpha':
                            if (notAlpha.test(inp.value)) {
                                errors.push('Only num');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'email':
                            if (!email.test(inp.value)) {
                                errors.push('Incorrect email');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'max20':
                            if (inp.value.length > 20) {
                                errors.push('Max length 20');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'min16':
                            if (inp.value.length < 12) {
                                errors.push('Enter full number');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'max6':
                            if (inp.value.length > 9) {
                                errors.push('Too large amount');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'money':
                            if (inp.value.length < 2) {
                                errors.push('This field require');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'reqtag':
                            if (inp.parentNode.querySelector('.tags') === null) {
                                errors.push('This field require');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'taglength':
                            let childs = inp.nextSibling.childNodes;
                            let i = 0;
                            childs.forEach(child => {
                                if (child.classList.contains('control')) {
                                    i++;
                                    if (child.getAttribute('data-tag').length > 15) {
                                        errors.push(`Too long tag №${i}`);
                                        counter++;
                                    }
                                }
                            })
                            break;
                        case 'nodup':
                            let skills = document.querySelector('#tags').value.split(',');
                            if (checkIfDuplicateExists(skills)) {
                                errors.push('Each skill must be entered once!');
                                counter++;
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'unique':
                            if (is_exist === true) {
                                errors.push('Email already in use!');
                                counter++;
                            } else {
                                valid(inp);
                            }
                    }
                });
                if (errors.length != 0) {
                    e.preventDefault();
                    showError(errors, inp);
                }
            });
        });
    }
}

function showError(errors, inp) {
    if (inp.parentNode.querySelector('.tagsinput')) {
        inp.parentNode.querySelector('.tagsinput').classList.add('is-danger');
    } else {
        inp.classList.add('is-danger');
    }
    if (errors[0] != null) {
        let parent = inp;
        while (!parent.classList.contains('control')) {
            parent = parent.parentNode;
        }
        parent.querySelector('.error').innerHTML = errors[0];
    }
}

function valid(inp) {
    if (inp.parentNode.querySelector('.tagsinput')) {
        inp.parentNode.querySelector('.tagsinput').classList.remove('is-danger');
        inp.parentNode.querySelector('.tagsinput').classList.add('is-success');
    } else {
        inp.classList.remove('is-danger');
        inp.classList.add('is-success');
    }
    let parent = inp;
    while (!parent.classList.contains('control')) {
        parent = parent.parentNode;
    }
    parent.querySelector('.error').innerHTML = '';
}

function checkIfDuplicateExists(w) {
    return new Set(w).size !== w.length
}

function makeRequest(mail) {
    return new Promise(function(resolve) {
        let formData = new FormData();
        formData.append('email', mail.value);
        Axios.post('/api/email-check', formData)
            .then(response => {
                let is_exist = response['data']['exists'];
                resolve(is_exist)
            })
    });
}

async function mailCheck(mail) {
    return await makeRequest(mail);
}