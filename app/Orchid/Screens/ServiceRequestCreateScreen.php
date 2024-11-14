<?php
namespace App\Orchid\Screens;

use Orchid\Screen\Screen;
use App\Models\ServiceRequest;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Alert;

class ServiceRequestCreateScreen extends Screen
{
    public $name = 'Create New Service Request';

    public function query(): array
    {
        return [];
    }

    public function commandBar(): array
    {
        return [
            Button::make('Create')
                ->icon('plus')
                ->method('create'),
        ];
    }

    public function layout(): array
    {
        return [
            Layout::rows([
                Input::make('serviceRequest.service_id')
                    ->title('Service ID')
                    ->placeholder('Enter Service ID'),

                Input::make('serviceRequest.entity_type')
                    ->title('Entity Type')
                    ->placeholder('Enter Entity Type'),

                // Add other fields as needed
            ]),
        ];
    }

    public function create()
    {
        // Logic for creating a new service request
        $data = request()->validate([
            'serviceRequest.service_id' => 'required',
            'serviceRequest.entity_type' => 'required',
        ]);

        ServiceRequest::create($data['serviceRequest']);

        Alert::info('Service Request Created Successfully.');

        return redirect()->route('platform.service-request.list');
    }
}
