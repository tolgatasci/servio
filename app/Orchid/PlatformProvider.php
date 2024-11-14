<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;
use Orchid\Support\Color;


class PlatformProvider extends OrchidServiceProvider
{
    /**
     * @param Dashboard $dashboard
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);

        // ...
    }

    /**
     * @return Menu[]
     */
    public function registerMainMenu(): array
    {
        return [
            Menu::make('Applications')
                ->icon('folder')
                ->route('platform.applications.list'),
            Menu::make('Categories')
                ->icon('list')
                ->list([
                    Menu::make('Root Categories')->route('platform.categories'),
                    Menu::make('Sub Categories')->route('platform.subcategories'),
                ]),
            Menu::make('Services')
                ->icon('envelope')
                ->route('platform.services'),
            Menu::make('Formlar')
                ->icon('envelope')
                ->route('platform.forms'),
            Menu::make('Service Request')
                ->icon('envelope')
                ->route('platform.service-requests')
                ->title(__('Request ')),

            Menu::make('Contact Submissions')
                ->icon('envelope')
                ->route('platform.contacts'),
            Menu::make('Fair List')
                ->icon('calendar')
                ->route('platform.fairs.list'),
            Menu::make('Blog Posts')
                ->icon('note')
                ->route('platform.post.list')
                ->title('Manage Blog Posts'),
            Menu::make(__('Users'))
                ->icon('user')
                ->route('platform.systems.users')
                ->permission('platform.systems.users')
                ->title(__('Access rights')),

            Menu::make(__('Roles'))
                ->icon('lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
            Menu::make(__('Settings'))
                ->icon('settings')
                ->route('platform.settings'),
        ];
    }

    /**
     * @return Menu[]
     */
    public function registerProfileMenu(): array
    {
        return [
            Menu::make(__('Profile'))
                ->route('platform.profile')
                ->icon('user'),
        ];
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }
}
