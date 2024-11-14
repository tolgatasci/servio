<?php
namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Facades\Validator;

class ServiceApplyController extends Controller
{
    public function apply($serviceId)
    {
        $service = Service::with('form.steps.fields')->findOrFail($serviceId);

        if (!$service->form) {
            // Eğer form bulunmazsa kullanıcıya bir mesaj gösterin veya başka bir işlem yapın
            return redirect()->back()->with('error', 'Form is not defined for this service.');
        }

        $form = $service->form;

        if($form->private_form){
            return view('forms.'.$form->blade_name, compact('service', 'form', 'serviceId'));
        }

        return view('services.apply.apply', compact('service', 'form'));
    }


    public function submitApplication(Request $request, $id)
    {
        // İlgili servisi ve formu buluyoruz
        $service = Service::with('form.steps.fields')->findOrFail($id);

        if (!$service->form) {
            return redirect()->back()->withErrors('Bu hizmetle ilişkili bir form bulunamadı.');
        }

        $form = $service->form;

        // Dinamik doğrulama kuralları ve attribute isimleri oluşturuluyor
        $validationRules = [];
        $attributeNames = [];


        foreach ($form->steps as $stepIndex => $step) {
            foreach ($step->fields as $field) {
                // fieldName'i adım ve field ID'sine göre oluşturuyoruz
                $fieldName = "fields.step_{$stepIndex}.{$field->id}";

                // Doğrulama kurallarını ekliyoruz
                $validationRules[$fieldName] = $field->rules ?: 'required';

                // Attribute isimlerini ekliyoruz
                $attributeNames["fields"]["step_{$stepIndex}"][$field->id] = ["label"=>$field->label,"publish"=>$field->publish];

            }
        }


        // Validator'ı manuel olarak oluşturuyoruz
        $validator = Validator::make($request->all(), $validationRules);

        // Attribute isimlerini ayarlıyoruz
        $validator->setAttributeNames($attributeNames);

        // Doğrulama işlemi
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $validatedData = $validator->validated();
        $all_data = [];

        foreach($validatedData as $key=> $v){
            foreach($v as $kk=>$vv){
                foreach($vv as $kkk => $vvv){
                    $all_data[$key][$kk][$kkk]= ["value"=>$vvv];

                    $all_data[$key][$kk][$kkk] = array_merge($all_data[$key][$kk][$kkk],$attributeNames[$key][$kk][$kkk]);
                }


            }

        }

        // Verileri kaydetme işlemi
        Application::create([
            'service_id' => $service->id,
            'form_id' => $form->id,
            'user_id' => auth()->id(),
            'form_data' => json_encode($all_data),
        ]);

        return redirect()->route('service.show', ['id' => $id])
            ->with('success', __('Your application has been sent successfully.'));
    }

    public function submitStand($service_id, Request $request)
    {
        // Get form data excluding tokens and files
        $formData = $request->except(['_token', 'company_logo', 'uploads']);

        // Initialize the structured data array
        $all_data = [
            'fields' => [
                'step_0' => [] // Since stand form is single step
            ]
        ];

        // Convert each field to the standardized format
        $fieldId = 1; // Starting field ID
        foreach ($formData as $key => $value) {
            $isPrivate = in_array($key, ['company_name', 'company_address', 'email']);
            $publishMail = in_array($key, ['fuar_name', 'stant_sure', 'fuar_yer', 'fuar_date']);

            $all_data['fields']['step_0'][$fieldId] = [
                'value' => $value,
                'label' => ucfirst(str_replace('_', ' ', $key)), // Convert field name to label
                'publish' => $publishMail ? 1 : 0
            ];
            $fieldId++;
        }

        // Handle file uploads
        if ($request->hasFile('company_logo')) {
            $logoPath = $request->file('company_logo')->store('logos', 'public');
            $all_data['fields']['step_0'][$fieldId++] = [
                'value' => $logoPath,
                'label' => 'Company Logo',
                'publish' => 0,
                'type' => 'file'
            ];
        }

        if ($request->hasFile('uploads')) {
            $uploadedFiles = [];
            foreach ($request->file('uploads') as $file) {
                $uploadedFiles[] = $file->store('uploads', 'public');
            }
            $all_data['fields']['step_0'][$fieldId++] = [
                'value' => $uploadedFiles,
                'label' => 'Additional Files',
                'publish' => 0,
                'type' => 'files'
            ];
        }

        // Create the application
        $insert = Application::create([
            'form_data' => json_encode($all_data),
            'service_id' => $service_id,
            'user_id' => Auth::check() ? Auth::user()->id : null,
        ]);

        return redirect()->route('service.show', ['id' => $service_id])
            ->with('success', __('Your application has been sent successfully.'));
    }

}
