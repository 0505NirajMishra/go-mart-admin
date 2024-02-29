<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Car;
use App\Models\Drivers;
use App\Models\Stores;
use App\Services\DriverService;
use App\Services\FileService;
use App\Services\HelperService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use Yajra\DataTables\Facades\Datatables;

class DriverController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $driverService, $utilityService, $customerService;

    public function __construct()
    {
        //Data
        $this->uploads_image_directory = 'files/drivers';
        //route
        $this->index_route_name = 'admin.drivers.index';
        $this->create_route_name = 'admin.drivers.create';
        $this->detail_route_name = 'admin.drivers.show';
        $this->edit_route_name = 'admin.drivers.edit';

        //view files
        $this->index_view = 'admin.driver.index';
        $this->create_view = 'admin.driver.create';
        $this->edit_view = 'admin.driver.edit';

        //service files
        $this->driverService = new DriverService();
        // $this->customerService = new CustomerService();
        $this->utilityService = new UtilityService();
        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Drivers::join('stores', 'drivers.store_name', '=', 'stores.store_id')->
                select('drivers.*', 'stores.store_name');

            if ($request->has('driver_name')) {
                $name = $request->input('driver_name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(driver_name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(driver_name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }

            return \DataTables::of($query)->addIndexColumn()

                ->addColumn('driver_status', function ($model) {
                    return $model->driver_status == 0 ? 'disable' : 'enable';
                })
                ->rawColumns(['driver_status'])
                ->addColumn('action', function ($row) {

                    $btn1 = '<a href="drivers/' . $row->driver_id . '/edit" class="badge badge-success p-2"><i
                    class="fa-regular fa-pen-to-square"
                    style="color:white;"></i></a>';
                    $btn2 = '&nbsp;<a href="drivers/destroy/' . $row->driver_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn1 . " " . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.driver.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data['stores'] = Stores::get(["store_name", "store_id"]);
        return view($this->create_view, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserIntrestRequest $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        $logo = $request->file('driver_image');
        $picture = FileService::fileUploaderWithoutRequest($logo, 'driver/image/');
        $input['driver_image'] = $picture;

        $logo1 = $request->file('car_image');
        $picture1 = FileService::fileUploaderWithoutRequest($logo1, 'car/image/');
        $input['car_image'] = $picture1;

        $driver = $this->driverService->create($input);

        $adddriver['driver_id'] = $driver->driver_id;
        $adddriver['car_image'] = $input['car_image'];
        $adddriver['car_name'] = $input['car_name'];
        $adddriver['car_number'] = $input['car_number'];

        $bankdetail['driver_id'] = $driver->driver_id;
        $bankdetail['bank_name'] = $input['bank_name'];
        $bankdetail['branch_name'] = $input['branch_name'];
        $bankdetail['holder_name'] = $input['holder_name'];
        $bankdetail['account_number'] = $input['account_number'];
        $bankdetail['other_info'] = $input['other_info'];

        Car::create($adddriver);
        Bank::create($bankdetail);

        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('created', 'driver', 1));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Driver $driver)
    {
        // return view($this->detail_view, compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(Drivers $driver)
    {
        $data['stores'] = Stores::get(["store_name", "store_id"]);
        $data['cars'] = Car::where('driver_id', $driver->driver_id)->first();
        $data['bank_details'] = Bank::where('driver_id', $driver->driver_id)->first();
        // $data['driver_list'] = DB::table('drivers')->join('orders', 'orders.driver_id', '=', 'drivers.driver_id')->select('orders.*', 'drivers.*')->where('order_status', '1')->get();
        $data['driver_list'] = DB::table('orders')->where('order_status', '1')->where('driver_id',$driver->driver_id)->count('order_id');
        
        return view($this->edit_view, compact('driver'), $data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Drivers $driver)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['driver_image'])) {
            $logo = $request->file('driver_image');
            $picture = FileService::fileUploaderWithoutRequest($logo, 'driver/image/');
            $input['driver_image'] = $picture;
        }

        if (!empty($input['car_image'])) {
            $logo1 = $request->file('car_image');
            $picture1 = FileService::fileUploaderWithoutRequest($logo1, 'car/image/');

            $input['car_image'] = $picture1;
            $car_image = $input['car_image'];
            $car_name = $input['car_name'];
            $car_number = $input['car_number'];
            $id = $input['id'];

            DB::table('cars')->where('driver_id', $id)->update(
                ['car_image' => $car_image,
                    'car_name' => $car_name,
                    'car_number' => $car_number]);
        }

        $id = $input['id'];
        $bank_name = $input['bank_name'];
        $branch_name = $input['branch_name'];
        $holder_name = $input['holder_name'];
        $account_number = $input['account_number'];
        $other_info = $input['other_info'];

        DB::table('bank_details')->where('driver_id', $id)->update(
            [   'bank_name' =>  $bank_name,
                'branch_name' => $branch_name,
                'holder_name' => $holder_name,
                'other_info' => $other_info,
                'account_number' => $account_number,
            ]
        );

        $this->driverService->update($input, $driver);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'driver', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('drivers')->where('driver_id', $id)->delete();
        $result = DB::table('cars')->where('driver_id', $id)->delete();
        $result = DB::table('bank_details')->where('driver_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->driverService->updateById(['is_active' => $status], $id);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->messageLanguage('updated', 'status', 1),
                'status_name' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->messageLanguage('not_updated', 'status', 1),
                'status_name' => 'error',
            ]);
        }
    }

}
