<?php


namespace App;


use App\Model\Setting;
use App\Traits\TSingleton;

class Settings
{

    use TSingleton;

    protected $settings;

    protected function __construct()
    {
        $this->settings = Setting::all();
    }

    public function get(string $key, $default = null){
        $result = $this->settings->firstWhere('key', $key)->value;
        return $result ?? $default;
    }

    /**
     * @return Setting[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSettings()
    {
        return $this->settings;
    }

    public function set(string $key, string $value){
        $setting = $this->settings->firstWhere('key', $key);
        $setting->value = $value;
        return $setting->save();
    }

}