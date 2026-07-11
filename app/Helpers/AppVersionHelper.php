<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class AppVersionHelper
{
    public static function checkUpdate()
    {
        $userAgent = 'MedianApp/1.0';
        
        if (str_contains($userAgent, 'MedianApp/')) {
            preg_match('/MedianApp\/([0-9.]+)/', $userAgent, $matches);
            $currentAppVersion = isset($matches[1]) ? (float)$matches[1] : 1.0;

            $latestUpdate = DB::table('app_updates')->latest()->first();

            if ($latestUpdate && $latestUpdate->latest_version > $currentAppVersion) {
                return [
                    'needs_update' => true,
                    'download_url' => asset($latestUpdate->apk_path),
                    'is_force' => $latestUpdate->is_force,
                ];
            }
        }

        return ['needs_update' => false];
    }
}