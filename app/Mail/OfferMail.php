<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OfferMail extends Mailable
{
    use Queueable, SerializesModels;

    public $publishedFields;
    public $offer;

    /**
     * Create a new message instance.
     *
     * @param array $productDetails
     * @param string $offerLink
     */
    public function __construct($data)
    {
        $formData = json_decode($data['application']->form_data, true);

        // Sadece publish:1 olan alanları filtrele ve formatlı array'e dönüştür
        $this->publishedFields = [];
        if (isset($formData['fields'])) {
            foreach ($formData['fields'] as $step => $fields) {
                foreach ($fields as $fieldId => $field) {
                    if (isset($field['publish']) && $field['publish'] === 1) {
                        $this->publishedFields[] = [
                            'label' => $field['label'],
                            'value' => $field['value'] ?? '-'
                        ];
                    }
                }
            }
        }

        $this->offer = $data['offer'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.offer');
    }
}
