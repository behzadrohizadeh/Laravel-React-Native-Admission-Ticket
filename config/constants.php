<?php 
$num=intval(date('Ymd')); 
$token= md5($num*789).md5($num*548).md5($num*455).md5($num*984).md5($num*548).md5($num*789).md5($num*45).md5($num*987).md5($num*698).md5($num*58); 

$caps=array(
	   array('controller' => "User","name"=>" Users " ),
	   array('controller' => "Admissions","name"=>" Admissions " ),
	   array('controller' => "Areas","name"=>" Areas " ),
	   array('controller' => "Gates","name"=>" Gates " ),
	   array('controller' => "Tickets","name"=>" Tickets " ),
	   
);

return [
    'token' =>  $token,
    'caps'=>$caps
];
//Config::get('constants.token');
