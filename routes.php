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
get('/admin', 'views/admin.php');
// get('/10-28/item/$id',                    'views/item');
// get('/10-28/$gender/shoes/$brand/$size',  'views/product');
// get('/10-28/test/$word', function($word){
//   out($word);
// });

// APIS
get('/users', 'apis/get_users');
get('/user/$user_id', 'apis/get_user');
get('/brewery/$brewery_id', 'apis/get_brewery');
post('/user', 'apis/post_user');
post('/login', 'apis/post_session');
post('/beer', 'apis/post_beer');
post('/user/$user_id', 'apis/update_user');
post('/brewery/$brewery_id', 'apis/update_brewery');
delete('/logout/$user_id', 'apis/delete_session');
delete('/user/$user_id', 'apis/delete_user');
delete('/brewery/$brewery_id', 'apis/delete_brewery');


// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
// any('/404','views/404.php');