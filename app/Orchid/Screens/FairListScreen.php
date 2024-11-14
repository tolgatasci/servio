<?php

namespace App\Orchid\Screens;
use App\Models\Fair;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\FairsImport;
use Illuminate\Http\Request;
use Orchid\Attachment\Models\Attachment;
class FairListScreen extends Screen
{
    /**
     * @var bool
     */
    public $exists = false;

    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'fairs' => Fair::paginate(10),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Fuar Listesi';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Yeni Fuar Ekle')
                ->icon('plus')
                ->route('platform.fair.create'),

            ModalToggle::make('Excel Import')
                ->modal('importModal')
                ->method('import')
                ->icon('cloud-upload')
                ->class('btn btn-primary'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::modal('importModal', Layout::rows([
                Upload::make('excel_file')
                    ->title('Excel Dosyası Yükle')
                    ->acceptedFiles('.xlsx,.xls')
                    ->required()
                    ->maxFiles(1)
                    ->horizontal(),

                CheckBox::make('clear_old_records')
                    ->title('Eski Kayıtlar')
                    ->placeholder('Import öncesi mevcut kayıtlar silinsin')
                    ->horizontal(),
            ]))
                ->title('Excel Dosyası İçe Aktar')
                ->applyButton('İçe Aktar')
                ->closeButton('İptal'),
            Layout::table('fairs', [
                TD::make('name', 'Fuar Adı')
                    ->sort()
                    ->render(function (Fair $fair) {
                        return Link::make($fair->name)
                            ->route('platform.fair.edit', $fair->id);
                    }),

                TD::make('location', 'Konum')
                    ->sort(),

                TD::make('start_date', 'Başlangıç Tarihi')
                    ->sort()
                    ->render(function (Fair $fair) {
                        return $fair->start_date->format('d.m.Y');
                    }),

                TD::make('end_date', 'Bitiş Tarihi')
                    ->sort()
                    ->render(function (Fair $fair) {
                        return $fair->end_date->format('d.m.Y');
                    }),

                TD::make('İşlemler')
                    ->align(TD::ALIGN_CENTER)
                    ->render(function (Fair $fair) {
                        return Button::make('Sil')
                            ->icon('trash')
                            ->confirm('Bu fuarı silmek istediğinize emin misiniz?')
                            ->method('remove', [
                                'id' => $fair->id,
                            ]);
                    }),
            ]),
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        try {
            $attachmentIds = $request->input('excel_file');

            \Orchid\Support\Facades\Toast::info('Gelen veri: ' . json_encode($attachmentIds));

            if (empty($attachmentIds)) {
                throw new \Exception('Lütfen bir Excel dosyası seçin.');
            }

            $attachment = Attachment::find($attachmentIds[0]);

            if (!$attachment) {
                throw new \Exception('Dosya bulunamadı. ID: ' . $attachmentIds[0]);
            }

            \Orchid\Support\Facades\Toast::info('Dosya yolu: ' . $attachment->path . $attachment->name . '.' . $attachment->extension);

            $filePath = storage_path('app/public/' . $attachment->path . $attachment->name . '.' . $attachment->extension);

            if (!file_exists($filePath)) {
                throw new \Exception('Dosya fiziksel olarak bulunamadı: ' . $filePath);
            }

            if ($request->input('clear_old_records')) {
                Fair::truncate();
            }

            Excel::import(new FairsImport, $filePath);

            $attachment->delete();

            \Orchid\Support\Facades\Toast::success('Veriler başarıyla içe aktarıldı.');
        } catch (\Exception $e) {
            \Orchid\Support\Facades\Toast::error('Hata oluştu: ' . $e->getMessage());
        }

        return redirect()->route('platform.fairs.list');
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        Fair::findOrFail($id)->delete();

        return redirect()->route('platform.fairs.list');
    }
}