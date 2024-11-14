<?php

namespace App\Orchid\Screens;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormStep;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Alert;

class FormEditScreen extends Screen
{
    public $name = 'Form Edit';
    public $description = 'Edit Form and its steps';

    public $form;

    public function query($id): array
    {
        $form = Form::with('steps.fields')->findOrFail($id);
        return [
            'form' => $form,
        ];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Save')
                ->icon('check')
                ->method('save')
        ];
    }

    public function layout(): array
    {
        return [
            Layout::view('vendor.platform.form-edit', ['form' => $this->form]), // View dosyasını ekliyoruz
        ];
    }

    public function save(Request $request, $id)
    {
        $form = Form::findOrFail($id);

        // Form adını güncelle
        $form->update(['name' => $request->input('form_name'),
            'private_form'=>$request->input('private_check',0),
            'blade_name'=>$request->input('blade_name')
        ]);

        // Varolan step ve field verilerini güncelle veya sil
        $existingStepIds = $form->steps()->pluck('id')->toArray();

        if ($request->has('steps')) {
            foreach ($request->input('steps') as $stepIndex => $stepData) {
                $step = FormStep::updateOrCreate(
                    ['id' => $stepData['id'] ?? null],
                    [
                        'form_id' => $form->id,
                        'step_name' => $stepData['step_name'],
                        'order' => $stepIndex,

                    ]
                );

                // Step ile ilişkili field'ları güncelle veya oluştur
                $existingFieldIds = $step->fields()->pluck('id')->toArray();
                if (isset($stepData['fields']) && is_array($stepData['fields'])) {

                    foreach ($stepData['fields'] as $fieldIndex => $fieldData) {

                        FormField::updateOrCreate(
                            ['id' => $fieldData['id'] ?? null],
                            [
                                'form_step_id' => $step->id,
                                'label' => $fieldData['label'],
                                'type' => $fieldData['type'],
                                'rules' => $fieldData['rules'],
                                'order' => $fieldIndex,
                                'publish'=>isset($fieldData['publish']) ?$fieldData['publish'] : 0,
                                'other_config' => isset($fieldData['config']) ? json_decode($fieldData['config'], true) : null, // JSON alanı ekleniyor

                            ]
                        );

                        // Field ID'yi listeye ekleyin
                        if (isset($fieldData['id'])) {
                            $existingFieldIds = array_diff($existingFieldIds, [$fieldData['id']]);
                        }
                    }
                }

                // Artık kullanılmayan field'ları sil
                FormField::whereIn('id', $existingFieldIds)->delete();

                // Step ID'yi listeye ekleyin
                if (isset($stepData['id'])) {
                    $existingStepIds = array_diff($existingStepIds, [$stepData['id']]);
                }
            }
        }

        // Artık kullanılmayan step'leri sil
        FormStep::whereIn('id', $existingStepIds)->delete();

        Alert::info('Form updated successfully!');

        // İşlem tamamlandıktan sonra sayfayı yeniden yükleyin veya yönlendirin
        return redirect()->route('platform.forms.edit', $id);
    }




}
