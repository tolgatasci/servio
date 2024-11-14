<?php

declare(strict_types=1);

use App\Orchid\Screens\ContactScreen;
use App\Orchid\Screens\ContactViewScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\FormCreateScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\ServiceRequestCreateScreen;
use App\Orchid\Screens\SubCategoriesEditScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use App\Orchid\Screens\ServiceRequestListScreen;
use App\Orchid\Screens\ServiceRequestDetailScreen;
use App\Orchid\Screens\ApplicationListScreen;
use App\Orchid\Screens\ApplicationViewScreen;
use App\Orchid\Screens\FairListScreen;
use App\Orchid\Screens\FairEditScreen;
use App\Orchid\Screens\SettingsScreen;
use App\Orchid\Screens\PostScreen;
use App\Orchid\Screens\PostEditScreen;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

use App\Orchid\Screens\FormListScreen;
use App\Orchid\Screens\FormEditScreen;

use App\Orchid\Screens\Categories;
use App\Orchid\Screens\CategoryEditScreen;
use App\Orchid\Screens\SubCategories;
Route::screen('categories', Categories::class)->name('platform.categories');
Route::screen('categories/{category?}/edit', CategoryEditScreen::class)->name('platform.category.edit');

Route::screen('subcategories', SubCategories::class)->name('platform.subcategories');
Route::screen('subcategories/{subcategory?}/edit', SubCategoriesEditScreen::class)->name('platform.subcategories.edit');

Route::screen('services', \App\Orchid\Screens\ServiceScreen::class)->name('platform.services');
Route::screen('services/{id}/edit', \App\Orchid\Screens\ServiceEditScreen::class)->name('platform.services.edit');
Route::screen('services/create', \App\Orchid\Screens\ServiceCreateScreen::class)
    ->name('platform.services.create');


Route::screen('contacts', ContactScreen::class)->name('platform.contacts');
Route::screen('contact/view/{contact}', ContactViewScreen::class)->name('platform.contact.view');

Route::screen('service-requests', ServiceRequestListScreen::class)->name('platform.service-requests');
Route::screen('service-requests/show/{id}', ServiceRequestDetailScreen::class)->name('platform.service-requests.detail');

Route::screen('forms/create', FormCreateScreen::class)->name('platform.forms.create');
Route::screen('forms', FormListScreen::class)->name('platform.forms');
Route::screen('forms/{id}/edit', FormEditScreen::class)->name('platform.forms.edit');
Route::post('forms/{id}/save', [FormEditScreen::class, 'save'])->name('platform.forms.save');


Route::screen('applications', ApplicationListScreen::class)->name('platform.applications.list');
Route::screen('applications/{application}', ApplicationViewScreen::class)->name('platform.applications.view');

Route::screen('service-request/create', ServiceRequestCreateScreen::class)
    ->name('platform.service-request.create');
Route::screen('fairs', FairListScreen::class)->name('platform.fairs.list');
Route::screen('fairs/create', FairEditScreen::class)->name('platform.fair.create');
Route::screen('fairs/{fair}/edit', FairEditScreen::class)->name('platform.fair.edit');


Route::screen('settings', SettingsScreen::class)->name('platform.settings');
Route::screen('posts', PostScreen::class)->name('platform.post.list');
Route::screen('post/{post}/edit', PostEditScreen::class)->name('platform.post.edit');
Route::screen('post/create', PostEditScreen::class)->name('platform.post.create');

Route::screen('send/service/{id}', \App\Orchid\Screens\ServiceSendScreen::class)->name('platform.applications.send_company');

