<?php

namespace App\Providers;

use App\CategoryMenu;
use App\Menu;
use App\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $parameters = optional(Route::current())
                ->parameters();
            foreach ($parameters ?: [] as $key => $value) {
                $view->with($key, $value);
            }
        });

        $menus = [
            'topbar-menu' => 'topbar',
            'header-menu' => 'header.menu.*',
            'quick-links' => 'footer',
        ];

        foreach ($menus as $slug => $view) {
            View::composer("partials.{$view}", function ($view) use ($slug) {
                $menuItems = optional(Menu::whereSlug($slug)->first())->menuItems;
                $view->withMenuItems($menuItems ?: new Collection());
            });
        }

        View::composer(['partials.departments', 'partials.mobile-menu-categories'], function ($view) {
            $view->with('categories', CategoryMenu::nested());
        });

        $settingsPages = [
            'partials.header.*',
            'partials.footer',
            'products.show',
            'admin.layouts.master',
            'admin.orders.show',
            'admin.orders.invoices',
            'user.layouts.master',
            'layouts.light.master',
            'layouts.yellow.master',
            'layouts.errors.master',
        ];
        View::composer($settingsPages, function ($view) {
            $view->with(Cache::get('settings', function () {
                $settings = Setting::array();
                Cache::put('settings', $settings);
                return $settings;
            }));
        });
    }
}
