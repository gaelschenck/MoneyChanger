<?php

$apiKey = 'b20ba3dd0044e79aae25b1ff';

// Récupération des données du formulaire
$fromCurrency = strtoupper($_POST['from_currency']);
$toCurrency = strtoupper($_POST['to_currency']);
$amount = $_POST['amount'];

// URL de l'API pour obtenir le taux de change
$apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/pair/$fromCurrency/$toCurrency";
$response_json = file_get_contents($apiUrl);

// Continuing if we got a result
if(false !== $response_json) {

    // Try/catch for json_decode operation
    try {

		// Decoding
		$response = json_decode($response_json);

		// Check for success
		if('success' === $response->result) {
            //Taux de change
            $exchangeRate = $response->conversion_rate;

            //Calcul de la conversion
            $convertedAmount = $amount * $exchangeRate;

            echo "<h1>Résultat de la conversion</h1>";
            echo "<p>$amount $fromCurrency équivaut à $convertedAmount $toCurrency</p>";
            echo "<p>Taux de change: 1 $fromCurrency = $exchangeRate $toCurrency</p>";
        }
    }
    catch(Exception $e) {
        echo "ZOB";
        echo "<p>Erreur lors de la récupération des taux de change. Veuillez vérifier vos devises ou réessayer plus tard.</p>";
        echo "<pre>Réponse brute de l'API : " . print_r($response_json, true) . "</pre>";
    }
}
?>
