"use strict";

function formValidation(callback, url) {
    event.preventDefault();
    if (!url) {
        url = '/';
    }
    const form = event.target.form;
    if (form.checkValidity()) {
        callback(form, url);
    }
}

function toggleModal() {
    const modalId = event.target.dataset.target;
    document.querySelector(modalId).classList.toggle('show');
}

function toggleUpdateModal() {
    const modalId = event.target.dataset.target;
    const table = event.target.dataset.table;
    const id = event.target.dataset.id;

    const modal = document.querySelector(modalId);

    if (modal.classList.contains('show')) {
        emptyModalForm(modalId, modal.querySelector('form'));
        return;
    } 
    modal.classList.add('show');
    if (table === 'users') {
        getUser(id, modalId);
    } else if (table === 'breweries') {
        getBrewery(id, modalId);
    } else {
        getBeer(id, modalId);
    }
}

function toggleDeleteModal() {
    const modalId = event.target.dataset.target;
    const id = event.target.dataset.id;

    const modal = document.querySelector(modalId);
    if (modal.classList.contains('show')) {
        modal.classList.remove('show');
        return;
    } else {
        const form = modal.querySelector('form');
        form.id.value = id;
        modal.classList.add('show');
    }
}

function emptyModalForm(modalId, form) {
    const modal = document.querySelector(modalId);
    const inputs = form.querySelectorAll('input');
    const selects = form.querySelectorAll('select');
    const textareas = form.querySelectorAll('textarea');
    const imgPreview = form.querySelector('.preview');
    
    if (modal.classList.contains('show')) {
        modal.classList.toggle('show');
    }

    if (inputs) {
        inputs.forEach(input => {
            input.value = '';
        });
    }

    if (selects) {
        selects.forEach(select => {
            select.value = '';
            select.classList.remove('valid');
        });
    }

    if (textareas) {
        textareas.forEach(textarea => {
            textarea.value = '';
        });
    }
    
    if (imgPreview) {
        form.querySelector('img').src = '';
        form.querySelector('img').alt = '';
        imgPreview.classList.add('hidden');
    }

    form.querySelector('.error-container').classList.add('hidden');
    form.querySelector('.error-container span').textContent = '';
}

function formatDate(timestamp) {
    const d = new Date(parseInt(timestamp) * 1000);
    const year = d.getFullYear()
    const date = parseInt(d.getDate()) < 10 ? `0${d.getDate()}` : d.getDate();
    const month = parseInt(d.getMonth()) + 1;
    return `${date}/${month}/${year}`;
}

function toggleBurger() {
    const target = event.target;
    target.classList.toggle('show');
    document.querySelector(target.dataset.target).classList.toggle('show');
}

function toggleLabel() {
    const select = event.target;
    if (select.value !== '') {
        select.classList.remove('invalid');
        select.classList.add('valid');
    } else {
        select.classList.remove('valid');
        select.classList.add('invalid');
    };
}

function addPreviewImage() {
    const input = event.target;
    const preview = document.querySelector(`.preview[data-input-id='#${input.id}']`);
    const image = input.files[0];
    preview.querySelector('img').src = URL.createObjectURL(image);
    preview.classList.remove('hidden');
}

function removePreviewImage() {
    const inputId = event.target.dataset.inputId;
    document.querySelector(inputId).value = "";
    const preview = document.querySelector(`.preview[data-input-id='${inputId}']`);
    preview.querySelector('img').src = "";
    preview.classList.add('hidden');

    const inputHidden = document.querySelector(`[type='hidden'][data-input-id='${inputId}']`)
    if (inputHidden) {
        inputHidden.value = "";
    }
}

async function getUser(id, modalId) {
    const response = await fetch(`/user/${id}`, {
        method: 'GET',
    });
    if (!response.status === 200) {
        const error = await response.json();
        console.log('Error: ', error);
        return;
    }

    const user = await response.json();
    const form = document.querySelector(`${modalId} form`);
    form.user_id.value = user.user_id;
    form.first_name.value = user.user_first_name;
    form.last_name.value = user.user_last_name;
    form.email.value = user.user_email;
    form.role_id.value = user.role_id;
    form.role_id.classList.add('valid');
}

