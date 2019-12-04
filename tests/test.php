<?php

require_once __DIR__ . '/../vendor/autoload.php';


$executor = new Scorecardio\ScorecardExecutor('asdf');
$response = $executor->executeScorecardVersion('Prof. Carlo Bartoletti PhD', 'Larkin-Hill', 3, [
	'work_contract' => 'yes',
	'nationality' => 'Tanzanian',
	'age' => 21,
	'marital_status' => 'single',
	'number_of_current_loans' => 0,
	'number_of_past_loans' => 1,
	'loan_defaults' => 0
]);

echo $response;