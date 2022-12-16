<?php

require_once __DIR__.'/router.php';

// Static GET
get('/', 'views/index.php');
get('/signup', 'views/sign_up.php');
get('/tapwall', 'views/tapwall.php');
get('/tap/$beer_id', 'views/tap');
get('/profile/$user_id', 'views/profile');
get('/admin', 'views/admin.php');
get('/editor', 'views/editor');

// APIS
get('/user/$user_id', 'apis/get_user');
get('/users/$offset', 'apis/get_users');
get('/brewery/$brewery_id', 'apis/get_brewery');
get('/breweries/$offset', 'apis/get_breweries');
get('/beer/$beer_id', 'apis/get_beer');
get('/beers/$offset', 'apis/get_beers');
post('/user', 'apis/post_user');
post('/login', 'apis/post_session');
post('/brewery', 'apis/post_brewery');
post('/beer', 'apis/post_beer');
post('/user/$user_id', 'apis/update_user');
post('/password/$user_id', 'apis/update_password');
post('/brewery/$brewery_id', 'apis/update_brewery');
post('/beer/$beer_id', 'apis/update_beer');
delete('/logout/$user_id', 'apis/delete_session');
delete('/user/$user_id', 'apis/delete_user');
delete('/brewery/$brewery_id', 'apis/delete_brewery');
delete('/beer/$beer_id', 'apis/delete_beer');


// Errors
any('/404','views/404.php');
