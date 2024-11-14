<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Offer;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function index(){
        $fairs = \App\Models\Fair::all();
        $services = \App\Models\Service::all();
        $best_service = \App\Models\Service::where('id',1)->first();
        return view('home', compact('fairs','services','best_service'));
    }

    public function dashboard()
    {
        return redirect()->route('dashboard.incoming');
    }

    public function incoming()
    {
        $offers = Offer::with(['service', 'sender'])
            ->where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('dashboard.incoming', compact('offers'));
    }

    public function outgoing()
    {
        $offers = Offer::with(['service', 'receiver'])
            ->where('sender_id', auth()->id())
            ->whereIn('status', ['pending'])
            ->latest()
            ->paginate(10);

        return view('dashboard.outgoing', compact('offers'));
    }

    public function accepted()
    {
        $offers = Offer::with(['service', 'receiver', 'sender'])
            ->where(function($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            })
            ->where('status', 'accepted')
            ->latest()
            ->paginate(10);

        return view('dashboard.accepted', compact('offers'));
    }

    public function waiting()
    {
        $offers = Offer::with(['service'])
            ->where('status', 'wfo')  // 'waiting' yerine 'wfo' kullanıyorsunuz
            ->where('sender_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('dashboard.waiting', compact('offers'));
    }

    public function give_offer($id)
    {
        $currentUserId = auth()->id();
        $offer = Offer::where('sender_id', $currentUserId)
            ->where('id', $id)
            ->whereIn('status', ['wfo', 'accepted'])
            ->with(['service', 'receiver', 'application'])
            ->firstOrFail();

        $application_data = json_decode($offer->application->form_data, true);

        return view('offer.give', compact('offer', 'application_data', 'id'));
    }

    public function give_offer_post($id)
    {
        $currentUserId = auth()->id();
        $offer = Offer::where('sender_id', $currentUserId)
            ->where('id', $id)
            ->whereIn('status', ['wfo'])
            ->with(['service', 'receiver', 'application'])
            ->firstOrFail();

        $offer->status = 'pending';
        $offer->amount = request('amount');
        $offer->save();

        return redirect()->route('dashboard')
            ->with('message', 'Offer given successfully');
    }

    public function decision_offer_post($id)
    {
        $currentUserId = auth()->id();
        $decision = request('decision');

        $offer = Offer::where('receiver_id', $currentUserId)
            ->where('id', $id)
            ->where('status', 'pending')
            ->with(['service', 'receiver', 'application'])
            ->firstOrFail();

        if (!in_array($decision, ['accepted', 'rejected'])) {
            abort(400, 'Invalid decision');
        }

        $offer->status = $decision;
        $offer->save();

        $message = $decision === 'accepted' ? 'Teklif kabul edildi' : 'Teklif reddedildi';
        return redirect()->route('dashboard')
            ->with('message', $message);
    }
  



    public function updateStatus(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        // Yetkilendirme kontrolü
        if ($offer->receiver_id != auth()->id()) {
            abort(403, 'Bu teklifi güncelleme yetkiniz yok.');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $offer->status = $request->input('status');
        $offer->save();

        return redirect()->back()->with('success', 'Teklif durumu güncellendi.');
    }

}
