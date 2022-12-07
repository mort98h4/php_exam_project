"use strict";

function formValidation(callback) {
    event.preventDefault();
    const form = event.target.form;
    if (form.checkValidity()) {
        callback(form);
    }
}

function toggleModal() {
    const modalId = event.target.dataset.target;
    document.querySelector(modalId).classList.toggle('show');
}

function toggleBurger() {
    document.querySelector(".burger").classList.toggle('show');
    document.querySelector(".menu").classList.toggle('show');
}

async function postUser(form) {
    const response = await fetch('/user', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 201) {
        const error = await response.json();
        console.log(error);
        return;
    }

    window.location.href="/";    
}

async function postSession(form) {
    const response = await fetch('/login', {
        method: 'POST',
        body: new FormData(form)
    });
    if (response.status !== 200) {
        const error = await response.json();
        form.querySelector('.hint-container').classList.remove('hidden');
        form.querySelector('.hint').textContent = error.info;
        return;
    }

    window.location.href="/";
}

async function deleteSession() {
    const userId = event.target.dataset.id;
    console.log(userId);
    const response = await fetch(`/logout/${userId}`, {
        method: 'DELETE',
    });
    if (response.status !== 204) {
        const error = await response.json();
        console.log(error);
        return;
    }

    window.location.href='/';
}