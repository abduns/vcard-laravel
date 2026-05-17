# Laravel VCard

A Laravel 12/13 bridge for the `abduns/vcard` generator package. This package provides a convenient Facade and a Response Macro for seamlessly generating and downloading VCard `.vcf` files in your Laravel applications.

## Requirements

- PHP 8.2 or higher
- Laravel 12.0 or higher

## Installation

You can install the package via composer:

```bash
composer require abduns/laravel-vcard
```

## Usage

### Using the Facade

You can use the `VCard` facade to generate VCard content anywhere in your app:

```php
use Dunn\VCard\Laravel\Facades\VCard;

$vcard = VCard::make()
    ->addName('Doe', 'John')
    ->addEmail('john@example.com')
    ->addPhoneNumber('1234567890');

$content = $vcard->build();
```

*(Note: The facade proxies directly to the underlying `Dunn\VCard\VCard` class. See the [abduns/vcard](https://github.com/abduns/vcard) documentation for all available methods).*

### Returning a File Download (Response Macro)

Often, you just want to return a downloadable `.vcf` file directly from a controller. This package registers a convenient `response()->vcard()` macro to handle the correct headers automatically.

```php
namespace App\Http\Controllers;

use Dunn\VCard\Laravel\Facades\VCard;

class ContactController extends Controller
{
    public function download()
    {
        $vcard = VCard::make()
            ->addName('Doe', 'John')
            ->addCompany('Acme Corp')
            ->addPhoneNumber('1234567890');

        // This will trigger a file download named 'john_doe.vcf'
        return response()->vcard($vcard, 'john_doe.vcf');
    }
}
```

## Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
