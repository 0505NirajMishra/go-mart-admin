<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\wallettransaction;
use App\Services\wallettransactionservice;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class wallettransactionController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $wallettransactionService;

    public function __construct()
    {
        //Data
        $this->uploads_image_directory = 'files/wallettransactions';
        //route
        $this->index_route_name = 'admin.wallettransactions.index';
        $this->create_route_name = 'admin.wallettransactions.create';
        $this->detail_route_name = 'admin.wallettransactions.show';
        $this->edit_route_name = 'admin.wallettransactions.edit';

        //view files
        $this->index_view = 'admin.wallettransaction.index';
        $this->create_view = 'admin.wallettransaction.create';
        $this->edit_view = 'admin.wallettransaction.edit';

        //service files
        $this->wallettransactionService = new wallettransactionservice();
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

            $data = DB::table('wallettransactions')->get();

            return \DataTables::of($data)->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('name'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['name'], $request->get('name')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['name']), Str::lower($request->get('search')))) {
                                return true;
                            }
                            return false;
                        });
                    }

                })
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="wallettransactions/'. $row->wallet_id .'/edit" class="btn btn-warning btn-sm" style="display:none;">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="wallettransactions/destroy/'. $row->wallet_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" 
                    style="display:none;"
                    >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
          
        }
        return view('admin.wallettransaction.index');
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
        $category = $this->wallettransactionService->create($input);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('created', 'wallettransaction', 1));
    }

     /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(wallettransaction $wallettransaction)
    {
        return view($this->detail_view, compact('wallettransaction'));
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(wallettransaction $wallettransaction)
    {
        return view($this->edit_view, compact('wallettransaction'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, wallettransaction $wallettransaction)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->wallettransactionService->update($input, $wallettransaction);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'wallettransaction', 1));
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('wallettransactions')->where('wallet_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    
}