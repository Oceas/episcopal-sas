<?php

namespace App\Models;

use App\HidesId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    use HasFactory, HidesId;

    protected $fillable = [
        'vid', 'device_id', 'app_version', 'brand', 'design_name',
        'device_name', 'product_name', 'supported_cpu_architectures',
        'total_memory', 'device_year_class', 'manufacturer', 'model_id',
        'model_name', 'os_build_id', 'os_long_name', 'os_name',
        'os_version', 'push_token', 'push_token_valid', 'is_first_time_signup',
    ];

    /**
     * Find or create a device by device_id.
     *
     * @param array $data
     * @return Device
     */
    public static function findOrCreateByDeviceId(array $data)
    {
        // Find the device by device_id
        $device = self::where('device_id', $data['device_id'])->first();

        // If device is found, return it
        if ($device) {
            return $device;
        }

        // Otherwise, create a new device record
        return self::create([
            'vid' => Str::uuid(),
            'device_id' => $data['device_id'],
            'app_version' => $data['app_version'] ?? null,
            'brand' => $data['brand'] ?? null,
            'design_name' => $data['design_name'] ?? null,
            'device_name' => $data['device_name'] ?? null,
            'product_name' => $data['product_name'] ?? null,
            'supported_cpu_architectures' => $data['supported_cpu_architectures'] ?? null,
            'total_memory' => $data['total_memory'] ?? null,
            'device_year_class' => $data['device_year_class'] ?? null,
            'manufacturer' => $data['manufacturer'] ?? null,
            'model_id' => $data['model_id'] ?? null,
            'model_name' => $data['model_name'] ?? null,
            'os_build_id' => $data['os_build_id'] ?? null,
            'os_long_name' => $data['os_long_name'] ?? null,
            'os_name' => $data['os_name'] ?? null,
            'os_version' => $data['os_version'] ?? null,
            'push_token' => null, // Assume push token will be set separately
            'push_token_valid' => false,
            'is_first_time_signup' => true,
        ]);
    }
}
