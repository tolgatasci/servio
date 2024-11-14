<?php

namespace App\Orchid\Screens;

use App\Models\Contact;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ContactScreen extends Screen
{
    public $name = 'Contact Submissions';
    public $description = 'View and manage contact form submissions';

    /**
     * Query data for the screen.
     *
     * @return array
     */
    public function query(): array
    {
        return [
            'contacts' => Contact::paginate(), // Tüm iletişim verilerini sayfalı şekilde getir
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::table('contacts', [
                TD::make('name', 'Name')
                    ->sort()
                    ->render(function (Contact $contact) {
                        return $contact->name;
                    }),

                TD::make('email', 'Email')
                    ->sort()
                    ->render(function (Contact $contact) {
                        return $contact->email;
                    }),

                TD::make('subject', 'Subject')
                    ->render(function (Contact $contact) {
                        return $contact->subject;
                    }),

                TD::make('message', 'Message')
                    ->render(function (Contact $contact) {
                        return Link::make(Str::limit($contact->message, 50)) // Mesajın kısaltılmış halini gösteriyoruz
                        ->route('platform.contact.view', $contact->id); // Mesaj detayına yönlendirme
                    }),

                TD::make('created_at', 'Sent At')
                    ->sort()
                    ->render(function (Contact $contact) {
                        return $contact->created_at->toDateTimeString();
                    }),
                // Göz simgesi ve Detay linki ekleme
                TD::make('Actions')
                    ->render(function (Contact $contact) {
                        return Link::make('')
                            ->icon('eye') // Göz simgesi ekliyoruz
                            ->route('platform.contact.view', $contact->id); // Detay sayfasına yönlendirme
                    }),
            ]),
        ];
    }
}
