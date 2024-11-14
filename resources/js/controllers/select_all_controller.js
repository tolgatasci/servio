import { Controller } from 'stimulus';

export default class extends Controller {
    connect() {
        const selectElement = this.element.querySelector('select');

        selectElement.addEventListener('change', (event) => {
            const options = Array.from(selectElement.options);
            const allSelected = event.target.value.includes('all');

            if (allSelected) {
                // 'Tümünü Seç' seçeneği seçildiyse, diğer tüm seçenekleri seç
                selectElement.value = options.map(option => option.value);
            } else if (options[0].value === 'all' && !allSelected) {
                // 'Tümünü Seç' seçeneği kaldırıldıysa, onu seçimlerden çıkar
                const values = selectElement.value.filter(value => value !== 'all');
                selectElement.value = values;
            }
        });
    }
}
