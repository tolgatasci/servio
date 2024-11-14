<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceRequest;
use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
class ServiceController extends Controller
{

    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('services.show', compact('service'));
    }

    public function apply()
    {
        $services = Service::all(); // Hizmet listesini getiriyoruz.
        return view('services.forms.apply', compact('services'));
    }

    // Adım 1: Hizmet Seçimi Formu Gösterimi
    public function create_service()
    {
        $services = Service::all();
        return view('services.register.select-service', compact('services'));
    }

    // Adım 1: Hizmet Seçimi Verilerinin İşlenmesi
    public function select_service(Request $request)
    {
        $request->validate([
            'service' => 'required|string',
        ]);

        // Session'a veriyi kaydet
        Session::put('service', $request->service);

        return redirect()->route('services.step.select_entity_type');
    }

    // Adım 2: Şahıs/Şirket Seçimi Formu Gösterimi
    public function select_entity_type()
    {
        return view('services.register.select_entity_type');
    }

    public function select_entity_type_post(Request $request)
    {
        $request->validate([
            'entity_type' => 'required|string',
        ]);

        Session::put('entity_type', $request->entity_type);

        if($request->entity_type == "individual"){
            return redirect()->route('services.step.individual');
        }else{
            return redirect()->route('services.step.company');
        }


    }
    public function individual()
    {
        return view('services.register.individual');
    }

    public function individual_post(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
        ]);

        Session::put('name', $request->name);
        Session::put('surname', $request->surname);

        return redirect()->route('services.step.select_address');

    }

    public function company()
    {
        return view('services.register.company');
    }

    public function company_post(Request $request)
    {

        $request->validate([
            'company_name' => 'required|string|max:255',
            'salutation' => 'required|in:Mr,Ms',  // Validating salutation to ensure it's either Mr or Ms
            'contact_person' => 'required|string|max:255',
            'phone' => 'required|string|min:10|max:15', // Assuming phone numbers can have 10-15 characters
            'fax' => 'nullable|string|min:10|max:15',  // Fax is optional
            'website' => 'nullable|url|max:255',  // Website URL validation, optional
            'company_size' => 'required|in:large_company,specialized_provider',  // Radio button for company size must have a valid value
        ]);

        Session::put('company_name', $request->company_name);
        Session::put('salutation', $request->salutation);
        Session::put('contact_person', $request->contact_person);
        Session::put('phone', $request->phone);
        Session::put('fax', $request->fax);
        Session::put('website', $request->website);
        Session::put('company_size', $request->company_size);

        return redirect()->route('services.step.select_address');

    }


    public function select_address()
    {
        $countries = [
            'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Argentina', 'Armenia', 'Australia', 'Austria',
            'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin',
            'Bhutan', 'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso',
            'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile',
            'China', 'Colombia', 'Comoros', 'Congo (Congo-Brazzaville)', 'Costa Rica', 'Croatia', 'Cuba', 'Cyprus',
            'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador',
            'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini (Swaziland)', 'Ethiopia', 'Fiji', 'Finland', 'France',
            'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau',
            'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel',
            'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kuwait', 'Kyrgyzstan', 'Laos',
            'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar',
            'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico',
            'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar (Burma)', 'Namibia',
            'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Korea', 'North Macedonia',
            'Norway', 'Oman', 'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland',
            'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines',
            'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone',
            'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Korea', 'South Sudan',
            'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania',
            'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu',
            'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States of America', 'Uruguay', 'Uzbekistan',
            'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
        ];
        return view('services.register.select-address',compact('countries'));
    }

    public function select_address_post(Request $request)
    {

        $request->validate([
            'country' => 'required|string',
            'city' => 'required|string',
            'district' => 'required|string',
        ]);

        Session::put('country', $request->country);
        Session::put('city', $request->city);
        Session::put('district', $request->district);
        return redirect()->route('services.step.upload_profil_photo');

    }
    public function upload_profil_photo()
    {
        if (!auth()->check()) {
            session(['redirect_from_service' => url()->current()]);

            return redirect()->route('login');
        }
        return view('services.register.upload_profil_photo');
    }
    public function upload_profil_photo_post(Request $request)
    {

        // Validate the uploaded file
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image
        ]);

        // Store the image in the 'public/profil_photos' directory
        $path = $request->file('photo')->store('public/profil_photos');

        // Generate a URL for the stored image
        $profile_image_url = Storage::url($path);

        // Save the profile image URL in the session
        Session::put('profil_image', $profile_image_url);

        // Optional: Save the image URL in the database if required
        // Auth::user()->update(['profile_image' => $profile_image_url]);

        return redirect()->route('services.step.introduction') // Redirect to the next step
        ->with('status', 'Profile photo uploaded successfully!');

    }
    public function introduction()
    {
        return view('services.register.introduction');
    }

    public function introduction_post(Request $request)
    {

        $request->validate([
            'description' => 'required|string',

        ]);

        Session::put('description', $request->description);
        return redirect()->route('services.step.upload_photos');
    }
    public function upload_photos()
    {
        return view('services.register.upload_photos');
    }

    public function upload_photos_post(Request $request)
    {

        // Resimleri doğrulama: En fazla 10 resim, her biri maksimum 2MB boyutunda olmalı
        $request->validate([
            'photos' => 'nullable|array|max:10', // En fazla 10 resim
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Her bir dosyayı doğrula
        ]);

        // Resim URL'lerini saklayacağımız bir dizi
        $photoUrls = [];

        // Resimleri döngüyle işleme
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                // Resmi 'public/profil_photos' klasörüne yükle
                $path = $photo->store('public/profil_photos');

                // Yüklenen dosyanın URL'sini al
                $photoUrls[] = Storage::url($path);
            }
        }

        // Resim URL'lerini session'a array olarak kaydet
        Session::put('photos', $photoUrls);



        // Individual ya da Company olup olmadığını session'dan al
        $entity_type = Session::get('entity_type');

        // Yeni bir service_request kaydı oluştur
        $serviceRequest = new ServiceRequest();
        $serviceRequest->service_id = Session::get('service');
        $serviceRequest->entity_type = $entity_type;

        if ($entity_type === 'individual') {
            // Eğer individual ise, name ve surname'yi kaydet
            $serviceRequest->name = Session::get('name');
            $serviceRequest->surname = Session::get('surname');
        } else if ($entity_type === 'company') {
            // Eğer company ise, şirket bilgilerini kaydet
            $serviceRequest->company_name = Session::get('company_name');
            $serviceRequest->salutation = Session::get('salutation');
            $serviceRequest->contact_person = Session::get('contact_person');
            $serviceRequest->phone = Session::get('phone');
            $serviceRequest->fax = Session::get('fax');
            $serviceRequest->website = Session::get('website');
            $serviceRequest->company_size = Session::get('company_size');
        }

        // Ortak alanlar (country, city, district, profile_image, description, photos)
        $serviceRequest->country = Session::get('country');
        $serviceRequest->city = Session::get('city');
        $serviceRequest->district = Session::get('district');
        $serviceRequest->profile_image = Session::get('profil_image');
        $serviceRequest->description = Session::get('description');

        // Fotoğrafları JSON olarak kaydet
        $photos = Session::get('photos');
        if ($photos) {
            $serviceRequest->photos = json_encode($photos);
        }

        // Kaydet
        $serviceRequest->save();

        Session::forget([
            'service',
            'entity_type',
            'name',
            'surname',
            'company_name',
            'salutation',
            'contact_person',
            'phone',
            'fax',
            'website',
            'company_size',
            'country',
            'city',
            'district',
            'profil_image',
            'description',
            'photos'
        ]);


        return redirect()->route('services.step.finish');
    }

    public function finish()
    {
        return view('services.register.finish');
    }

    public function finish_post(Request $request)
    {


        return redirect()->route('home');
    }

}
