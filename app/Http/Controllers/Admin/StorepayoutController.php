<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Storepayout;
use App\Services\Storepayoutservice;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class StorepayoutController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $storepayoutService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/storepayouts';
        //route
        $this->index_route_name = 'admin.storepayouts.index';
        $this->create_route_name = 'admin.storepayouts.create';
        $this->detail_route_name = 'admin.storepayouts.show';
        $this->edit_route_name = 'admin.storepayouts.edit';

        //view files
        $this->index_view = 'admin.storepayout.index';
        $this->create_view = 'admin.storepayout.create';
        $this->edit_view = 'admin.storepayout.edit';

        //service files
        $this->storepayoutService = new Storepayoutservice();
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

            $query = Storepayout::query();

            if ($request->has('store_name')) {
                $name = $request->input('store_name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(store_name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(store_name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }


            return \DataTables::of($query)->addIndexColumn()
             
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="storepayouts/'. $row->store_id .'/edit" class="btn btn-warning btn-sm" style="display:none;">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="storepayouts/destroy/'. $row->store_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" 
                    style="display:none;"
                    >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
          
        }
        return view('admin.storepayout.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->create_view);
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
        $category = $this->storepayoutService->create($input);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('created', 'storepayout', 1));
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Storepayout $storepayout)
    {
        return view($this->detail_view, compact('storepayout'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(Storepayout $storepayout)
    {
        return view($this->edit_view, compact('storepayout'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, Storepayout $storepayout)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        $this->intrestService->update($input, $storepayout);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'storepayout', 1));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('storepayouts')->where('store_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    
}