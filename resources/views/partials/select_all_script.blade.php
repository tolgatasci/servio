@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var selectElement = document.querySelector('.selected-requests');
            if (selectElement && selectElement.tomselect) {
                var tomSelectInstance = selectElement.tomselect;

                tomSelectInstance.on('change', function() {
                    var selectedOptions = tomSelectInstance.getValue();
                    var allSelected = selectedOptions.includes('all');

                    if (allSelected) {
                        // 'all' değerini hariç tutarak tüm seçeneklerin değerlerini al
                        var allValues = Object.keys(tomSelectInstance.options).filter(function(value) {
                            return value !== 'all';
                        });
                        // Tümünü seç (silent modda)
                        tomSelectInstance.setValue(allValues, true);
                    } else {
                        // 'all' değerini seçili değerlerden kaldır
                        var filteredValues = selectedOptions.filter(function(value) {
                            return value !== 'all';
                        });
                        tomSelectInstance.setValue(filteredValues, true);
                    }
                });
            }
        });


    </script>
@endpush
