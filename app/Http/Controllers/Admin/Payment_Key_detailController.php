<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment_key_detail;
use App\Services\FileService;
use App\Services\Payment_Key_Service;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Payment_Key_detailController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService, $paymnetkeyservice;

    public function __construct()
    {
        //Data
        $this->uploads_image_directory = 'files/payments';
        //route
        $this->index_route_name = 'admin.payments.index';
        $this->create_route_name = 'admin.payments.create';
        $this->edit_route_name = 'admin.payments.edit';

        //view files
        $this->edit_view = 'admin.payment.edit';

        //service files
        $this->paymnetkeyservice = new Payment_Key_Service();
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
        $keydetail = Payment_key_detail::where('payment_key_id', $request->id)->first();
        return view($this->edit_view, compact('keydetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Payment_key_detail $payment_key_detail)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $update = DB::table('payment_key_details')->where('payment_key_id',$input['payment_key_id'])->update($input);
        return redirect()->back()->with('success', 'Data Update Successfully');
    }

}   