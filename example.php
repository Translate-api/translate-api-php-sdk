<?php
/**
 * Example usage of the Translate API PHP SDK
 * 
 * Before running this example:
 * 1. Get your API key at https://translate-api.com
 * 2. Replace 'YOUR_API_KEY_HERE' with your actual API key
 * 
 * To run this example:
 * 1. Open terminal in this folder
 * 2. Run: composer install (if you haven't already)
 * 3. Run: php example.php
 */

require_once __DIR__ . '/vendor/autoload.php';

use TranslateAPI\Client;

// ⚠️ IMPORTANT: Replace this with your API key from translate-api.com
define('API_KEY', 'YOUR_API_KEY_HERE');

echo "🌍 Translate API - PHP SDK Example\n\n";

try {
    // Create the client
    $client = new Client(API_KEY);

    // Example 1: Translate to a single language
    echo "Example 1: Translate to Spanish\n";
    $result1 = $client->translate('Hello, how are you?', 'es');
    echo "Input: Hello, how are you?\n";
    echo "Spanish: " . $result1['translations']['es'] . "\n\n";

    // Example 2: Translate to multiple languages
    echo "Example 2: Translate to multiple languages\n";
    $result2 = $client->translate('Good morning!', ['fr', 'de', 'it', 'ja']);
    echo "Input: Good morning!\n";
    echo "French: " . $result2['translations']['fr'] . "\n";
    echo "German: " . $result2['translations']['de'] . "\n";
    echo "Italian: " . $result2['translations']['it'] . "\n";
    echo "Japanese: " . $result2['translations']['ja'] . "\n\n";

    // Example 3: Batch translation
    echo "Example 3: Batch translation\n";
    $results = $client->translateBatch([
        ['text' => 'Thank you', 'target_language' => 'es'],
        ['text' => 'Goodbye', 'target_language' => 'fr']
    ]);
    echo "Thank you (Spanish): " . $results[0]['translations']['es'] . "\n";
    echo "Goodbye (French): " . $results[1]['translations']['fr'] . "\n";

    echo "\n✅ All examples completed successfully!\n";
    echo "\n📖 Documentation: https://translate-api.com/documentation\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "\n💡 Make sure you:\n";
    echo "   1. Have a valid API key from https://translate-api.com\n";
    echo "   2. Replaced YOUR_API_KEY_HERE with your actual key\n";
    echo "   3. Have enough character quota in your account\n";
}
