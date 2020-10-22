<?php


namespace App\Traits;


trait hasIsEnabledProperty
{
    public function isEnabled()
    {
        return $this->is_enabled == 1;
    }

    public function scopeEnabled($query)
    {
        return $query->where('is_enabled', '=', 1);
    }

    public function scopeDisabled($query)
    {
        return $query->where('is_enabled', '=', 0);
    }

    public function getIsEnabledLabelAttribute()
    {
        return $this->isEnabled() ? __('Aktív') : __('Inaktív');
    }

    public static function getIsEnabledOptions()
    {
        return [
            0 => 'Inaktív',
            1 => 'Aktív',
        ];
    }

}