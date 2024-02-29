<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Globalsetting;
use App\Services\FileService;
use App\Services\Globalservice;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GlobalController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService, $globalservice;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/globals';
        //route
        $this->index_route_name = 'admin.globals.index';
        $this->create_route_name = 'admin.globals.create';
        $this->edit_route_name = 'admin.globals.edit';

        //view files
        $this->index_view = 'admin.global.index';
        $this->create_view = 'admin.global.create';
        $this->edit_view = 'admin.global.edit';

        //service files
        $this->globalservice = new Globalservice();
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
        $globalsetting = Globalsetting::where('global_id', $request->id)->first();
        return view($this->edit_view, compact('globalsetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Globalsetting $globalsetting)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['application_logo'])) {
            $logo = $request->file('application_logo');
            $picture = FileService::fileUploaderWithoutRequest($logo, 'global/image/');
            $input['application_logo'] = $picture;
        }

        $update = DB::table('globals')->where('global_id',$input['global_id'])->update($input);
        return redirect()->back()->with('success', 'Data Update Successfully');
        
    }

}
