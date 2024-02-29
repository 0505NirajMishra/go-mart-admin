<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Deliverycharge;
use App\Services\Deliverychargeservice;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class StorepaymentController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $currencyService, $utilityService, $deliverychargeService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/storepayments';
        //route
        $this->index_route_name = 'admin.storepayments.index';
        $this->create_route_name = 'admin.storepayments.create';
        $this->detail_route_name = 'admin.storepayments.show';
        $this->edit_route_name = 'admin.storepayments.edit';

        //view files
        $this->index_view = 'admin.storepayment.index';
        $this->create_view = 'admin.storepayment.create';
        $this->edit_view = 'admin.storepayment.edit';

        //service files
        $this->deliverychargeService = new Deliverychargeservice();
        // $this->customerService = new CustomerService();
        $this->utilityService = new UtilityService();
        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('categories')->get();

            return \DataTables::of($data)->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('category_name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['category_name'], $request->get('category_name')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['category_name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['category_name']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }

                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="storepayments/'. $row->cat_id .'/edit" class="btn btn-warning btn-sm">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="storepayments/destroy/'. $row->cat_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.storepayment.index');
    }
    
    public function show(Request $request)
    {
        //  return view($this->detail_view, compact('category'));
    }

    public function edit(Request $request)
    {
        $deliverycharge = Deliverycharge::where('delivery_id', $request->id)->first();
        return view($this->edit_view, compact('deliverycharge'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Deliverycharge $deliverycharge)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $update = DB::table('deliverycharges')->where('delivery_id',$input['delivery_id'])->update($input);
        return redirect()->back()->with('success', 'Data Update Successfully');
    }

}