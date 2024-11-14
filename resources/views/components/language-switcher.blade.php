<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="languageSwitcher" data-bs-toggle="dropdown" aria-expanded="false">
        <img src="/images/flags/{{ app()->getLocale() }}.png" alt="{{ app()->getLocale() }}" style="width: 20px;"> {{ config('app.languages')[app()->getLocale()] }}
    </button>
    <ul class="dropdown-menu" aria-labelledby="languageSwitcher">
        @foreach (config('app.languages') as $lang => $language)
            @if ($lang != app()->getLocale())
                <li>
                    <a class="dropdown-item" href="{{ route('lang.switch', $lang) }}">
                        <img src="/images/flags/{{ $lang }}.png" alt="{{ $lang }}" style="width: 20px;"> {{ $language }}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
</div>
