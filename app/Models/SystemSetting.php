<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'group',
        'label',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value, $label = null, $group = 'general')
    {
        return static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'label' => $label, 'group' => $group]
        );
    }

    /**
     * Dapatkan URL logo website (baik dari database maupun deteksi otomatis berkas pada folder public/image/logo.png)
     */
    public static function getLogoUrl()
    {
        $dbLogo = static::get('site_logo');
        if (!empty($dbLogo)) {
            return $dbLogo;
        }

        // Deteksi berkas lokal yang ditaruh manual
        $candidates = [
            'image/logo.png',
            'image/logo.jpg',
            'image/logo.jpeg',
            'image/logo.svg',
            'image/logo.webp',
            'images/logo.png',
            'images/logo.jpg',
            'images/logo.svg',
            'logo.png',
            'logo.svg',
        ];

        foreach ($candidates as $file) {
            if (file_exists(public_path($file))) {
                return asset($file);
            }
        }

        return null;
    }
}

