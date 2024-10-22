<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Inclure l'autoloader de Composer

use PHPUnit\Framework\TestCase;

class CurrencyConverterTest extends TestCase
{
    private $currencyConverter;
    private $apiKey = 'FAKE_API_KEY'; // Clé API fictive pour les tests

    protected function setUp(): void
    {
        // Utilise une vraie instance de CurrencyConverter, mais on va moquer cURL
        $this->currencyConverter = $this->getMockBuilder(CurrencyConverter::class)
                                        ->setConstructorArgs([$this->apiKey])
                                        ->onlyMethods(['callApi']) // Moquer la méthode qui appelle l'API
                                        ->getMock();
    }

    // Test d'une conversion réussie
    public function testConvertSuccess()
    {
        // Simuler une réponse réussie de l'API
        $fakeApiResponse = json_encode([
            'result' => 'success',
            'conversion_rate' => 1.2
        ]);

        // Moquer la méthode callApi pour qu'elle retourne la fausse réponse
        $this->currencyConverter->expects($this->once())
            ->method('callApi')
            ->willReturn($fakeApiResponse);

        // Exécuter la conversion et vérifier le résultat
        $result = $this->currencyConverter->convert('USD', 'EUR', 100);
        $this->assertEquals(120, $result);
    }

    // Test d'une conversion qui échoue
    public function testConvertFailure()
    {
        // Simuler une réponse d'échec de l'API
        $fakeApiResponse = json_encode([
            'result' => 'error'
        ]);

        // Moquer la méthode callApi pour qu'elle retourne la fausse réponse d'échec
        $this->currencyConverter->expects($this->once())
            ->method('callApi')
            ->willReturn($fakeApiResponse);

        // S'attendre à une exception
        $this->expectException(Exception::class);
        $this->currencyConverter->convert('USD', 'EUR', 100);
    }
}
