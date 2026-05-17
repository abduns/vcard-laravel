<?php

namespace Dunn\VCard\Laravel\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\ResponseFactory;
use Dunn\VCard\VCard;

class VCardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind('vcard', function ($app) {
            return new VCard();
        });
    }

    public function boot(): void
    {
        ResponseFactory::macro('vcard', function (VCard|string $vcard, string $filename = 'contact.vcf') {
            $content = $vcard instanceof VCard ? $vcard->build() : $vcard;

            return $this->make($content, 200, [
                'Content-Type' => 'text/vcard',
                'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            ]);
        });
    }
}
