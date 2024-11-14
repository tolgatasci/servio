<div class="container">
    <h3>Başvuru Detayları</h3>

    @php
        $formData = json_decode($application->form_data, true);
    @endphp

    @foreach($formData['fields'] as $step => $fields)
        @foreach($fields as $fieldId => $field)
            <div class="mb-3">
                <strong>{{ $field['label'] }}:</strong>

                @if(isset($field['type']) && $field['type'] === 'file')
                    @if(Storage::exists($field['value']))
                        <div class="mt-2">
                            @if(Str::endsWith(strtolower($field['value']), ['.jpg', '.jpeg', '.png', '.gif']))
                                <img src="{{ Storage::url($field['value']) }}" alt="{{ $field['label'] }}" class="img-fluid" style="max-width: 150px;">
                            @else
                                <a href="{{ Storage::url($field['value']) }}" target="_blank" class="btn btn-sm btn-primary">
                                    Dosyayı İndir
                                </a>
                            @endif
                        </div>
                    @else
                        <span class="text-muted">Dosya bulunamadı</span>
                    @endif

                @elseif(isset($field['type']) && $field['type'] === 'files')
                    @if(is_array($field['value']))
                        <ul class="list-unstyled mt-2">
                            @foreach($field['value'] as $file)
                                <li>
                                    @if(Storage::exists($file))
                                        <a href="{{ Storage::url($file) }}" target="_blank" class="btn btn-sm btn-primary mb-2">
                                            Dosyayı İndir
                                        </a>
                                    @else
                                        <span class="text-muted">Dosya bulunamadı: {{ basename($file) }}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                @else
                    <span>{{ $field['value'] ?? '-' }}</span>
                @endif
            </div>
        @endforeach
    @endforeach
</div>