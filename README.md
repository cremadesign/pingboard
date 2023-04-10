# Simple Pingboard API
Stephen Ginn at Crema Design Studio

This PHP script checks for the existence of a cache file. If one doesn't exist, it connects to Pingboard and saves a new one.

### Installation
You can install the package via composer:
```shell
composer config repositories.crema/pingboard git https://github.com/cremadesign/pingboard
composer require crema/pingboard:@dev
```

### Usage
Add this code to your PHP file:
```php
require_once '../vendor/autoload.php';
use Crema\Pingboard;

$credentials = json_decode(file_get_contents('../config.json'))->pingboard;
$pingboard = new Pingboard($credentials);
header('Content-Type: application/json');
echo json_encode($pingboard->getUsers(), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
```
