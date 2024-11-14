<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Http\Request;

class RedirectAfterLogin
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  Authenticated  $event
     * @return void
     */
    public function handle(Authenticated $event)
    {
        // Eğer session'da 'redirect_from_service' varsa, yönlendirme yap
        if ($this->request->session()->has('redirect_from_service')) {
            $redirectUrl = $this->request->session()->get('redirect_from_service');
            $this->request->session()->forget('redirect_from_service'); // Yönlendirdikten sonra session'ı temizleyin.
            return redirect()->to($redirectUrl);
        }
    }
}
