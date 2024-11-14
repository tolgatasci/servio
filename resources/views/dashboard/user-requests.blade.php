<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0">{{ __('My Service Requests') }}</h5>
        <a href="{{ route('service-request.create') }}" class="btn btn-primary btn-sm">
            {{ __('New Request') }}
        </a>
    </div>
    <div class="card-body">
        @forelse($serviceRequests as $request)
            <div class="border-bottom mb-3 pb-3">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h6 class="mb-1">{{ $request->service->name }}</h6>
                        <p class="text-muted small mb-0">
                            {{ $request->entity_type === 'company' ? $request->company_name : $request->name . ' ' . $request->surname }}
                        </p>
                    </div>
                    <div class="col-md-3">
                        <div class="text-muted small">
                            <i class="fas fa-calendar-alt me-1"></i>
                            {{ $request->created_at->format('d M Y') }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        @switch($request->status)
                            @case('pending')
                                <span class="badge bg-warning text-dark">{{ __('Onay Bekliyor') }}</span>
                                @break
                            @case('approved')
                                <span class="badge bg-success">{{ __('Onaylandı') }}</span>
                                @break
                            @case('rejected')
                                <span class="badge bg-danger">{{ __('Reddedildi') }}</span>
                                @break
                        @endswitch
                    </div>
                    <div class="col-md-2 text-end">
                        <a href="{{ route('service-request.show', $request->id) }}"
                           class="btn btn-outline-secondary btn-sm">
                            {{ __('Details') }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-4">
                <div class="mb-3">
                    <i class="fas fa-inbox fa-3x text-muted"></i>
                </div>
                <p class="text-muted mb-0">{{ __('Henüz bir servis başvurunuz bulunmuyor.') }}</p>
            </div>
        @endforelse

        <div class="d-flex justify-content-center">
            {{ $serviceRequests->links() }}
        </div>
    </div>
</div>
