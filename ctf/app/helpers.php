<?php

use Illuminate\Support\HtmlString;

if (!function_exists('vite_assets')) {
    function vite_assets($assets = [])
    {
        if (is_string($assets)) {
            $assets = [$assets];
        }

        $html = [];
        $hotFile = public_path('hot');
        $manifestFile = public_path('build/manifest.json');

        if (file_exists($hotFile)) {
            $url = rtrim(file_get_contents($hotFile));
            $html[] = '<script type="module" src="' . $url . '/@vite/client"></script>';
            foreach ($assets as $asset) {
                if (preg_match('/\.css$/i', $asset)) {
                    $html[] = '<link rel="stylesheet" href="' . $url . '/' . ltrim($asset, '/') . '">';
                } else {
                    $html[] = '<script type="module" src="' . $url . '/' . ltrim($asset, '/') . '"></script>';
                }
            }
        } elseif (file_exists($manifestFile)) {
            $manifest = json_decode(file_get_contents($manifestFile), true);
            foreach ($assets as $asset) {
                $cleanAsset = ltrim($asset, '/');
                if (isset($manifest[$cleanAsset])) {
                    $entry = $manifest[$cleanAsset];
                    $file = $entry['file'] ?? '';
                    if (preg_match('/\.css$/i', $file)) {
                        $html[] = '<link rel="stylesheet" href="/build/' . $file . '">';
                    } else {
                        $html[] = '<script type="module" src="/build/' . $file . '"></script>';
                    }
                    if (isset($entry['css'])) {
                        foreach ($entry['css'] as $cssFile) {
                            $html[] = '<link rel="stylesheet" href="/build/' . $cssFile . '">';
                        }
                    }
                }
            }
        } else {
            if (file_exists(public_path('css/app.css'))) {
                $html[] = '<link rel="stylesheet" href="' . asset('css/app.css') . '">';
            }
            if (file_exists(public_path('js/app.js'))) {
                $html[] = '<script src="' . asset('js/app.js') . '" defer></script>';
            }
        }

        return new HtmlString(implode("\n    ", array_unique($html)));
    }
}
