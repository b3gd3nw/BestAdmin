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
    logout.addEventListener('click', function(e) {
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
        document.getElementById('salary'), {
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
    srch.addEventListener('click', function(e) {
        let date = document.querySelector(".range-calendar").value;
        if (date) {
            let baseUrl = window.location.href.split('?')[0];
            window.history.pushState('name', '', baseUrl + `?filterby=${date.replace(/\s/g, '')}`);
            window.location.reload();
        }
    });
}

const add_btn = document.querySelector('#addCard');
if (add_btn) {
    add_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = add_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Category';
                validateit();
                let currencyMask = IMask(
                    document.getElementById('budget'), {
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
    elem.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = elem.getAttribute('data-path');
        axios.get(target)
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Change Budget';
                var currencyMask = IMask(
                    document.getElementById('budget'), {
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
    income_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = income_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Income';
                validateit();
                var currencyMask = IMask(
                    document.getElementById('income'), {
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
    consump_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = consump_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Consumption';
                validateit();
                var currencyMask = IMask(
                    document.getElementById('consumption'), {
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
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Employee';
                var currencyMask = IMask(
                    document.getElementById('salary'), {
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
                bulmaCalendar.attach('.calendar', {
                    dateFormat: 'YYYY/MM/DD',
                    displayMode: 'dialog',
                    type: 'date',
                    maxDate: new Date(),
                });
                bulmaTagsinput.attach();
                validateit();
            })
    });
}

function init_edit() {
    const edit_employee_btns = document.querySelectorAll('.edit_employee');
    if (edit_employee_btns) {
        edit_employee_btns.forEach(edit_employee_btn => {
            edit_employee_btn.addEventListener('click', function(e) {
                document.querySelector('#modal').classList.add('is-active');
                let target = edit_employee_btn.getAttribute('data-path');
                axios.get(target)
                    .then(responce => {
                        document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                        document.querySelector('#modal-title').innerHTML = 'Edit Employee';
                        bulmaTagsinput.attach();
                        var currencyMask = IMask(
                            document.getElementById('salary'), {
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
                            displayMode: 'dialog',
                            type: 'date',
                            maxDate: new Date(),
                        });
                        var phoneMask = IMask(
                            document.getElementById('phone'), {
                                mask: '+{0}0000000000000'
                            });
                        validateit();
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
            .then(responce => {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
                document.querySelector('#modal-title').innerHTML = 'Create New Invite';
                validateit();
            })
    });
}

const dropdown_title = document.querySelector('#dropdown-title');
if (dropdown_title) {
    if (getGet('status') === 'active') {
        dropdown_title.innerHTML = 'Filter by <span class="green">active</span>';
    } else if (getGet('status') === 'pending') {
        dropdown_title.innerHTML = 'Filter by <span class="orange">pending</span>';
    } else if (getGet('status') === 'inactive') {
        dropdown_title.innerHTML = 'Filter by <span class="red">inactive</span>';
    } else {
        dropdown_title.innerHTML = 'Filter by ...';
    }
}


const clear_btn = document.querySelector('#clr');
if (clear_btn) {
    clear_btn.addEventListener('click', function(e) {
        let baseUrl = window.location.href.split('?')[0];
        window.history.pushState('', '', baseUrl);
        window.location.reload();
    });
}

function getGet(name) {
    var s = window.location.search;
    s = s.match(new RegExp(name + '=([^&=]+)'));
    return s ? s[1] : false;
}