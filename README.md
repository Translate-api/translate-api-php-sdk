# Translate API - PHP SDK

Official PHP SDK for [Translate API](https://translate-api.com).

## 🚀 Quick Start (For Beginners)

### Step 1: Get Your API Key
1. Go to [https://translate-api.com](https://translate-api.com)
2. Click "Login" or "Get Started"
3. Create an account (it's free to start!)
4. Go to your Dashboard
5. Click "Create API Key"
6. Copy your API key - you'll need it!

### Step 2: Install the SDK

**If you have Composer installed:**
```bash
composer require translate-api/client
```

**If you don't have Composer:**
1. Download Composer from https://getcomposer.org/download/
2. Run the installer
3. Then run the command above

### Step 3: Use It!

```php
<?php
require_once 'vendor/autoload.php';

use TranslateAPI\Client;

// Replace 'your-api-key' with your actual API key from translate-api.com
$client = new Client('your-api-key');

// Translate to one language
$result = $client->translate('Hello world', 'es');
echo $result['translations']['es']; // Output: "Hola mundo"

// Translate to multiple languages at once
$result = $client->translate('Hello world', ['es', 'fr', 'de']);
print_r($result['translations']);
// Output: Array ( [es] => Hola mundo [fr] => Bonjour le monde [de] => Hallo Welt )
?>
```

## 📖 Full API Reference

### Constructor
```php
$client = new Client($apiKey, $baseUrl);
```
- `$apiKey` (required): Your API key from translate-api.com
- `$baseUrl` (optional): Custom API URL (default: 'https://translate-api.com/v1')

### translate($text, $targetLanguage)
Translate text to one or more languages.

### translateBatch($items)
Translate multiple texts at once.

## 🌍 Supported Languages
Visit [translate-api.com/documentation](https://translate-api.com/documentation) for a full list.

## ❓ Need Help?
- Documentation: [translate-api.com/documentation](https://translate-api.com/documentation)
- Support: support@translate-api.com

## 📝 License
MIT License
