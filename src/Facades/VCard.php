<?php

namespace Dunn\VCard\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use Dunn\VCard\VCard as VCardBuilder;

/**
 * @method static \Dunn\VCard\VCard make(string $version = '3.0')
 * @method static \Dunn\VCard\VCard addName(string $lastName, string $firstName, string $additional = '', string $prefix = '', string $suffix = '')
 * @method static \Dunn\VCard\VCard addFormattedName(string $formattedName)
 * @method static \Dunn\VCard\VCard addCompany(string $company)
 * @method static \Dunn\VCard\VCard addJobTitle(string $jobTitle)
 * @method static \Dunn\VCard\VCard addEmail(string $email, string $type = 'INTERNET')
 * @method static \Dunn\VCard\VCard addPhoneNumber(string $number, string $type = 'CELL')
 * @method static \Dunn\VCard\VCard addAddress(string $name, string $extended, string $street, string $city, string $region, string $zip, string $country, string $type = 'WORK')
 * @method static \Dunn\VCard\VCard addUrl(string $url, string $type = 'WORK')
 * @method static \Dunn\VCard\VCard addNote(string $note)
 * @method static \Dunn\VCard\VCard addPhoto(string $urlOrBase64, string $type = 'JPEG')
 * @method static string build()
 *
 * @see \Dunn\VCard\VCard
 */
class VCard extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'vcard';
    }
}
