<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use App\Services\Deliverychargeservice;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class SpecialController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $currencyService, $utilityService, $specialofferService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/specialoffers';
        //route
        $this->index_route_name = 'admin.specialoffers.index';
        $this->create_route_name = 'admin.specialoffers.create';
        $this->detail_route_name = 'admin.specialoffers.show';
        $this->edit_route_name = 'admin.specialoffers.edit';

        //view files
        $this->index_view = 'admin.specialoffer.index';
        $this->create_view = 'admin.specialoffer.create';
        $this->edit_view = 'admin.specialoffer.edit';

        //service files
        $this->specialofferService = new Deliverychargeservice();
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
        $specialoffer = SpecialOffer::where('special_id', $request->id)->first();
        return view($this->edit_view, compact('specialoffer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, SpecialOffer $specialoffer)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $update = DB::table('specialoffers')->where('special_id',$input['special_id'])->update($input);
        return redirect()->back()->with('success', 'Data Update Successfully');
    }

}