<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commision;
use App\Services\FileService;
use App\Services\Commissionservice;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService, $commissionservice;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/commissions';
        //route
        $this->index_route_name = 'admin.commissions.index';
        $this->create_route_name = 'admin.commissions.create';
        $this->edit_route_name = 'admin.commissions.edit';

        //view files
        $this->edit_view = 'admin.commission.edit';

        //service files
        $this->commissionservice = new Commissionservice();
        // $this->customerService = new CustomerService();
        $this->utilityService = new UtilityService();

        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
    }

    /**
     * Edit the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request)
    {
        //  return view($this->detail_view, compact('category'));
    }

    public function edit(Request $request)
    {
        $commsion = Commision::where('commission_id', $request->id)->first();
        return view($this->edit_view, compact('commsion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Commision $commision)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $update = DB::table('commissions')->where('commission_id',$input['commission_id'])->update($input);
        return redirect()->back()->with('success', 'Data Update Successfully');
    }

}   