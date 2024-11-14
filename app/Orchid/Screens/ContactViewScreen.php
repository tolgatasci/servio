<?php

namespace App\Orchid\Screens;

use App\Models\Contact;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
class ContactViewScreen extends Screen
{
    public $name = 'Contact Details';
    public $description = 'View the details of a contact submission';

    /**
     * Fetch data for the screen.
     *
     * @return array
     */
    public function query(Contact $contact): array
    {
        return [
            'contact' => $contact,
        ];
    }
    public function commandBar(): array
    {
        return [
            // Geri Dön Butonu - Contact listesine geri döner
            Link::make('Back')
                ->icon('arrow-left') // Butona geri ok ikonu ekliyoruz
                ->route('platform.contacts'), // Contact listesine yönlendir
        ];
    }
    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::view('components.contact-detail'),
        ];
    }
}
