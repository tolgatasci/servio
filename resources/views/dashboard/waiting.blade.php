<x-dashboard-layout>
    <div class="offers-list">
        @forelse($offers as $offer)
            <x-offer-card :offer="$offer">
                <x-slot name="actions">
                    <a href="{{ route('offer.give', $offer->id) }}"
                       class="btn btn-primary btn-sm">
                        {{__('View Detail')}}
                    </a>
                </x-slot>
            </x-offer-card>
        @empty
            <div class="text-center py-4">
                <p class="text-muted mb-0">Henüz bekleyen teklif bulunmuyor.</p>
            </div>
        @endforelse

        <div class="d-flex justify-content-center">
            {{ $offers->links() }}
        </div>
    </div>
</x-dashboard-layout>