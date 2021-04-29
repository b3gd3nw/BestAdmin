import Axios from "axios";

let notNum = /\d|[/?<>;:{}!@#$%^&*()+=]/;
let notAlpha = /[^a-zA-Z\s:\u00C0-\u00FF]/g;
let email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export function validateit() {
    let submit_btn = document.querySelector('#submit');
    let calendar = document.querySelector('.datetimepicker-dummy-input');
    if (calendar) {
        calendar.setAttribute('require', '');
    }
    if (submit_btn) {
        submit_btn.addEventListener('click', function(e) {
            e.preventDefault();
            let form = document.querySelector('#form');
            let inps = form.querySelectorAll("input, select, .tagsinput, .datetimepicker-dummy-input");
            inps.forEach(inp => {
                var errors = [];
                inp.getAttributeNames().forEach(attribute => {
                    switch (attribute) {
                        case 'require':
                            if (inp.value.length === 0) {
                                errors.push('This field is require');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'notnum':
                            if (notNum.test(inp.value)) {
                                errors.push('Only letters');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'notalpha':
                            if (notAlpha.test(inp.value)) {
                                errors.push('Only num');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'email':
                            if (!email.test(inp.value)) {
                                errors.push('Incorrect email');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'max20':
                            if (inp.value.length > 20) {
                                errors.push('Max length 20');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'min16':
                            if (inp.value.length < 12) {
                                errors.push('Enter full number');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'max6':
                            if (inp.value.length > 9) {
                                errors.push('Too large amount');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'money':
                            if (inp.value.length < 2) {
                                errors.push('This field require');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'reqtag':
                            if (inp.parentNode.querySelector('.tags') === null) {
                                errors.push('This field require');
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
                                    }
                                }
                            })
                            break;
                        case 'nodup':
                            let skills = document.querySelector('#tags').value.split(',');
                            if (checkIfDuplicateExists(skills)) {
                                errors.push('Each skill must be entered once!');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'unique':
                            let mail = inp.value;
                            let response = check(mail);

                            Promise.resolve(response).then(function(value) {
                                if (value['data']['exists'] === true) {
                                    errors.push('Email already in use!');
                                } else {
                                    valid(inp);
                                }
                            });



                            // let formData = new FormData();
                            // formData.append('email', mail);
                            // Axios.post('/api/email-check', formData).then(response => {
                            //     if (response['data']['exists'] === true) {
                            //         errors.push('Email already in use!');
                            //     } else {
                            //         valid(inp);
                            //     }

                            // });
                            break;
                    }
                });
                if (errors.length != 0) {
                    showError(errors, inp);
                    e.preventDefault();
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

const promiseFunction = new Promise((resolve, reject) => {
    var errors = [];
    inp.getAttributeNames().forEach(attribute => {
        switch (attribute) {
            case 'require':
                if (inp.value.length === 0) {
                    errors.push('This field is require');
                } else {
                    valid(inp);
                }
                break;
            case 'notnum':
                if (notNum.test(inp.value)) {
                    errors.push('Only letters');
                } else {
                    valid(inp);
                }
                break;
            case 'notalpha':
                if (notAlpha.test(inp.value)) {
                    errors.push('Only num');
                } else {
                    valid(inp);
                }
                break;
            case 'email':
                if (!email.test(inp.value)) {
                    errors.push('Incorrect email');
                } else {
                    valid(inp);
                }
                break;
            case 'max20':
                if (inp.value.length > 20) {
                    errors.push('Max length 20');
                } else {
                    valid(inp);
                }
                break;
            case 'min16':
                if (inp.value.length < 12) {
                    errors.push('Enter full number');
                } else {
                    valid(inp);
                }
                break;
            case 'max6':
                if (inp.value.length > 9) {
                    errors.push('Too large amount');
                } else {
                    valid(inp);
                }
                break;
            case 'money':
                if (inp.value.length < 2) {
                    errors.push('This field require');
                } else {
                    valid(inp);
                }
                break;
            case 'reqtag':
                if (inp.parentNode.querySelector('.tags') === null) {
                    errors.push('This field require');
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
                        }
                    }
                })
                break;
            case 'nodup':
                let skills = document.querySelector('#tags').value.split(',');
                if (checkIfDuplicateExists(skills)) {
                    errors.push('Each skill must be entered once!');
                } else {
                    valid(inp);
                }
                break;
            case 'unique':
                let mail = inp.value;
                let formData = new FormData();
                formData.append('email', mail);
                Axios.post('/api/email-check', formData).then(response => {
                    if (response['data']['exists'] === true) {
                        errors.push('Email already in use!');
                    } else {
                        valid(inp);
                    }
                });
                break;
        }
    })
})