async function getUsers() {
    const btn = event.target;
    const offset = btn.dataset.offset;

    const response = await fetch(`/users/${offset}`, {
        method: 'GET'
    });
    if (response.status === 204) {
        btn.classList.add('hidden');
        return;
    }
    if (!response.status === 200) {
        const error = await response.json();
        console.log(error);
        return;
    }
    
    const users = await response.json();
    if (users) {
        users.forEach(user => {
            const tmp = document.querySelector('#userTmp');
            const clone = tmp.cloneNode(true).content;

            clone.querySelector('article').setAttribute('id', `user_${user.user_id}`);
            clone.querySelector('h3').textContent = `${user.user_first_name} ${user.user_last_name}`;
            clone.querySelectorAll('button').forEach(btn => {
                btn.setAttribute('data-id', user.user_id);
            });
            clone.querySelector('.email').textContent = user.user_email;
            clone.querySelector('.role').textContent = user.role_name;

            document.querySelector('#users').appendChild(clone);
        });
    }

    btn.setAttribute('data-offset', parseInt(offset) + 5);
    if (users.length < 5) {
        btn.classList.add('hidden');
    }
}

async function postUser(form, url) {
    const response = await fetch('/user', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href=url;    
}

async function updateUser(form, url) {
    const response = await fetch(`/user/${form.user_id.value}`, {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'No user data to update.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    if (url === `/profile/${form.user_id.value}`) {
        window.location.href = url;
        return;
    }

    const user = await response.json();
    const userElem = document.querySelector(`#user_${user.user_id}`);
    userElem.querySelector('h3').textContent = `${user.user_first_name} ${user.user_last_name}`;
    userElem.querySelector('.email').textContent = user.user_email;
    userElem.querySelector('.role').textContent = user.role_name;

    emptyModalForm('#update_user_modal', form);
}

async function deleteUser(form, url) {
    const userId = form.id.value;
    const response = await fetch(`/user/${userId}`, {
        method: 'DELETE'
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'User does not exist.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    if (url === `/profile/${userId}`) {
        window.location.href = url;
        return;
    }

    document.querySelector(`#user_${userId}`).remove();
    emptyModalForm('#delete_user_modal', form);
}

async function updatePassword(form, url) {
    const response = await fetch(`/password/${form.id.value}`, {
        method: 'POST',
        body: new FormData(form)
    });
    const message = await response.json();
    if (response.status !== 200) {
        form.querySelector('.error-container .text-red-600').textContent = message.info;
        form.querySelector('.error-container .text-green-600').textContent = '';
    } else {
        form.querySelector('.error-container .text-red-600').textContent = '';
        form.querySelector('.error-container .text-green-600').textContent = message.info;
    }
    form.querySelectorAll('input[type="password"]').forEach(input => {
        input.value = '';
    })
    form.querySelector('.error-container').classList.remove('hidden');
}

async function getBrewery(id, modalId) {
    const response = await fetch(`/brewery/${id}`, {
        method: 'GET',
    });
    if (!response.status === 200) {
        const error = await response.json();
        console.log(error);
        return;
    }

    const brewery = await response.json();
    const form = document.querySelector(`${modalId} form`);
    form.brewery_id.value = brewery.brewery_id;
    form.name.value = brewery.brewery_name;
}

async function getBreweries() {
    const btn = event.target;
    const offset = btn.dataset.offset;

    const response = await fetch(`/breweries/${offset}`, {
        method: 'GET'
    });
    if (response.status === 204) {
        btn.classList.add('hidden');
        return;
    }
    if (!response.status === 200) {
        const error = await response.json();
        console.log(error);
        return;
    }

    const breweries = await response.json();
    if (breweries) {
        breweries.forEach(brewery => {
            const tmp = document.querySelector('#breweryTmp');
            const clone = tmp.cloneNode(true).content;

            clone.querySelector('article').setAttribute('id', `brewery_${brewery.brewery_id}`);
            clone.querySelector('h3').textContent = brewery.brewery_name;
            clone.querySelectorAll('button').forEach(btn => {
                btn.setAttribute('data-id', brewery.brewery_id);
            });

            document.querySelector('#breweries').appendChild(clone);
        });
    }

    btn.setAttribute('data-offset', parseInt(offset) + 5);
    if (breweries.length < 5) {
        btn.classList.add('hidden');
    }
    
}

async function postBrewery(form, url) {
    const response = await fetch('/brewery', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href = url;
}

async function updateBrewery(form, url) {
    const response = await fetch(`/brewery/${form.brewery_id.value}`, {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'No brewery data to update.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    const brewery = await response.json();
    const breweryElem = document.querySelector(`#brewery_${brewery.brewery_id}`);
    breweryElem.querySelector('h3').textContent = brewery.brewery_name;

    emptyModalForm('#update_brewery_modal', form);
}

async function deleteBrewery(form, url) {
    const breweryId = form.id.value;
    const response = await fetch(`/brewery/${breweryId}`, {
        method: 'DELETE'
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'Brewery does not exist.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    document.querySelector(`#brewery_${breweryId}`).remove();
    emptyModalForm('#delete_brewery_modal', form);
}

async function postSession(form, url) {
    const response = await fetch('/login', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href=url;
}

async function getBeer(id, modalId) {
    const response = await fetch(`/beer/${id}`, {
        method: 'GET'
    });
    if (!response.status === 200) {
        const error = await response.json();
        console.log(error);
        return;
    }

    const beer = await response.json();
    const form = document.querySelector(`${modalId} form`);
    form.beer_id.value = beer.beer_id;
    form.beer_brewery_id.value = beer.beer_brewery_id;
    form.beer_brewery_id.classList.add('valid');
    form.name.value = beer.beer_name;
    form.style.value = beer.beer_style;
    form.volume.value = beer.beer_volume;
    form.ibu.value = beer.beer_ibu;
    form.ebc.value = beer.beer_ebc;
    form.is_active.value = beer.beer_is_active;
    form.is_active.classList.add('valid');
    form.tapwall_no.value = beer.beer_tapwall_no;
    form.price.value = beer.beer_price;
    form.description.value = beer.beer_description;
    form.beer_image.value = beer.beer_image;
    form.created_at.value = beer.beer_created_at;
    form.updated_at.value = beer.beer_updated_at;
    form.created_by.value = beer.beer_created_by;

    if (beer.beer_image) {
        const preview = form.querySelector('.preview');
        preview.classList.remove('hidden');
        preview.querySelector('img').src = `public/images/uploads/${beer.beer_image}`;
    }
}

async function getBeers() {
    const btn = event.target;
    const offset = btn.dataset.offset;

    const response = await fetch(`/beers/${offset}`, {
        method: 'GET'
    });
    if (response.status === 204) {
        btn.classList.add('hidden');
        return;
    }
    if (!response.status === 200) {
        const error = await response.json();
        console.log(error);
        return;
    }

    const beers = await response.json();
    if (beers) {
        beers.forEach(beer => {
            const tmp = document.querySelector('#beerTmp');
            const clone = tmp.cloneNode(true).content;

            clone.querySelector('article').setAttribute('id', `beer_${beer.beer_id}`);
            clone.querySelector('h3').textContent = beer.beer_name;
            clone.querySelectorAll('button').forEach(btn => {
                btn.setAttribute('data-id', beer.beer_id);
            });
            clone.querySelector('.beerBrewery').textContent = beer.brewery_name;
            clone.querySelector('.style').textContent = beer.beer_style;
            clone.querySelector('.ibu').textContent = parseInt(beer.beer_ibu) ? beer.beer_ibu : '-';
            clone.querySelector('.ebc').textContent = parseInt(beer.beer_ebc) ? beer.beer_ebc : '-';
            clone.querySelector('.volume').textContent = beer.beer_volume + '%';
            clone.querySelector('.price').textContent = beer.beer_price + ' DKK';
            clone.querySelector('.isActive').textContent = parseInt(beer.beer_is_active) ? 'Yes' : 'No';
            clone.querySelector('.tapwallNo').textContent = parseInt(beer.beer_tapwall_no) ? beer.beer_tapwall_no : '-';
            clone.querySelector('.description').textContent = beer.beer_description ? beer.beer_description : '-';
            clone.querySelector('.createdAt').textContent = formatDate(beer.beer_created_at);
            clone.querySelector('.updatedAt').textContent = parseInt(beer.beer_updated_at) ? formatDate(beer.beer_updated_at) : '-';

            if (!beer.beer_image) {
                clone.querySelector('img').classList.add('hidden');
            } else {
                clone.querySelector('img').src = `./public/images/uploads/${beer.beer_image}`;
                clone.querySelector('img').alt = `${beer.brewery_name} ${beer.beer_name}`;
            }

            document.querySelector('#beers').appendChild(clone);
        });
    }

    btn.setAttribute('data-offset', parseInt(offset) + 5);
    if (beers.length < 5) {
        btn.classList.add('hidden');
    }
}

async function postBeer(form, url) {
    const isActive = form.is_active;
    if (isActive.value === "0") {
        form.tapwall_no.value = "0";
    }

    const response = await fetch('/beer', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    window.location.href=url;
}

async function updateBeer(form, url) {
    const response = await fetch(`/beer/${form.beer_id.value}`, {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'No brewery data to update.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    const beer = await response.json();
    const beerElem = document.querySelector(`#beer_${beer.beer_id}`);

    beerElem.querySelector('h3').textContent = beer.beer_name;
    beerElem.querySelector('.beerBrewery').textContent = beer.brewery_name;
    beerElem.querySelector('.style').textContent = beer.beer_style;
    beerElem.querySelector('.ibu').textContent = parseInt(beer.beer_ibu) ? beer.beer_ibu : '-';
    beerElem.querySelector('.ebc').textContent = parseInt(beer.beer_ebc) ? beer.beer_ebc : '-';
    beerElem.querySelector('.volume').textContent = beer.beer_volume + '%';
    beerElem.querySelector('.price').textContent = beer.beer_price + ' DKK';
    beerElem.querySelector('.isActive').textContent = parseInt(beer.beer_is_active) ? 'Yes' : 'No';
    beerElem.querySelector('.tapwallNo').textContent = parseInt(beer.beer_tapwall_no) ? beer.beer_tapwall_no : '-';
    beerElem.querySelector('.description').textContent = parseInt(beer.beer_description) ? beer.beer_description : '-';
    beerElem.querySelector('.updatedAt').textContent = formatDate(beer.beer_updated_at);
    beerElem.querySelector('img').src = `./public/images/uploads/${beer.beer_image}`;
    beerElem.querySelector('img').alt = `${beer.brewery_name} ${beer.beer_name}`;
    if (!beer.beer_image) {
        beerElem.querySelector('img').classList.add('hidden');
    } else {
        beerElem.querySelector('img').classList.remove('hidden');
    }

    emptyModalForm('#update_beer_modal', form);
}

async function deleteBeer(form, url) {
    const beerId = form.id.value;
    const response = await fetch(`/beer/${beerId}`, {
        method: 'DELETE'
    });
    if (response.status === 204) {
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = 'Beer does not exist.';
        return;
    }
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.error-container').classList.remove('hidden');
        form.querySelector('.error-container span').textContent = error.info;
        return;
    }

    document.querySelector(`#beer_${beerId}`).remove();
    emptyModalForm('#delete_beer_modal', form);
}

async function deleteSession() {
    const userId = event.target.dataset.id;
    const response = await fetch(`/logout/${userId}`, {
        method: 'DELETE',
    });
    if (response.status !== 200) {
        const error = await response.json();
        console.log(error);
        return;
    }

    window.location.href='/';
}