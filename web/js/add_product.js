function add_product(id, items) {
    let form = new FormData();
    form.append('product_id', id);
    form.append('count', items);
    let request_options = { method: 'POST', body: form };
    fetch('https://pr-belov.сделай.site/cart/create', request_options)
        .then(response => response.text())
        .then(result => {
            console.log(result)
            let title = document.getElementById('staticBackdropLabel');
            let body = document.getElementById('modalBody');
            if (result == 'false') {
                title.innerText = 'Ошибка';
                body.innerHTML = "<p>Ошибка добавления товара, вероятно, товар уже раскупили</p>"
            } else {
                title.innerText = 'Информационное сообщение';
                body.innerHTML = "<p>Товар успешно добавлен в корзину</p>"
            }
            let myModal = new
            bootstrap.Modal(document.getElementById("staticBackdrop"), {});
            myModal.show();
        })
}

function Loginn() {
    var formdata = new FormData();
    let pass = document.getElementById("password").value;
    formdata.append("password", pass);
    var requestOptions = {
        method: 'POST',
        body: formdata,
        redirect: 'follow'
    };

    fetch("https://pr-belov.xn--80ahdri7a.site/user/login", requestOptions)
        .then(response => response.text())
        .then(result => {
            let title = document.getElementById('staticBackdropLabel');
            let body = document.getElementById('modalBody');
            if (result == 'false') {

                title.innerText = 'Ошибка';
                body.innerHTML = "<p>Неверный пароль</p>"
                let myModal = new
                bootstrap.Modal(document.getElementById("staticBackdrop"), {});
                myModal.show();
            } else {
                document.location.href = "../order/create";
            }
        })

    .catch(error => console.log('error', error));
}