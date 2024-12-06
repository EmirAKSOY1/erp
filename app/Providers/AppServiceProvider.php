<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
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
    public function boot(): void
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $role = Auth::user()->roles->first()->url_name;
                // $messages = Message::with('sender')
                //     ->where('receiver_id', Auth::id())
                //     ->latest()
                //     ->get();

                // $notifications = Notification::latest()->take(5)->get();
                // $unreadCount = $messages->where('is_read', false)->count();
                $menus = [];
            switch ($role) {
                case 'admin':
                    $menus = [
                        ['title' => 'Anasayfa'    , 'route' => 'admin_dashboard'    ,'icon' =>'bx bxs-home-circle'],
                        // ['title' => 'Entegreler'  , 'route' => 'entegreler.index'   ,'icon' =>'bx bxs-factory'],
                        // ['title' => 'Kullanıcılar', 'route' => 'user.index'         ,'icon' =>'fa-solid fa-users'],
                        // ['title' => 'Alarmlar'    , 'route' => 'ariza.index'        ,'icon' =>'fa-solid fa-bell'],
                        // ['title' => 'Veriler'     , 'route' => 'endkon_data.index'  ,'icon' =>'fa-solid fa-database'],
                        // ['title' => 'Bildirimler' , 'route' => 'notifications.index','icon' =>'fa-solid fa-envelope'],
                        // ['title' => 'Destek Talepleri' , 'route' => 'admin_support.index','icon' =>'fa-solid fa-headset'],
                        // ['title' => 'Log Kayıtları' , 'route' => 'admin_log.index','icon' =>'fa-solid fa-box'],
                        
                    ];
                    break;
                case 'bakıcı':
                    $menus = [
                        ['title' => 'Anasayfa' , 'route' => 'bakici_dashboard','icon' =>'fa-solid fa-gauge'],
                        ['title' => 'Kümesler' , 'route' => 'bakici_kumes.index','icon' =>'fa-solid fa-wheat-awn'],
                        ['title' => 'Alarmlar' , 'route' => 'bakici_alarm.index','icon' =>'fa-solid fa-bell'],
                        ['title' => 'Veriler'  ,  'route' => 'bakici_veri.index','icon' =>'fa-solid fa-database'],
                        
                    ];
                    break;
                case 'veterinarian':
                    $menus = [
                        ['title' => 'Veterinarian Panel', 'route' => 'vet.dashboard','icon' =>'fa-solid fa-gauge'],
                        // diğer veteriner menü öğeleri
                    ];
                    break;
                case 'yönetici':
                    $menus = [
                        ['title' => 'Anasayfa', 'route' => 'manager_dashboard','icon' =>'fa-solid fa-gauge'],
                        ['title' => 'Kümesler', 'route' => 'manager_kumes.index','icon' =>'fa-solid fa-wheat-awn'],
                        ['title' => 'Alarmlar', 'route' => 'manager_alarm.index','icon' =>'fa-solid fa-bell'],
                        //['title' => 'Veriler', 'route' => 'manager_data.index','icon' =>'fa-solid fa-database'],
                        ['title' => 'Çalışanlarım', 'route' => 'manager_employees.index','icon' =>'fa-solid fa-users'],
                        ['title' => 'Teknik Destek', 'route' => 'manager_support.index','icon' =>'fa-solid fa-headset'],
                        // diğer yönetici menü öğeleri
                    ];
                    break;
            }
            $view->with([
                'role' => $role,
                'menus' => $menus,
            ]);
            }
        });
    }
    }

