import axios from 'axios';

const add_btn = document.querySelector('#addCard');
if (add_btn){
    add_btn.addEventListener('click', function(e) {
        document.querySelector('#modal').classList.add('is-active');
        let target = add_btn.getAttribute('data-path');
        axios.get(target)
            .then(responce=> {
                document.querySelector('.modal-card-body').innerHTML = responce.data.view;
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
            })
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


