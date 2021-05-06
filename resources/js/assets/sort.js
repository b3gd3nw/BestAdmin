import Axios from "axios";


let columns = document.querySelectorAll('.order');
let option = 'desc';
if (columns) {
    columns.forEach(column => {
        column.addEventListener('click', function(e) {
            let colId = column.id;
            const { parentNode: { parentNode } } = this.parentNode;
            const table = parentNode.id;
            Axios.get(`/api/orderby/?order=${colId}&by=${option}&in=${table}`)
                .then(response => {
                    document.querySelector('#tbody').innerHTML = response.data.view;
                    if (option === "asc") {
                        option = 'desc';
                    } else {
                        option = 'asc';
                    }
                })
        })
    });
}