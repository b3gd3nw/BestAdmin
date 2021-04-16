//let require = /^$|/;
let notNum = /\d|[/?<>;:{}!@#$%^&*()+=]/;
let notAlpha = /[^a-zA-Z\s:\u00C0-\u00FF]/g;
let email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

export function validateit() {
    let submit_btn = document.querySelector('#submit');
    let span = document.querySelector('.span');
    let calendar = document.querySelector('.datetimepicker-dummy-input');
    if (calendar) {
        calendar.setAttribute('require', '');
    }
    if(submit_btn) {
        submit_btn.addEventListener('click', function (e){
            let inps = document.querySelectorAll("input, select, .tagsinput, .datetimepicker-dummy-input");
            inps.forEach(inp => {
                let errors = [];
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
                            if (inp.value.length < 16) {
                                errors.push('Enter full number');
                            } else {
                                valid(inp);
                            }
                            break;
                        case 'max6':
                            if (inp.value.length > 6) {
                                errors.push('Max length 6');
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
        while (!parent.classList.contains('control'))
        {
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
    while (!parent.classList.contains('control'))
    {
        parent = parent.parentNode;
    }
    parent.querySelector('.error').innerHTML = '';
    // inp.parentNode.querySelector('.error').innerHTML = '';

}




// //let require = /^$|/;
// let notNum = /\d|[/?<>;:{}!@#$%^&*()+=]/;
// let notAlpha = /[^a-zA-Z\s:\u00C0-\u00FF]/g;
// let email = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//
// export function validateit() {
//     let submit_btn = document.querySelector('#submit');
//     let span = document.querySelector('.span');
//     let calendar = document.querySelector('.datetimepicker-dummy-input');
//     if (calendar) {
//         calendar.setAttribute('require', '');
//     }
//     if(submit_btn) {
//         submit_btn.addEventListener('click', function (e){
//             let inps = document.querySelectorAll("input[class=input], select, .tagsinput, .datetimepicker-dummy-input");
//             inps.forEach(inp => {
//                 console.log(inp);
//                 let errors = [];
//                 inp.getAttributeNames().forEach(attribute => {
//                     switch (attribute) {
//                         case 'require':
//                           if (inp.value.length === 0) {
//                               errors.push('This field is require');
//                           } else {
//                               errors.shift();
//                               valid(inp);
//                           }
//                           break;
//                         case 'notnum':
//                           if (notNum.test(inp.value)) {
//                               errors.push('Only letters');
//                           } else {
//                               errors.shift();
//                               valid(inp);
//                           }
//                           break;
//                         case 'notalpha':
//                             if (notAlpha.test(inp.value)) {
//                                 errors.push('Only num');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                             break;
//                         case 'email':
//                             if (!email.test(inp.value)) {
//                                 errors.push('Incorrect email');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                             break;
//                         case 'max20':
//                             if (inp.value.length > 20) {
//                                 errors.push('Max length 20');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                             break;
//                         case 'min16':
//                             if (inp.value.length < 16) {
//                                 errors.push('Enter full number');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                             break;
//                         case 'max6':
//                             if (inp.value.length > 6) {
//                                 errors.push('Max length 6');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                             break;
//                         case 'money':
//                             if (inp.value.length < 2) {
//                                 errors.push('This field is require');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                             break;
//                         case 'reqtag':
//                             if (inp.parentNode.querySelector('.tags') === null) {
//                                 errors.push('This field is require');
//                             } else {
//                                 errors.shift();
//                                 valid(inp);
//                             }
//                     }
//                });
//                if (errors.length != 0) {
//                    console.log(errors.length);
//                    showError(errors, inp);
//                    e.preventDefault();
//                }
//             });
//         });
//     }
// }
//
// function showError(errors, inp) {
//     if (inp.parentNode.querySelector('.tagsinput')) {
//         inp.parentNode.querySelector('.tagsinput').classList.add('is-danger');
//     } else {
//         inp.classList.add('is-danger');
//     }
//
//     if (errors[0] != null) {
//         let parent = inp;
//         while (!parent.classList.contains('control'))
//         {
//             parent = parent.parentNode;
//         }
//         parent.querySelector('.error').innerHTML = errors[0];
//     }
// }
//
// function valid(inp) {
//     if (!inp.classList.contains('datetimepicker-dummy-input'))
//     {
//         if (inp.parentNode.querySelector('.tagsinput')) {
//             inp.parentNode.querySelector('.tagsinput').classList.remove('is-danger');
//             inp.parentNode.querySelector('.tagsinput').classList.add('is-success');
//         } else {
//             inp.classList.remove('is-danger');
//             inp.classList.add('is-success');
//         }
//         inp.parentNode.querySelector('.error').innerHTML = '';
//     }
//
//
// }