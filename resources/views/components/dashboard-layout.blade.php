<x-app-layout>
    <div class="container py-4">
        @if(session('message'))
            <div class="alert alert-success mb-4">
                <div class="lh-1">
                    <h1 class="h6 mb-0 text-white lh-1">{{ session('message') }}</h1>
                </div>
            </div>
        @endif

        <div class="card">
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
    </div>
</x-app-layout>