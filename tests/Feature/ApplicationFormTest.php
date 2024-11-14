<?php

namespace Tests\Feature;

use App\Models\Application;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
class ApplicationFormTest extends TestCase
{

    /**
     * A basic feature test example.
     *
     * @return void
     */

    /** @test */
    public function it_can_submit_form_with_valid_data()
    {
        // Dosya yükleme testi için storage'ı taklit et
        Storage::fake('public');
        $user = User::factory()->create();  // Laravel'in factory ile kullanıcı oluşturma metodu
        $this->actingAs($user);
        // Form verilerini hazırlayın
        $formData = [
            'service_id'=>1,

            'company_logo' => UploadedFile::fake()->image('logo.jpg'),  // Sahte bir dosya yüklemesi yapıyoruz
            'fuar_name' => 'Example Fair',
            'stant_sure' => '5 days',
            'fuar_yer' => 'Istanbul',
            'fuar_date' => '2024-10-15',
            'company_name' => 'Example Company',
            'company_address' => '1234 Example Street',
            'phone_fax' => '123-456-7890',
            'web' => 'https://example.com',
            'email' => 'contact@example.com',
            'contact_person' => 'John Doe',
            'stand_place' => 'Hall 5',
            'offene_seiten' => '2',
            'hallenplan' => 'on',
            'standmodel' => 'Modern',
            'zweistockig' => 'evet',
            'zweistockig_input' => 'Custom design',
            'besprechungsraum' => 'hayir',
            'lagerraum' => 'evet',
            'lagerraum_wunsch' => 'Small storage',
            'zemin' => 'teppich',
            'stant_still' => 'hayir',
            'info_masa' => 'evet',
            'bar' => 'hayir',
            'masalar' => 'evet',
            'masalar_input' => '4',
            'sandalyeler' => 'evet',
            'sandalyeler_input' => '8',
            'bar_taburesi' => 'evet',
            'bar_taburesi_input' => '3',
            'dijital_baski' => 'evet',
            'dijital_baski_input' => 'Large print',
            'tv' => 'hayir',
            'buzdolabi' => 'evet',
            'buzdolabi_input' => 'Mini fridge',
            'evye' => 'evet',
            'evye_input' => 'Custom sink',
            'budget' => '5000',
            'produkte' => 'Electronics, Gadgets',
            'weitere_wuensche' => 'Extra chairs needed',
            'uploads' => [UploadedFile::fake()->create('file1.pdf', 1000)]  // Sahte bir dosya yükleme
        ];

        // Formu gönder
        $response = $this->post(route('private.form.stand',['service_id'=>1]), $formData);




        // Başarılı bir şekilde yönlendirilip yönlendirilmediğini kontrol et
        $response->assertStatus(302);  // Redirect bekliyoruz
    }
}
