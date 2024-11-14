<x-app-layout>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Üst Bilgi Kartı -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="mb-1">{{ $offer->service->name }}</h4>
                                <p class="text-muted mb-0">
                                    {{ __('Request from') }} {{ $offer->receiver->name }}
                                </p>
                            </div>
                            <div class="text-end">
                                @if(empty($offer->amount))
                                    <span class="badge bg-warning text-dark">{{ __('Waiting for Offer') }}</span>
                                @else
                                    <span class="badge bg-success">{{ __('Offer Submitted') }}</span>
                                    <h5 class="mt-2 mb-0">{{ number_format($offer->amount, 2) }} TL</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bilgi Notu -->
                @if(empty($offer->amount))
                    <div class="alert alert-info border-0 shadow-sm mb-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="fas fa-info-circle fa-lg mt-1"></i>
                            </div>
                            <div class="ms-3">
                                <h6 class="mb-1">{{ __('Important Note') }}</h6>
                                <p class="mb-0">{{ __('Only necessary information is provided. You can make an offer based on this.') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form Bilgileri -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0">{{ __('Request Details') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach($application_data['fields'] as $key => $field)
                                @foreach($field as $k => $v)
                                    @if($v['publish'] or !empty($offer->amount))
                                        <div class="col-md-6">
                                            <div class="border rounded p-3 h-100 bg-light">
                                                <label class="form-label text-muted small mb-1">{{ $v['label'] }}</label>
                                                <div class="fw-medium">{{ $v['value'] ?: '-' }}</div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Teklif Formu -->
                @if(empty($offer->amount))
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0">{{ __('Submit Your Offer') }}</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('offer.give.post', $id) }}" method="POST">
                                @csrf
                                <div class="row align-items-end">
                                    <div class="col-md-6">
                                        <label for="amount" class="form-label">{{ __('Offer Amount') }}</label>
                                        <div class="input-group">
                                            <input type="number"
                                                   class="form-control form-control-lg @error('amount') is-invalid @enderror"
                                                   id="amount"
                                                   name="amount"
                                                   placeholder="0.00"
                                                   step="0.01"
                                                   required>
                                            <span class="input-group-text">TL</span>
                                        </div>
                                        @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary btn-lg w-100">
                                            {{ __('Submit Offer') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @push('styles')
        <style>
            .form-control-lg {
                height: 3.2rem;
                font-size: 1.1rem;
            }
            .bg-light {
                background-color: #f8f9fa !important;
            }
        </style>
    @endpush
</x-app-layout>