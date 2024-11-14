<?php
namespace App\Orchid\Screens;



use App\Models\Application;
use App\Models\Service;
use App\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;

class ApplicationListScreen extends Screen
{
    public $name = 'Başvurular';  // Ekran ismi
    public $description = 'Tüm başvuruların listesi';

    public function query(): iterable
    {
        return [
            'applications' => Application::with('user', 'service')  // İlişkili user ve service'i de çekiyoruz
            ->orderByDesc('id')
            ->paginate(10),  // Başvuruları sayfalandırarak listele
        ];
    }

    public function commandBar(): iterable
    {
        return [

        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::table('applications', [
                TD::make('user_id', 'Kullanıcı')
                    ->render(function (Application $application) {
                        return $application->user
                            ? $application->user->name
                            : 'Anonim';  // Eğer kullanıcı yoksa 'Anonim' yaz
                    }),

                TD::make('service_id', 'Servis')
                    ->render(function (Application $application) {
                        return $application->service
                            ? $application->service->name
                            : 'Belirtilmemiş';  // Eğer servis yoksa 'Belirtilmemiş' yaz
                    }),

                TD::make('created_at', 'Başvuru Tarihi')
                    ->sort()
                    ->render(function (Application $application) {
                        // Tarih var mı kontrol et, yoksa varsayılan bir değer göster
                        return $application->created_at
                            ? $application->created_at->toDateTimeString()
                            : 'Tarih mevcut değil';  // Tarih boşsa bu mesaj gösterilecek
                    }),

                TD::make('İncele')
                    ->render(function (Application $application) {
                        return Link::make('Detaylı İncele')
                            ->route('platform.applications.view', $application->id);  // İnceleme linki
                    }),
            ]),
        ];
    }
}
