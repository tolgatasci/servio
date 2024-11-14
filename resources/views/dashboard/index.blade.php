<x-app-layout>
    <div class="container">
        @if(session('message'))
            <div class="alert alert-success">
                <div class="lh-1">
                    <h1 class="h6 mb-0 text-white lh-1">{{ session('message') }}</h1>
                </div>
            </div>
        @endif


        <div class="row">
            <div x-data="{ activeTab: 'incoming' }">
                <!-- Tab Menüsü -->
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <button class="nav-link" :class="activeTab === 'incoming' ? 'active' : ''" @click="activeTab = 'incoming'">
                            Gelen Teklifler ({{$incomingOffers->count()}})
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" :class="activeTab === 'outgoing' ? 'active' : ''" @click="activeTab = 'outgoing'">
                            Giden Teklifler ({{$outgoingOffers->count()}})
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" :class="activeTab === 'acceptedOffer' ? 'active' : ''" @click="activeTab = 'acceptedOffer'">
                            Kabul Edilen Teklifler ({{$acceptedOffer->count()}})
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" :class="activeTab === 'waitforoffer' ? 'active' : ''" @click="activeTab = 'waitforoffer'">
                            {{__('Waiting for offer')}} ({{$waitingforoffer->count()}})
                        </button>
                    </li>
                </ul>


            <!-- Tab İçerikleri -->
                <div class="mt-4">
                    <!-- Gelen Teklifler -->
                    <div x-show="activeTab === 'incoming'"  x-cloak class="tab-content mt-3">
                        @forelse($incomingOffers as $offer)
                            <div class="p-4 mb-4 bg-white shadow rounded">
                                <h3 class="text-lg font-semibold">{{ $offer->service->name }}</h3>
                                <p class="text-gray-600">Teklif Tutarı: {{ $offer->amount }}</p>
                                <p class="text-gray-600">Gönderen: {{ $offer->sender->name }}</p>
                                <p class="text-gray-600">Durum: {{ $offer->status }}</p>
                                <!-- Kabul Et ve Reddet Butonları -->
                                <form action="{{route('offer.decision.post',$offer->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button name="decision" value="accepted" class="btn btn-success">Kabul Et</button>
                                    <button name="decision" value="rejected" class="btn btn-danger">Reddet</button>

                                </form>
                            </div>
                        @empty
                            <p>Henüz gelen teklifiniz yok.</p>
                        @endforelse
                    </div>

                    <!-- Giden Teklifler -->
                    <div x-show="activeTab === 'outgoing'"  x-cloak class="tab-content mt-3">

                        @forelse($outgoingOffers as $offer)
                            <div class="p-4 mb-4 bg-white shadow rounded">
                                <h3 class="text-lg font-semibold">{{ $offer->service->name }}</h3>
                                <p class="text-gray-600">Teklif Tutarı: {{ $offer->amount }}</p>
                                <p class="text-gray-600">Alıcı: {{ $offer->receiver->name }}</p>
                                <p class="text-gray-600">Durum: {{ $offer->status }}</p>
                            </div>
                        @empty
                            <p>Henüz giden teklifiniz yok.</p>
                        @endforelse
                    </div>

                    <!-- Giden Kabul Edilen Teklifler -->
                    <div x-show="activeTab === 'acceptedOffer'"  x-cloak class="tab-content mt-3">

                        @forelse($acceptedOffer as $offer)
                            <div class="p-4 mb-4 bg-white shadow rounded">
                                <h3 class="text-lg font-semibold">{{ $offer->service->name }}</h3>
                                <p class="text-gray-600">Teklif Tutarı: {{ $offer->amount }}</p>
                                <p class="text-gray-600">Alıcı: {{ $offer->receiver->name }}</p>
                                <p class="text-gray-600">Durum: {{ $offer->status }}</p>

                                <a href="{{route('offer.give',$offer->id)}}" class="btn btn-outline-primary"
                                >{{__('View Detail')}}</a>
                            </div>

                        @empty
                            <p>Henüz giden teklifiniz yok.</p>
                        @endforelse
                    </div>
                    <!-- Gelen Teklifler -->
                    <div x-show="activeTab === 'waitforoffer'"  x-cloak class="tab-content mt-3">

                        @forelse($waitingforoffer as $offer)
                            <div class="p-4 mb-4 bg-white shadow rounded">
                                <h3 class="text-lg font-semibold">{{ $offer->service->name }}</h3>

                                <a href="{{route('offer.give',$offer->id)}}" class="btn btn-outline-primary"
                                >{{__('View Detail')}}</a>
                            </div>
                        @empty
                            <p>Henüz gelen teklifiniz yok.</p>
                        @endforelse
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
