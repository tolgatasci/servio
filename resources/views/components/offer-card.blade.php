@props(['offer'])
<div class="card mb-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-start">
            <div>
                <h3 class="h5 mb-2">{{ $offer->service->name }}</h3>
                <p class="text-muted mb-1">Teklif Tutarı: {{ $offer->amount }} TL</p>

                @if(isset($offer->sender))
                    <p class="text-muted mb-1">Gönderen: {{ $offer->sender->name }}</p>
                @endif

                @if(isset($offer->receiver))
                    <p class="text-muted mb-1">Alıcı: {{ $offer->receiver->name }}</p>
                @endif

                <p class="text-muted mb-0">Durum:
                    <span class="badge bg-{{ $offer->status_color }}">
                        {{ $offer->status }}
                    </span>
                </p>
            </div>

            <div>
                {{ $actions ?? '' }}
            </div>
        </div>
    </div>
</div>