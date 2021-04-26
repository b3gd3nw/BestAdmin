import axios from 'axios';
import IMask from 'imask';
import bulmaTagsinput from "bulma-tagsinput/src/js";
import bulmaCalendar from "bulma-calendar";
import { validateit } from '../validate';

init_edit();

document.addEventListener('DOMContentLoaded', () => {
    (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
        const $notification = $delete.parentNode;

        $delete.addEventListener('click', () => {
            $notification.parentNode.removeChild($notification);
        });
    });
});

bulmaTagsinput.attach();

const logout = document.querySelector('#logout');
if (logout) {
    logout.addEventListener('click', function (e) {
        axios.post('/admin/logout').then(responce => {
            location.reload();
        });
    });
}

bulmaCalendar.attach('.range-calendar', {
    dateFormat: 'YYYY/MM/DD',
    type: 'date',
    isRange: 'true',
    labelFrom: 'Click to change date',
});

const sbmt = document.querySelector('#submit');
if (sbmt) {
    var phoneMask = IMask(
        document.getElementById('phone'), {
            mask: '+{0}0000000000000'
        });
    let currencyMask = IMask(
        document.getElementById('salary'),
        {
            mask: '$num',
            blocks: {
                num: {
                    mask: Number,
                    thousandsSeparator: '.'
                }
            }
        });
    bulmaCalendar.attach('.calendar', {
        dateFormat: 'YYYY/MM/DD',
        type: 'date',
        maxDate: new Date(),
    });
    validateit()
}

const srch = document.querySelector('#srch');
if (srch) {
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
                validateit();
                let currencyMask = IMask(
                    document.getElementById('budget'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: '.'
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
                                thousandsSeparator: '.'
                            }
                        }
                    });
                validateit();
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
                validateit();
                var currencyMask = IMask(
                    document.getElementById('income'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: '.'
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
                validateit();
                var currencyMask = IMask(
                    document.getElementById('consumption'),
                    {
                        mask: '$num',
                        blocks: {
                            num: {
                                mask: Number,
                                thousandsSeparator: '.'
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
                                thousandsSeparator: '.'
                            }
                        }
                    });
                var phoneMask = IMask(
                    document.getElementById('phone'), {
                        mask: '+{0}0000000000000'
                    });
                bulmaTagsinput.attach();
            })
    });
}

function init_edit()
{
    const edit_employee_btns = document.querySelectorAll('.edit_employee');
    if (edit_employee_btns) {
        edit_employee_btns.forEach(edit_employee_btn =>{
            edit_employee_btn.addEventListener('click', function(e) {
                document.querySelector('#modal').classList.add('is-active');
                let target = edit_employee_btn.getAttribute('data-path');
                axios.get(target)
                    .then(responce=> {
                        document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                        document.querySelector('#modal-title').innerHTML = 'Edit Employee';
                        validateit();
                        bulmaTagsinput.attach();
                        var currencyMask = IMask(
                            document.getElementById('salary'),
                            {
                                mask: '$num',
                                blocks: {
                                    num: {
                                        mask: Number,
                                        thousandsSeparator: '.'
                                    }
                                }
                            });
                        var phoneMask = IMask(
                            document.getElementById('phone'), {
                                mask: '+{0}0000000000000'
                            });
                    })
            });
        })
    }
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
                validateit();
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
                init_edit();
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
                init_edit();
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
                init_edit();
            })
    });
}

const clear_btn = document.querySelector('#clr');
if (clear_btn){
    clear_btn.addEventListener('click', function(e) {
        window.location.reload();
    });
}