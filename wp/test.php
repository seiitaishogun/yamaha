<?php
echo 'test';
$str = file_get_contents('http://localhost:89/wp-json/api-cms/v1/updateOrderStatus');
print_r($str) ;
?>