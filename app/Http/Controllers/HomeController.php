<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    /*
     * Dashboard Pages Routs
     */
    public function index(Request $request)
    {

        $assets = ['chart', 'animation'];
        return view('dashboards.dashboard');

    }

    public function notificationsAjax(Request $request, $user_id)
    {
        $notifications = [];
        $user = User::where('id', $user_id)->first();
        if (count($user->unreadNotifications)) {
            foreach ($user->unreadNotifications as $notif) {
                $date = Carbon::parse($notif->created_at);
                $is_today = $date->isToday() ? 1 : 0;
                if ($is_today) {
                    $notifications[] = $notif;
                }
            }
        }
        return View::make('notifications/dropdown-ajax')->with('notifications', $notifications);
    }

    public function changeLanguage($local)
    {
        if (array_key_exists($local, [
            'en' => 'English',
            'ar' => 'Arabic'
        ])) {
            // Config::set([
            //     'app.locale' => $local,
            //     'app.fallback_locale' => $local,
            // ]);
            // Config::set('locale', $local);
            // Config::set('fallback_locale', $local);
            Session::put('applocale', $local);
        }
        return Redirect::back();
    }

    /*
     * Menu Style Routs
     */
    public function horizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.horizontal', compact('assets'));
    }
    public function dualhorizontal(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-horizontal', compact('assets'));
    }
    public function dualcompact(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.dual-compact', compact('assets'));
    }
    public function boxed(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed', compact('assets'));
    }
    public function boxedfancy(Request $request)
    {
        $assets = ['chart', 'animation'];
        return view('menu-style.boxed-fancy', compact('assets'));
    }

    /*
     * Pages Routs
     */
    public function billing(Request $request)
    {
        return view('special-pages.billing');
    }

    public function calender(Request $request)
    {
        $assets = ['calender'];
        return view('special-pages.calender', compact('assets'));
    }

    public function kanban(Request $request)
    {
        return view('special-pages.kanban');
    }

    public function pricing(Request $request)
    {
        return view('special-pages.pricing');
    }

    public function rtlsupport(Request $request)
    {
        return view('special-pages.rtl-support');
    }

    public function timeline(Request $request)
    {
        return view('special-pages.timeline');
    }


    /*
     * Widget Routs
     */
    public function widgetbasic(Request $request)
    {
        return view('widget.widget-basic');
    }
    public function widgetchart(Request $request)
    {
        $assets = ['chart'];
        return view('widget.widget-chart', compact('assets'));
    }
    public function widgetcard(Request $request)
    {
        return view('widget.widget-card');
    }
}
