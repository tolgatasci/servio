<?php
namespace App\Orchid\Screens;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Orchid\Attachment\Models\Attachment;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Fields\TextArea;

class SettingsScreen extends Screen
{
    public $name = 'Site Settings';
    public $description = 'Manage the settings of the site, such as site name, description, favicon, etc.';
    public $data;
    public function query(): array
    {

        $favicon_url = Setting::where('key', 'favicon')->first()->value ?? null;
        $favicon_attachment = null;
        $logo_url = Setting::where('key', 'logo')->first()->value ?? null;
        $logo_attachment = null;
        // Check if the URL is stored and find its attachment ID
        if ($favicon_url) {
            $favicon_attachment = Attachment::find($favicon_url);
        }
        if ($logo_url) {
            $logo_attachment = Attachment::find($logo_url);
        }
        $this->data =  [
            'site_name' => Setting::where('key', 'site_name')->first()->value ?? '',
            'site_description' => Setting::where('key', 'site_description')->first()->value ?? '',
            'logo' => $logo_attachment ? [$logo_attachment->id] : [],
            'favicon' => $favicon_attachment ? [$favicon_attachment->id] : [],
            'contact_email'=>  Setting::where('key', 'contact_email')->first()->value ?? '',
            'contact_phone'=>  Setting::where('key', 'contact_phone')->first()->value ?? '',

            // Social Media Links and footer description

            'footer_description' => Setting::where('key', 'footer_description')->first()->value ?? '',
            'facebook_url' => Setting::where('key', 'facebook_url')->first()->value ?? '',
            'twitter_url' => Setting::where('key', 'twitter_url')->first()->value ?? '',
            'instagram_url' => Setting::where('key', 'instagram_url')->first()->value ?? '',
            'linkedin_url' => Setting::where('key', 'linkedin_url')->first()->value ?? '',

        ];
        return $this->data;
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save Settings')
                ->icon('check')
                ->method('save'),
        ];
    }

    public function layout(): array
    {

        return [
            Layout::rows([
                Input::make('site_name')
                    ->title('Site Name')
                    ->value($this->data['site_name'] ?? '')
                    ->required(),

                Input::make('site_description')
                    ->title('Site Description')
                    ->value($this->data['site_description'] ?? '')
                    ->required(),

                Input::make('contact_email')
                    ->title('Contact Email')
                    ->type('email')
                    ->value($this->data['contact_email'] ?? '')
                    ->required(),
                Input::make('contact_phone')
                    ->title('Contact Phone')

                    ->mask('(999) 999-9999')
                    ->value($this->data['contact_phone'] ?? '')
                    ->required(),
                Upload::make('logo')
                    ->title('Logo')
                    ->maxFiles(1)  // Limit to 1 file
                    ->acceptedFiles('image/*')
                    ->value($this->data['logo'])  // Load the existing file if available
                    ->help('Upload your site logo image here'),
                Upload::make('favicon')
                    ->title('Favicon')
                    ->maxFiles(1)  // Limit to 1 file
                    ->acceptedFiles('image/*')
                    ->value($this->data['favicon'])  // Load the existing file if available
                    ->help('Upload your site favicon (only one file allowed)'),
            ]),
            // Group for Social Media Links
            Layout::rows([
                TextArea::make('footer_description')
                    ->title('Footer Description')
                    ->value($this->data['footer_description'] ?? '')
                    ->rows(5) // Defines the number of rows for the textarea
                    ->maxlength(200) // Limit the input to 200 characters
                    ->placeholder('Enter footer description (max 200 characters)')
                    ->help('Maximum 200 characters allowed for footer description'),
                Input::make('facebook_url')
                    ->title('Facebook URL')
                    ->value($this->data['facebook_url'] ?? '')
                    ->placeholder('https://facebook.com/yourpage'),

                Input::make('twitter_url')
                    ->title('Twitter URL')
                    ->value($this->data['twitter_url'] ?? '')
                    ->placeholder('https://twitter.com/yourprofile'),

                Input::make('instagram_url')
                    ->title('Instagram URL')
                    ->value($this->data['instagram_url'] ?? '')
                    ->placeholder('https://instagram.com/yourprofile'),

                Input::make('linkedin_url')
                    ->title('LinkedIn URL')
                    ->value($this->data['linkedin_url'] ?? '')
                    ->placeholder('https://linkedin.com/in/yourprofile'),
            ])->title('Social Media Links'),
        ];
    }

    public function save()
    {
        // Handle the input for site name and description
        $site_name = request('site_name');
        $site_description = request('site_description');
        $favicon = request('favicon');
        $logo = request('logo');
        $footer_description = request('footer_description');
        $contact_email = request('contact_email');
        $contact_phone = request('contact_phone');
        $facebook_url = request('facebook_url');
        $twitter_url = request('twitter_url');
        $instagram_url = request('instagram_url');
        $linkedin_url = request('linkedin_url');
        // Save site name
        Setting::updateOrCreate(['key' => 'site_name'], ['value' => $site_name]);

        // Save site description
        Setting::updateOrCreate(['key' => 'site_description'], ['value' => $site_description]);

        // Save Contact Email
        Setting::updateOrCreate(['key' => 'contact_email'], ['value' => $contact_email]);

        // Save Contact Phone
        Setting::updateOrCreate(['key' => 'contact_phone'], ['value' => $contact_phone]);

        // Save Footer Description
        Setting::updateOrCreate(['key' => 'footer_description'], ['value' => $footer_description]);

        // Save social media links
        Setting::updateOrCreate(['key' => 'facebook_url'], ['value' => $facebook_url]);
        Setting::updateOrCreate(['key' => 'twitter_url'], ['value' => $twitter_url]);
        Setting::updateOrCreate(['key' => 'instagram_url'], ['value' => $instagram_url]);
        Setting::updateOrCreate(['key' => 'linkedin_url'], ['value' => $linkedin_url]);

        if ($favicon && is_array($favicon) && !empty($favicon[0])) {
            // Save or update the favicon in the settings table
            $setting = Setting::updateOrCreate(['key' => 'favicon'], ['value' => $favicon[0]]);

            // Attach the favicon to the Setting model using sync
            $setting->attachment()->sync($favicon);
        }

        if ($logo && is_array($logo) && !empty($logo[0])) {
            // Save or update the favicon in the settings table
            $setting = Setting::updateOrCreate(['key' => 'logo'], ['value' => $logo[0]]);

            // Attach the favicon to the Setting model using sync
            $setting->attachment()->sync($logo);
        }

        Cache::forget('site_config');

        // Optionally, cache the settings again after clearing (not mandatory, but improves performance on the first access)
        Cache::rememberForever('site_config', function () {
            return \App\Models\Setting::pluck('value', 'key')->toArray();
        });
        // Display a success message
        Alert::info('Settings have been updated successfully.');

        return redirect()->route('platform.settings');
    }
}
