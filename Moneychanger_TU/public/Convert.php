<?php
// Remplacer par votre clé API ExchangeRate-API
$apiKey = 'b20ba3dd0044e79aae25b1ff';

// Récupération des données du formulaire
$fromCurrency = strtoupper($_POST['from_currency']);
$toCurrency = strtoupper($_POST['to_currency']);
$amount = $_POST['amount'];

// URL de l'API pour obtenir le taux de change
$apiUrl = "https://v6.exchangerate-api.com/v6/$apiKey/pair/$fromCurrency/$toCurrency";

// Initialiser une session cURL
$curl = curl_init($apiUrl);

// Définir les options cURL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Exécuter la requête cURL et obtenir la réponse
$response = curl_exec($curl);

// Fermer la session cURL
curl_close($curl);

// Décoder la réponse JSON
$exchangeData = json_decode($response, true);

// Vérifier si la requête a réussi
if ($exchangeData && $exchangeData['result'] === 'success') {
    // Taux de change
    $exchangeRate = $exchangeData['conversion_rate'];
    
    // Calcul de la conversion
    $convertedAmount = $amount * $exchangeRate;

    echo "<h1>Résultat de la conversion</h1>";
    echo "<p>$amount $fromCurrency équivaut à $convertedAmount $toCurrency</p>";
    echo "<p>Taux de change: 1 $fromCurrency = $exchangeRate $toCurrency</p>";
} else {
    // En cas d'erreur
    echo "<p>Erreur lors de la récupération des taux de change. Veuillez vérifier vos devises ou réessayer plus tard.</p>";
}
?>
