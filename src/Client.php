<?php
/**
 * Translate API - Official PHP SDK
 * 
 * Get your API key at: https://translate-api.com
 * Documentation: https://translate-api.com/documentation
 */

namespace TranslateAPI;

class Client
{
    private string $apiKey;
    private string $baseUrl;

    /**
     * Create a new Translate API client
     *
     * @param string $apiKey Your API key from translate-api.com
     * @param string $baseUrl Optional custom API URL
     */
    public function __construct(string $apiKey, string $baseUrl = 'https://translate-api.com/v1')
    {
        if (empty($apiKey)) {
            throw new \InvalidArgumentException('API key is required. Get one at https://translate-api.com');
        }
        
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
    }

    /**
     * Translate text to one or more target languages
     *
     * @param string $text The text to translate
     * @param string|array $targetLanguage Single language code or array of codes
     * @return array Translation response with 'translations', 'success', 'characters_used'
     * @throws \Exception If the translation fails
     * 
     * @example
     * // Single language
     * $result = $client->translate('Hello', 'es');
     * echo $result['translations']['es']; // "Hola"
     * 
     * @example
     * // Multiple languages
     * $result = $client->translate('Hello', ['es', 'fr']);
     * print_r($result['translations']); // ['es' => 'Hola', 'fr' => 'Bonjour']
     */
    public function translate(string $text, $targetLanguage): array
    {
        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $this->baseUrl . '/translate',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $this->apiKey,
                'Content-Type: application/json',
            ],
            CURLOPT_POSTFIELDS => json_encode([
                'text' => $text,
                'target_language' => $targetLanguage,
            ]),
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            throw new \Exception('Request failed: ' . $curlError);
        }

        if ($httpCode !== 200) {
            $error = json_decode($response, true);
            throw new \Exception($error['error'] ?? 'Translation failed (HTTP ' . $httpCode . ')');
        }

        return json_decode($response, true);
    }

    /**
     * Translate multiple texts in batch
     *
     * @param array $items Array of ['text' => string, 'target_language' => string|array]
     * @return array Array of translation responses
     * 
     * @example
     * $results = $client->translateBatch([
     *     ['text' => 'Hello', 'target_language' => 'es'],
     *     ['text' => 'Goodbye', 'target_language' => 'fr']
     * ]);
     */
    public function translateBatch(array $items): array
    {
        return array_map(
            fn($item) => $this->translate($item['text'], $item['target_language']),
            $items
        );
    }
}
