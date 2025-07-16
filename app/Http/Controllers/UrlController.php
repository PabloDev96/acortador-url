<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    // Guarda la URL original y genera el código corto
    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        // Generar código corto único
        do {
            $shortCode = Str::random(6);
        } while (Url::where('short_code', $shortCode)->exists());

        $url = Url::create([
            'original_url' => $request->original_url,
            'short_code' => $shortCode
        ]);

        return redirect('/')->with('short_url', url($shortCode));

    }

    // Redirige a la URL original según el código corto
    public function redirect($code)
    {
        $url = Url::where('short_code', $code)->firstOrFail();

        // (opcional) Contar visitas
        $url->increment('visits');

        return redirect()->to($url->original_url);
    }
}