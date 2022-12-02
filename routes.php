<?php

require_once __DIR__.'/router.php';

// ##################################################
// ##################################################
// ##################################################

// Static GET
// In the URL -> http://localhost
// The output -> Index
get('/', 'views/index.php');
// get('/10-28/item/$id',                    'views/item');
// get('/10-28/$gender/shoes/$brand/$size',  'views/product');
// get('/10-28/test/$word', function($word){
//   out($word);
// });

// APIS
get('/users', 'apis/get_users');
post('/user', 'apis/post_user');



// For GET or POST
// The 404.php which is inside the views folder will be called
// The 404.php has access to $_GET and $_POST
any('/404','views/404.php');