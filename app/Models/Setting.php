<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'value'];

    public $timestamps = false;

    // Helper: Lấy giá trị setting
    public static function get($name, $default = null)
    {
        $setting = static::where('name', $name)->first();
        return $setting ? $setting->value : $default;
    }

    // Helper: Cập nhật setting
    public static function set($name, $value)
    {
        static::updateOrCreate(['name' => $name], ['value' => $value]);
    }
}