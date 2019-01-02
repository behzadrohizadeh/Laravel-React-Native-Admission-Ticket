<?php 
$token="eGPMR5EoUSO8SzKSocbedkjJHKKFCTUiDsYLjs0LYJeS8o91t8FS7EqgM8tu4uu0" ;

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
