<?php

namespace App\View\Components;

use App\Models\Offer;
use App\Models\ServiceRequest;
use Illuminate\View\Component;

class DashboardLayout extends Component
{
    public $incomingCount;
    public $outgoingCount;
    public $acceptedCount;
    public $waitingCount;
    public $serviceRequests;

    public function __construct()
    {
        $this->incomingCount = Offer::where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->count();

        $this->outgoingCount = Offer::where('sender_id', auth()->id())
            ->where('status','pending')
            ->count();

        $this->acceptedCount = Offer::where(function($query) {
            $query->where('sender_id', auth()->id())
                ->orWhere('receiver_id', auth()->id());
        })
            ->where('status', 'accepted')
            ->count();

        $this->waitingCount = Offer::where('status', 'waiting')->count();

        // Service Requests'i layout seviyesinde yükle
        $this->serviceRequests = ServiceRequest::where('user_id', auth()->id())
            ->with('service')
            ->latest()
            ->paginate(5);
    }

    public function render()
    {
        return view('layouts.dashboard');
    }
}