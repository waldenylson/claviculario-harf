<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Support\Facades\DB;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
  private $keysCount;
  private $outKeysCount;

  public function __construct()
  {
    try {
      $this->keysCount = DB::table('keys')->count();
      $this->outKeysCount = DB::table('key_movements')->count();
    } catch (\Throwable $th) {
      $this->keysCount = 0;
      $this->outKeysCount = 0;
    }
  }

  /**
   * Register any application services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap any application services.
   */
  public function boot(Dispatcher $events): void
  {


    $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
      $event->menu->addAfter('claviculario', [
        'text' => 'Chaves Retiradas',
        'url'  => '#',
        'icon' => 'fa-solid fa-list-check',
        'icon_color' => 'red',
        'label'       => $this->outKeysCount,
        'label_color' => 'danger'
      ]);

      $event->menu->addAfter('claviculario', [
        'text' => 'Total Chaves',
        'id' => 'total_chaves',
        'url'  => '#',
        'icon' => 'fa-solid fa-list',
        'icon_color' => '',
        'label'       => $this->keysCount,
        'label_color' => 'primary',
        'update_class_name' => 'total-chaves'
      ]);
    });
  }
}
