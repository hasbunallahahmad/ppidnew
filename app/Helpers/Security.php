<?php

// app/Helpers/Security.php
//
// Daftarkan di composer.json:
//   "autoload": {
//     "files": ["app/Helpers/Security.php"]
//   }
// Lalu jalankan: composer dump-autoload

/**
 * Validasi URL aman — tolak javascript:, data:, vbscript:, file:
 */
function safe_url(?string $url, string $fallback = '#'): string
{
    if (empty($url)) {
        return $fallback;
    }

    $url    = trim($url);
    $scheme = strtolower(parse_url($url, PHP_URL_SCHEME) ?? '');

    $blocked = ['javascript', 'data', 'vbscript', 'file'];
    if (in_array($scheme, $blocked, true)) {
        return $fallback;
    }

    if ($url[0] === '/' || $url[0] === '#') {
        return $url;
    }

    if (in_array($scheme, ['http', 'https', 'mailto', 'tel'], true)) {
        return $url;
    }

    return $fallback;
}

/**
 * Sanitasi HTML dari rich text editor menggunakan HTMLPurifier.
 * Install: composer require ezyang/htmlpurifier
 *
 * PENTING: HTMLPurifier berbasis HTML 4. Semua atribut / elemen HTML5
 * (figure, figcaption, loading, srcset, decoding, dll) harus
 * didefinisikan manual — TIDAK boleh hanya dimasukkan ke HTML.Allowed.
 */
function clean(?string $html): string
{
    if (empty($html)) {
        return '';
    }

    $config = HTMLPurifier_Config::createDefault();

    // ── Daftar tag & atribut yang diizinkan ──────────────────────────
    // Aturan: jangan masukkan tag/atribut HTML5 di sini —
    // definisikan mereka secara terpisah via addElement / addAttribute.
    $config->set(
        'HTML.Allowed',
        'p,br,strong,em,b,i,u,s,' .
            'ul,ol,li,' .
            'h2,h3,h4,h5,h6,' .
            'blockquote,pre,code,' .
            'a[href|title|target|rel],' .
            'img[src|alt|width|height],' .   // ← 'loading' TIDAK di sini
            'table,thead,tbody,tfoot,tr,td,th[colspan|rowspan],' .
            'span[class|style],div[class]'
        // figure, figcaption → didefinisikan via addElement di bawah
    );

    $config->set('HTML.TargetBlank', true);
    $config->set('HTML.TargetNoreferrer', true);

    $config->set('URI.AllowedSchemes', [
        'http'   => true,
        'https'  => true,
        'mailto' => true,
    ]);

    // ── Definisi elemen & atribut HTML5 custom ───────────────────────
    // DefinitionID + Rev wajib ada agar maybeGetRawHTMLDefinition() bekerja
    $config->set('HTML.DefinitionID', 'ppid-clean');
    $config->set('HTML.DefinitionRev', 2);

    if ($def = $config->maybeGetRawHTMLDefinition()) {

        // <figure> — block element
        $def->addElement(
            'figure',
            'Block',
            'Optional: (figcaption, Flow) | (Flow, figcaption?) | Flow',
            'Common'
        );

        // <figcaption> — inline di dalam figure
        $def->addElement('figcaption', 'Inline', 'Flow', 'Common');

        // Atribut HTML5 pada <img>:
        // loading="lazy|eager|auto"
        $def->addAttribute('img', 'loading', 'Enum#lazy,eager,auto');

        // srcset & sizes (untuk responsive images dari editor)
        $def->addAttribute('img', 'srcset', 'Text');
        $def->addAttribute('img', 'sizes',  'Text');

        // decoding="async|sync|auto"
        $def->addAttribute('img', 'decoding', 'Enum#async,sync,auto');
    }

    static $purifier = null;
    if ($purifier === null) {
        $purifier = new HTMLPurifier($config);
    }

    return $purifier->purify($html);
}
