<?php
namespace App\Orchid\Screens;

use App\Models\ServiceRequest;
use App\Orchid\Filters\ServiceRequestStatusFilter;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Layout;
use Orchid\Filters\Filter;
use Illuminate\Support\Carbon;
use Orchid\Support\Facades\Alert;

class ServiceRequestListScreen extends Screen
{
    public $name = 'Service Requests';
    public $description = 'List of service requests with filtering and sorting options';

    // Query method to get data with filters
    public function query(): array
    {
        return [
            'serviceRequests' => ServiceRequest::filters() // Filtrelerin uygulanması
            ->filtersApply([ServiceRequestStatusFilter::class]) // StatusFilter burada ekleniyor
            ->defaultSort('created_at', 'desc')
                ->paginate(),
        ];
    }

    // Command bar (buttons)
    public function commandBar(): array
    {
        return [
            Link::make('Create New Request')
                ->icon('plus')
                ->route('platform.service-request.create'),
        ];
    }

    // Layout for displaying the table with filters
        public function layout(): array
    {
        return [
            Layout::selection([ // Filtrelerin burada tanımlandığından emin olun
                ServiceRequestStatusFilter::class,
            ]),
            Layout::table('serviceRequests', [
                TD::make('id', 'ID')
                    ->sort(),
                TD::make('service_id', 'Service')
                    ->render(function ($serviceRequest) {

                        return $serviceRequest->service->name;
                    })
                    ->sort(),
                TD::make('entity_type', 'Type')
                    ->sort(),
                TD::make('name', 'Name')
                    ->sort(),
                TD::make('company_name', 'Company Name')
                    ->sort(),
                TD::make('status', 'Status')->render(function ($serviceRequest) {
                    return ucfirst($serviceRequest->status);
                })->sort(),
                TD::make('created_at', 'Created At')
                    ->render(function ($serviceRequest) {
                        return Carbon::parse($serviceRequest->created_at)->format('d M Y');
                    })
                    ->sort(),
                TD::make('Actions')
                    ->render(function ($serviceRequest) {
                        // Approve button
                        $approveButton = Button::make('Approve')
                            ->icon('check')
                            ->method('approve') // Method is specified here
                            ->parameters(['id' => $serviceRequest->id]) // Pass the request id to the method
                            ->canSee($serviceRequest->status === 'pending')
                            ->confirm('Are you sure you want to approve this service request?');

                        // Reject button
                        $rejectButton = Button::make('Reject')
                            ->icon('close')
                            ->method('reject') // Method is specified here
                            ->parameters(['id' => $serviceRequest->id]) // Pass the request id to the method
                            ->canSee($serviceRequest->status === 'pending')
                            ->confirm('Are you sure you want to reject this service request?');

                        // View button for displaying details
                        $viewButton = Link::make('View')
                            ->icon('eye')
                            ->route('platform.service-requests.detail', $serviceRequest->id);

                        // Return all buttons
                        return "<div style='display: flex; gap: 10px;'>{$approveButton}{$rejectButton}{$viewButton}</div>";
                    }),
            ]),
        ];
    }

    public function approve($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = 'approved';
        $serviceRequest->save();

        Alert::info('The service request has been approved.');

        return redirect()->route('platform.service-requests');
    }

    public function reject($id)
    {
        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = 'rejected';
        $serviceRequest->save();

        Alert::info('The service request has been rejected.');

        return redirect()->route('platform.service-requests');
    }
}
