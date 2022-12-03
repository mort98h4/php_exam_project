"use strict";

function formValidation(callback) {
    event.preventDefault();
    const form = event.target.form;
    if (form.checkValidity()) {
        callback(form);
    }
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
        console.log(error);
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