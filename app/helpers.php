<?php
use Orchid\Attachment\Models\Attachment;
if (!function_exists('site_config')) {
    /**
     * Get the site configuration value, with caching support.
     * Handles attachments like favicons by returning their URL.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function site_config($key, $default = null)
    {
        // Cache all settings as an array
        $settings = Cache::rememberForever('site_config', function () {
            return \App\Models\Setting::pluck('value', 'key')->toArray(); // Get all settings as key-value pairs
        });

        // Check if the value is an attachment ID (for keys like 'favicon')
        if (in_array($key, ['favicon']) && isset($settings[$key])) {
            return Cache::rememberForever("attachment_url_{$settings[$key]}", function () use ($settings, $key) {
                // Fetch and cache the attachment URL
                $attachment = Attachment::find($settings[$key]);
                return $attachment ? $attachment->url() : null;
            });
        }

        if (in_array($key, ['logo']) && isset($settings[$key])) {
            return Cache::rememberForever("attachment_url_{$settings[$key]}", function () use ($settings, $key) {
                // Fetch and cache the attachment URL
                $attachment = Attachment::find($settings[$key]);
                return $attachment ? $attachment->url() : null;
            });
        }


        // Return the specific setting value or default if not found
        return $settings[$key] ?? $default;
    }
}
