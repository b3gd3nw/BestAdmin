function validix(id)
{
    let submit = document.querySelector('#submit');
    submit.addEventListener('click', function (){
        console.log(123);
        let form = document.querySelector(id);
        let fields = form.querySelectorAll("input[type=text]");
        fields.forEach(function(field) {
            let attrs = field.attributes;
            attrs.forEach(function (atr) {
                switch (atr)
                {
                    case 'required':
                        console.log(1);
                        break;
                }
            });
        });
    })
}
