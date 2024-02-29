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

class DeliveryController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $currencyService, $utilityService, $deliverychargeService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/deliverycharges';
        //route
        $this->index_route_name = 'admin.deliverycharges.index';
        $this->create_route_name = 'admin.deliverycharges.create';
        $this->detail_route_name = 'admin.deliverycharges.show';
        $this->edit_route_name = 'admin.deliverycharges.edit';

        //view files
        $this->index_view = 'admin.deliverycharge.index';
        $this->create_view = 'admin.deliverycharge.create';
        $this->edit_view = 'admin.deliverycharge.edit';

        //service files
        $this->deliverychargeService = new Deliverychargeservice();
        // $this->customerService = new CustomerService();
        $this->utilityService = new UtilityService();
        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
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