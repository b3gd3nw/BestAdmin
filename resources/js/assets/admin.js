import axios from 'axios';
import IMask from 'imask';
import Tagsfield from 'bulma-tagsfield';
import { validateit } from '../validate';

const srch = document.querySelector('#srch');
if (srch) {
    document.querySelector('.datetimepicker-clear-button').setAttribute('type', 'button');
    srch.addEventListener('click', function (e) {
        let bodyFormData = new FormData(document.querySelector('#frm'));
        axios.post('/api/transactions', bodyFormData)
            .then(responce => {
                document.querySelector('#agtable').innerHTML = responce.data.view;
            })
    });
}

const add_btn = document.querySelector('#addCard');
if (add_btn){
    add_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = add_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                let currencyMask = IMask(
                    document.getElementById('budget'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: ' '
                            }
                        }
                    });
            })
    });
}

const change_btn = document.querySelectorAll('.changeCard');
change_btn.forEach(function(elem) {
    elem.addEventListener('click', function (e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = elem.getAttribute('data-path');
        axios.get(target)
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                var currencyMask = IMask(
                    document.getElementById('budget'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: ' '
                            }
                        }
                    });
            })
    });
});


const close_btn = document.querySelector('#modalClose');
if (close_btn) {
    close_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.remove('is-active');
    });
}

const delete_btns = document.querySelectorAll('.delete-ctg');
delete_btns.forEach(function(elem) {
    elem.addEventListener('click', function(e) {
        if (e.target.classList.contains('delete-ctg')) {
            console.log(123);
        }
        let res = confirm('Confirm Action');
        if (!res) {
            return false;
        } else {
            document.querySelector('#del').submit();
        }
    });
});

const income_btn = document.querySelector('#income');
if (income_btn) {
    income_btn.addEventListener('click', function (e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = income_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Income';
                var currencyMask = IMask(
                    document.getElementById('income'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: ' '
                            }
                        }
                    });
            })
    });
}

const consump_btn = document.querySelector('#consumption');
if (consump_btn) {
    consump_btn.addEventListener('click', function (e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = consump_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Consumption';
                var currencyMask = IMask(
                    document.getElementById('consumption'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: ' '
                            }
                        }
                    });
            })
    });
}

const add_employee_btn = document.querySelector('#add_employee');
if (add_employee_btn) {
    add_employee_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = add_employee_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Employee';
                 validateit();
                var currencyMask = IMask(
                    document.getElementById('salary'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: ' '
                            }
                        }
                    });
                var phoneMask = IMask(
                    document.getElementById('phone'), {
                        mask: '+{0}(000)000-00-00'
                    });
                document.querySelectorAll('.tagsfield').forEach(el => new Tagsfield(el))
            })
    });
}

const send_mail_btn = document.querySelector('#send_mail');
if (send_mail_btn) {
    send_mail_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = send_mail_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Invite';
            })
    });
}

const active_btn = document.querySelector('#filter_active');
if (active_btn){
    active_btn.addEventListener('click', function(e) {
        let target = active_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('#tbody').innerHTML = responce.data.view;
                document.querySelector('#dropdown-title').innerHTML = 'Filter by <span class="green">active</span>';
            })
    });
}

const pending_btn = document.querySelector('#filter_pending');
if (pending_btn){
    pending_btn.addEventListener('click', function(e) {
        let target = pending_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('#tbody').innerHTML = responce.data.view;
                document.querySelector('#dropdown-title').innerHTML = 'Filter by <span class="orange">pending</span>';
            })
    });
}

const inactive_btn = document.querySelector('#filter_inactive');
if (inactive_btn){
    inactive_btn.addEventListener('click', function(e) {
        let target = inactive_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('#tbody').innerHTML = responce.data.view;
                document.querySelector('#dropdown-title').innerHTML = 'Filter by <span class="red">inactive</span>';
            })
    });
}

const clear_btn = document.querySelector('#clr');
if (clear_btn){
    clear_btn.addEventListener('click', function(e) {
        window.location.reload();
    });
}
// let submit = document.querySelector('.submit');
// submit.addEventListener('click', function (){
//     console.log(123);
//     let form = document.querySelector('#form');
//     let fields = form.querySelectorAll("input[type=text]");
//     fields.forEach(function(field) {
//         let attrs = field.attributes;
//         attrs.forEach(function (atr) {
//             switch (atr)
//             {
//                 case 'required':
//                     console.log(1);
//                     break;
//             }
//         });
//     });
// })


