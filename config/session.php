<?php

use Illuminate\Support\Str;

return [
  'driver' => env('SESSION_DRIVER', 'file'),
  'lifetime' => env('SESSION_LIFETIME', 20160),
  'expire_on_close' => false,
  'encrypt' => false,
  'files' => storage_path('framework/sessions'),
  'connection' => env('SESSION_CONNECTION'),
  'table' => 'sessions',
  'store' => env('SESSION_STORE'),
  'lottery' => [2, 100],
  'cookie' => env(
    'SESSION_COOKIE',
    Str::slug(env('APP_NAME', 'laravel'), '_') . '_session'
  ),
  'path' => '/',
  'domain' => env('SESSION_DOMAIN'),
  'secure' => false,
  'http_only' => false,
  'same_site' => 'none',
];