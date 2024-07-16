<?php

declare(strict_types=1);

namespace App\Services\ParsableContentProviders;

use App\Contracts\Services\ParsableContentProvider;

final readonly class ImageProviderParsable implements ParsableContentProvider
{
    /**
     * {@inheritDoc}
     */
    public function parse(string $content): string
    {
        return (string)preg_replace_callback(
            '/!\[(.*?)\]\((.*?)\)/',
            static function ($match): string {
                $altText = preg_replace('/\.(jpg|jpeg|png|gif)$/i', '', $match[1]);

                return "<img class='object-cover mx-auto max-h-[52rem] w-full max-w-[26rem]' src=\"/storage/$match[2]\" alt=\"{$altText}\">";
            },
            $content
        );
    }
}
