<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceApplyController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PostController;
// Oturum açma rotalarını özelleştiriyoruz
Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login');
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Mail\OfferMail;
use Illuminate\Support\Facades\Mail;

Route::get('/send-offer-mail', function () {
    $productDetails = [
        ['name' => 'Product 1', 'size' => 'Large'],
        ['name' => 'Product 2', 'size' => 'Medium'],
    ];

    $offerLink = 'https://example.com/submit-offer';

    Mail::to('tolgatasci1@gmail.com')->send(new OfferMail($productDetails, $offerLink));

    return "Offer mail sent successfully!";
});

Route::get('lang/{locale}', [App\Http\Controllers\LanguageController::class, 'switchLang'])->name('lang.switch');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/offer/give/{id}', [HomeController::class, 'give_offer'])->name('offer.give');
Route::post('/offer/give/{id}', [HomeController::class, 'give_offer_post'])->name('offer.give.post');
Route::put('/offer/decision/{id}', [HomeController::class, 'decision_offer_post'])->name('offer.decision.post');



Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'index'])->name('category.show');

Route::get('/service/{id}', [ServiceController::class, 'show'])->name('service.show');

/* Service Form */
Route::get('/services/register', [ServiceController::class, 'create_service'])->name('services.step.create');
Route::post('/services/create', [ServiceController::class, 'select_service'])->name('services.step.select-service.post');

Route::get('/services/select-entity-type', [ServiceController::class, 'select_entity_type'])->name('services.step.select_entity_type');
Route::post('/services/select-entity-type', [ServiceController::class, 'select_entity_type_post'])->name('services.step.select_entity_type.post');

Route::get('/services/individual', [ServiceController::class, 'individual'])->name('services.step.individual');
Route::post('/services/individual', [ServiceController::class, 'individual_post'])->name('services.step.individual.post');

Route::get('/services/company', [ServiceController::class, 'company'])->name('services.step.company');
Route::post('/services/company', [ServiceController::class, 'company_post'])->name('services.step.company.post');

Route::get('/services/select-address', [ServiceController::class, 'select_address'])->name('services.step.select_address');
Route::post('/services/select-address', [ServiceController::class, 'select_address_post'])->name('services.step.select_address.post');


Route::get('/services/upload-profil-photo', [ServiceController::class, 'upload_profil_photo'])->name('services.step.upload_profil_photo');
Route::post('/services/upload-profil-photo', [ServiceController::class, 'upload_profil_photo_post'])->name('services.step.upload_profil_photo.post');

Route::get('/services/introduction', [ServiceController::class, 'introduction'])->name('services.step.introduction')->middleware('auth');
Route::post('/services/introduction', [ServiceController::class, 'introduction_post'])->name('services.step.introduction.post')->middleware('auth');

Route::get('/services/upload-photos', [ServiceController::class, 'upload_photos'])->name('services.step.upload_photos');
Route::post('/services/upload-photos', [ServiceController::class, 'upload_photos_post'])->name('services.step.upload_photos.post');


Route::get('/services/finish', [ServiceController::class, 'finish'])->name('services.step.finish');
Route::post('/services/finish', [ServiceController::class, 'finish_post'])->name('services.step.finish.post');

Route::get('/service/{service}/apply', [ServiceApplyController::class, 'apply'])->name('service.apply');
Route::post('/service/{service}/apply', [ServiceApplyController::class, 'submitApplication'])->name('service.apply.store');
Route::post('/service/{id}/apply', [ServiceApplyController::class, 'submitApplication'])->name('service.apply.submit');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');


Route::post('/apply/stand/{service_id}', [ServiceApplyController::class, 'submitStand'])->name('private.form.stand');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\HomeController::class,'dashboard'])->name('dashboard');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard/incoming', [HomeController::class, 'incoming'])->name('dashboard.incoming');
    Route::get('/dashboard/outgoing', [HomeController::class, 'outgoing'])->name('dashboard.outgoing');
    Route::get('/dashboard/accepted', [HomeController::class, 'accepted'])->name('dashboard.accepted');
    Route::get('/dashboard/waiting', [HomeController::class, 'waiting'])->name('dashboard.waiting');

    // Offer işlemleri için route'lar
    Route::put('/offers/{offer}/decision', [HomeController::class, 'decision_offer_post'])->name('offer.decision.post');
    Route::get('/offers/{offer}/detail', [HomeController::class, 'give_offer'])->name('offer.give');
    Route::post('/offers/{offer}/give', [HomeController::class, 'give_offer_post'])->name('offer.give.post');
});