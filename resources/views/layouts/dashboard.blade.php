<x-app-layout>
    <div class="container py-4">
        @if(session('message'))
            <div class="alert alert-success mb-4">
                <div class="lh-1">
                    <h1 class="h6 mb-0 text-white lh-1">{{ session('message') }}</h1>
                </div>
            </div>
        @endif

        <!-- Teklifler Card'ı -->
        <div class="card mb-4">
            <div class="card-header bg-white">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.incoming') ? 'active' : '' }}"
                           href="{{ route('dashboard.incoming') }}">
                            Gelen Teklifler ({{ $incomingCount }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.outgoing') ? 'active' : '' }}"
                           href="{{ route('dashboard.outgoing') }}">
                            Giden Teklifler ({{ $outgoingCount }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.accepted') ? 'active' : '' }}"
                           href="{{ route('dashboard.accepted') }}">
                            Kabul Edilen Teklifler ({{ $acceptedCount }})
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard.waiting') ? 'active' : '' }}"
                           href="{{ route('dashboard.waiting') }}">
                            {{__('Waiting for offer')}} ({{ $waitingCount }})
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body">
                {{ $slot }}
            </div>
        </div>

        <!-- Service Requests Card'ı -->
        @if($serviceRequests->isNotEmpty())
                <div class="card">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ __('My Service Requests') }}</h5>
                        <a href="{{ route('services.step.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-lg"></i> {{ __('New Service Request') }}
                        </a>
                    </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                            <tr>
                                <th>{{ __('Service') }}</th>
                                <th>{{ __('Type') }}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Date') }}</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($serviceRequests as $request)
                                <tr>
                                    <td>
                                        <div class="fw-medium">{{ $request->service->name }}</div>
                                        <small class="text-muted">
                                            @if($request->entity_type === 'company')
                                                {{ $request->company_name }}
                                            @else
                                                {{ $request->name }} {{ $request->surname }}
                                            @endif
                                        </small>
                                    </td>
                                    <td>
                                            <span class="badge bg-light text-dark">
                                                {{ ucfirst($request->entity_type) }}
                                            </span>
                                    </td>
                                    <td>
                                        @switch($request->status)
                                            @case('pending')
                                                <span class="badge bg-warning text-dark">{{ __('Onay Bekliyor') }}</span>
                                                @break
                                            @case('approved')
                                                <span class="badge bg-success">{{ __('Accepted') }}</span>
                                                @break
                                            @case('rejected')
                                                <span class="badge bg-danger">{{ __('Denied') }}</span>
                                                @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $request->created_at->format('d M Y') }}
                                        </small>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @if($serviceRequests->hasPages())
                    <div class="card-footer bg-white">
                        {{ $serviceRequests->links() }}
                    </div>
                @endif
            </div>
        @endif
    </div>
</x-app-layout>