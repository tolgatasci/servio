<x-dashboard-layout>
    <div class="offers-list">
        @forelse($offers as $offer)
            <x-offer-card :offer="$offer">
                <x-slot name="actions">
                    <form action="{{ route('offer.decision.post', $offer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="btn-group">
                            <button name="decision" value="accepted" class="btn btn-success btn-sm">
                                Kabul Et
                            </button>
                            <button name="decision" value="rejected" class="btn btn-danger btn-sm">
                                Reddet
                            </button>
                        </div>
                    </form>
                </x-slot>
            </x-offer-card>
        @empty
            <div class="text-center py-4">
                <p class="text-muted mb-0">Henüz gelen teklifiniz yok.</p>
            </div>
        @endforelse

        <div class="d-flex justify-content-center">
            {{ $offers->links() }}
        </div>
    </div>
</x-dashboard-layout>