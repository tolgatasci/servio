<?php
namespace App\Orchid\Screens;
use App\Models\Application;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Group;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;


class ApplicationViewScreen extends Screen
{
    public $name = 'Başvuru Detayları';
    public $description = 'Başvurunun detaylı bilgileri';
    public $application;
    public function query(Application $application): iterable
    {
        $this->application = $application;
        return [
            'application' => $application,
        ];
    }
    // Geri Dön Butonu ve Diğer Komutlar
    public function commandBar(): iterable
    {
        return [
            Link::make('Geri Dön')
                ->icon('arrow-left-circle')  // Buton için ikon
                ->route('platform.applications.list'),  // Geri dönülecek rotayı buraya yazın
            Link::make('Firmalara Gönder')
                ->icon('paper-plane')  // Buton için ikon
                ->route('platform.applications.send_company',$this->application->id),  // Geri dönülecek rotayı buraya yazın
        ];
    }
    public function layout(): iterable
    {

        return [
            Layout::view('platform::application-details', [
                'application' => $this->application,
            ]),
        ];
    }

    private function getFormDataValue($key)
    {
        $formData = $this->application->form_data;
        // Eğer key yoksa boş string döndür
        if (!isset($formData[$key]['value'])) {
            return '-';
        }

        $value = $formData[$key]['value'];

        // Eğer value bir array ise, derinlemesine kontrol yaparak düz bir string döndür
        return $this->normalizeValue($value);

    }

    private function normalizeValue($value)
    {
        if (is_array($value)) {
            // Array'in tüm elemanlarını string'e çevir ve birleştir
            return implode(', ', array_map([$this, 'normalizeValue'], $value));
        }

        // Eğer zaten string ise, olduğu gibi döndür
        return (string) $value;
    }
    private function renderImage($key)
    {
        $formData = $this->query['application']->form_data;

        if (!isset($formData[$key]['value'])) {
            return '-';
        }

        $filePath = $formData[$key]['value'];
        if (Storage::exists($filePath)) {
            return '<img src="' . Storage::url($filePath) . '" alt="Logo" width="150">';
        }

        return 'Resim bulunamadı';
    }

    // Dosyaları göstermek için yardımcı fonksiyon
    private function renderFiles($key)
    {
        $formData = $this->query['application']->form_data;

        if (!isset($formData[$key]['value'])) {
            return '-';
        }

        $files = $formData[$key]['value'];
        if (!is_array($files)) {
            $files = [$files];
        }

        $output = '';
        foreach ($files as $file) {
            if (Storage::exists($file)) {
                $output .= '<a href="' . Storage::url($file) . '" target="_blank">Dosyayı İndir</a><br>';
            } else {
                $output .= 'Dosya bulunamadı: ' . $file . '<br>';
            }
        }

        return $output;
    }
}
