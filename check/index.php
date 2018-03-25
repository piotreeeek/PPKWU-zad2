<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$result = [$_POST['name'] => 1];

	switch ($_POST['name']) {
		case 'mail':
			if (strlen($_POST['value']) < 1 || filter_var("some@address.com", FILTER_VALIDATE_EMAIL) == false) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'nip':
			if (strlen($_POST['value']) < 1) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'regon':
			if (strlen($_POST['value']) < 1) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'pesel':
			if (strlen($_POST['value']) < 1) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'code':
			if (strlen($_POST['value']) < 1) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		

		default:
			$result = [$_POST['name'] => 1];
			break;
	}
	
	echo json_encode($result);
}