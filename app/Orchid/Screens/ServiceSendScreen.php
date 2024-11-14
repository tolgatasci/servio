<?php

namespace App\Orchid\Screens;

use App\Mail\OfferMail;
use App\Models\Application;
use App\Models\Offer;
use App\Models\ServiceRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;

class ServiceSendScreen extends Screen
{
    public $name = 'Application Send Companies';
    public $description = 'x';
    public $data;
    public function query($id): iterable
    {
        $data = [];
        $data["application"] = Application::findOrFail($id);
        $data["requests"] = ServiceRequest::where('service_id',$data["application"]->service_id)->get();

        $this->data = $data;
        return $data;
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'ServiceSendScreen';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Send')
                ->icon('check')
                ->method('send')
                ->parameters([
                    'id' => $this->data['application']->id,
                ]),
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
            Layout::rows([
                Select::make('selected_requests')
                    ->options($this->getSelectOptions())
                    ->multiple()
                    ->title('Select Requests')
                    ->help('Lütfen bir veya daha fazla isteği seçin')
                    ->value([])

                    ->class('selected-requests'),


            ]),
            Layout::view('partials.select_all_script'),
        ];
    }

    private function getSelectOptions()
    {
        $options = $this->data['requests']->pluck('name', 'id')->toArray();
        return ['all' => 'Tümünü Seç'] + $options;
    }

    public function send(Request $request)
    {
        $application = Application::findOrFail($request->id);

        foreach($request->selected_requests as $request_){
            $sender = ServiceRequest::find($request_);

            $json_data = json_decode($application->form_data);
            $data_show  = [];
            foreach($json_data as $data){
               foreach($data as $key => $item){
                   $data_show[] = ['key'=>$key,'value'=>$item];
               }
            }


            $offer = Offer::create([
                'service_id' => $application->service_id,
                'service_request_id' => $request_,
                'application_id' => $application->id,
                'sender_id' => $sender->user_id,
                'receiver_id' => $application->user_id,
                'status' => 'wfo',
            ]);

            Mail::to('tolgatasci1@gmail.com')->send(new OfferMail([
                "sender" => $sender->name,
                "application" => $application,
                "request" => $request_,
                "offer" => $offer,
                "data_show"=>$data_show
            ]));
        }


    }
}
