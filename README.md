# Laravel vCard

Laravel bridge for [`abduns/vcard`](https://github.com/abduns/vcard) — generate and download vCard `.vcf` files natively in your Laravel application.

[![Tests](https://github.com/abduns/laravel-vcard/actions/workflows/tests.yml/badge.svg)](https://github.com/abduns/laravel-vcard/actions)
[![Latest Version](https://img.shields.io/github/v/tag/abduns/laravel-vcard?label=version)](https://github.com/abduns/laravel-vcard/tags)
[![License](https://img.shields.io/github/license/abduns/laravel-vcard)](LICENSE.md)

## Features

- Fluent `VCard` Facade
- `response()->vcard()` macro for file downloads
- Correct `text/vcard` MIME type and headers
- Auto-discovery via Laravel package discovery
- Full IDE autocompletion via Facade docblocks
- All 50 IANA registered properties supported

---

## Requirements

- PHP 8.2 or higher
- Laravel 12.0 or higher

---

## Installation

```bash
composer require abduns/laravel-vcard
```

The package registers itself automatically via Laravel's package discovery. No manual configuration required.

---

## Quick Start

```php
use Dunn\VCard\Laravel\Facades\VCard;

return response()->vcard(
    VCard::make()
        ->addName('Doe', 'John')
        ->addEmail('john@example.com', 'work')
        ->addPhoneNumber('+62-812-3456-7890', 'cell'),
    'john_doe.vcf'
);
```

---

## Standards

This package delegates all vCard generation to `abduns/vcard`, which is built around official Internet standards.

| RFC | Description |
|-----|-------------|
| [RFC 6350](https://datatracker.ietf.org/doc/html/rfc6350) | vCard Format Specification (vCard 4.0) — core standard |
| [RFC 6474](https://datatracker.ietf.org/doc/html/rfc6474) | Birth/Death properties |
| [RFC 6715](https://datatracker.ietf.org/doc/html/rfc6715) | Expertise, Hobby, Interest properties |
| [RFC 8605](https://datatracker.ietf.org/doc/html/rfc8605) | CONTACT-URI property |
| [RFC 9554](https://datatracker.ietf.org/doc/html/rfc9554) | GRAMGENDER, LANGUAGE, PRONOUNS, SOCIALPROFILE |
| [RFC 9555](https://datatracker.ietf.org/doc/html/rfc9555) | JSPROP (JSContact bridge) |

---

## Usage

### Facade

```php
use Dunn\VCard\Laravel\Facades\VCard;

$vcf = VCard::make()
    ->addName('Doe', 'John')
    ->addEmail('john@example.com', 'work')
    ->addPhoneNumber('+62-812-3456-7890', 'cell')
    ->addUrl('https://johndoe.com')
    ->build();
```

### File Download

Return a `.vcf` file download with correct headers from any controller:

```php
namespace App\Http\Controllers;

use Dunn\VCard\Laravel\Facades\VCard;

class ContactController extends Controller
{
    public function download()
    {
        $vcard = VCard::make()
            ->addName('Doe', 'John')
            ->addEmail('john@example.com', 'work')
            ->addPhoneNumber('+62-812-3456-7890', 'cell');

        return response()->vcard($vcard, 'john_doe.vcf');
    }
}
```

### Dynamic Download from Model

```php
public function download(User $user)
{
    $vcard = VCard::make()
        ->addName($user->last_name, $user->first_name)
        ->addEmail($user->email)
        ->addPhoneNumber($user->phone, 'cell')
        ->addUid('urn:uuid:' . $user->uuid);

    return response()->vcard($vcard, "{$user->slug}.vcf");
}
```

---

## All Available Methods

### Name & Identity

```php
->addFormattedName('John Doe')
->addName('Doe', 'John', additional: '', prefix: 'Dr.', suffix: 'Jr.')
->addNickname('JD', 'Johnny')
->addGender('M')
->addPronouns('they/them', 'en')
->addBirthday('1990-01-15')
->addAnniversary('2015-06-20')
->addPhoto('https://example.com/photo.jpg', 'image/jpeg')
```

### Contact

```php
->addPhoneNumber('+62-812-3456-7890', 'cell')
->addEmail('john@example.com', 'work')
->addImpp('xmpp:john@jabber.org')
->addSocialProfile('https://github.com/johndoe', 'GitHub')
->addContactUri('https://example.com/contact')
->addUrl('https://johndoe.com', 'work')
```

### Address

```php
->addAddress(
    poBox:    '',
    extended: '',
    street:   'Jl. Example No. 1',
    city:     'Bandung',
    region:   'West Java',
    zip:      '40000',
    country:  'Indonesia',
    type:     'work'
)
```

### Organization

```php
->addCompany('Acme Corp', 'Engineering', 'Backend')
->addJobTitle('Software Engineer')
->addRole('Backend Lead')
->addLogo('https://example.com/logo.png', 'image/png')
```

### Expertise / Hobby / Interest

```php
->addExpertise('PHP', 'expert')
->addHobby('Rock Climbing', 'average')
->addInterest('Open Source', 'expert')
```

### Calendar

```php
->addFburl('https://cal.example.com/busy/john', 'work')
->addCaladruri('mailto:john@example.com')
->addCaluri('https://cal.example.com/john')
```

### Metadata

```php
->addCategories('Developer', 'PHP', 'Open Source')
->addNote('Best reached by email.')
->addUid('urn:uuid:' . $uuid)
->addTz('Asia/Jakarta')
->addGeo('geo:-6.9175,107.6191')
->addKind('individual')
```

### Custom Properties

```php
->addProperty('X-CUSTOM-FIELD', 'value')
```

For the full property reference, see the [abduns/vcard documentation](https://github.com/abduns/vcard).

---

## Validation

The only enforced runtime requirement is `FN` (Formatted Name), mandatory per [RFC 6350 §6.2.1](https://datatracker.ietf.org/doc/html/rfc6350#section-6.2.1). Calling `addName()` sets it automatically.

```php
// Throws InvalidArgumentException
VCard::make()->addPhoneNumber('123')->build();

// OK
VCard::make()->addName('Doe', 'John')->build();
```

---

## Compatibility

This package aims to work with:

- Apple Contacts
- Google Contacts
- Android Contacts
- Outlook
- Thunderbird
- CardDAV systems

---

## Design Goals

- Native Laravel integration without overhead
- Clean Facade API with full IDE support
- Delegate all vCard logic to the core library
- Standards-oriented

---

## Roadmap

- [ ] Artisan command for generating test vCards
- [ ] CardDAV response helpers
- [ ] Livewire component for vCard preview

---

## Contributing

Contributions, bug reports, and interoperability test cases are welcome.

---

## License

MIT — see [LICENSE.md](LICENSE.md)
