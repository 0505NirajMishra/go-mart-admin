<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\DashboardService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function test()
    {
        $user = Auth::user();
        return view('admin.test', compact('user'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $user = Auth::user();
        // dd($user);
        // dd($user->getRoleNames(), $user->roles, $user->permissions, $user->getPermissionsViaRoles(), $user->getAllPermissions());

        $data = DB::table('stores')->
        join('reviewandratings', 'reviewandratings.store_id', '=', 'stores.store_id')
        ->select('stores.*', 'reviewandratings.*')->get();

        $recent_order = Order::with('OrderQuantity', 'store')->get();

        $driver_list = DB::table('drivers')->join('orders', 'orders.driver_id', '=', 'drivers.driver_id')->select('orders.*', 'drivers.*')->where('order_status', '1')->get();

        $columnchart = [
            'year' => ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC'],
            'data_form_year_wise' => ['100', '200', '300', '400', '500', '600', '700', '800', '900', '1000', '1100', '1200'],
        ];


        return view('admin.dashboard',compact('data','recent_order','driver_list','columnchart'));

    }

    public function dashboardCountsData()
    {
        $data = DashboardService::adminDataCounts();
        return response()->json([
            'status' => 1,
            'message' => 'Dashboard Data Get Successfully ',
            'data' => $data,
        ]);
    }
}
