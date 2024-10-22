<?php

class CurrencyConverter
{
    private $apiKey;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    // Fonction pour effectuer la conversion
    public function convert($fromCurrency, $toCurrency, $amount)
    {
        $fromCurrency = strtoupper($fromCurrency);
        $toCurrency = strtoupper($toCurrency);

        // Appel à l'API (via la méthode callApi)
        $response = $this->callApi($fromCurrency, $toCurrency);

        // Décoder la réponse
        $exchangeData = json_decode($response, true);

        if ($exchangeData && $exchangeData['result'] === 'success') {
            $exchangeRate = $exchangeData['conversion_rate'];
            return $amount * $exchangeRate;
        } else {
            throw new Exception('Erreur lors de la récupération des taux de change.');
        }
    }

    // Méthode séparée pour faire l'appel API (facilite le mock)
    public function callApi($fromCurrency, $toCurrency)
    {
        $apiUrl = "https://v6.exchangerate-api.com/v6/{$this->apiKey}/pair/{$fromCurrency}/{$toCurrency}";

        $curl = curl_init($apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
