<?php

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');
get('/signup', 'views/sign_up.php');
get('/tapwall', 'views/tapwall.php');
get('/profile/$user_id', 'views/profile');
get('/admin', 'views/admin.php');
get('/editor', 'views/editor');
// get('/10-28/item/$id',                    'views/item');
// get('/10-28/$gender/shoes/$brand/$size',  'views/product');
// get('/10-28/test/$word', function($word){
//   out($word);
// });

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


// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
// any('/404','views/404.php');