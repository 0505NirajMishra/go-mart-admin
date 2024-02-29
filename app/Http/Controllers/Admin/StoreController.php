<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Stores;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\StoreService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\Driver\Driver;
use Yajra\DataTables\Facades\Datatables;
use GuzzleHttp\Client;
class StoreController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name, $store_view;
    protected $storeService, $utilityService;

    public function __construct()
    {
        //Data
        $this->uploads_image_directory = 'files/stores';
        //route
        $this->index_route_name = 'admin.stores.index';
        $this->create_route_name = 'admin.stores.create';
        $this->detail_route_name = 'admin.stores.show';
        $this->edit_route_name = 'admin.stores.edit';

        //view files
        $this->index_view = 'admin.store.index';
        $this->create_view = 'admin.store.create';
        $this->edit_view = 'admin.store.edit';
        $this->store_view = 'admin.store.store';

        //service files
        $this->storeService = new StoreService();
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

            $query = Stores::join('categories', 'stores.category_name', '=', 'categories.cat_id')->
                select('stores.*', 'categories.category_name');

            if ($request->has('store_name')) {
                $name = $request->input('store_name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(store_name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(store_name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }

            return \DataTables::of($query)->addIndexColumn()

                ->addColumn('store_status', function ($model) {
                    return $model->store_status == 0 ? 'Close' : 'Open';
                })
                ->rawColumns(['store_status'])
                ->addColumn('store_active', function ($model) {
                    return $model->store_active == 0 ? 'Enable' : 'Disable';
                })
                ->rawColumns(['store_active'])
                ->addColumn('action', function ($row) {
                    $storeview = '<a href="stores/storeview/' . $row->store_id . '" class="badge badge-warning p-2" ><i class="fa fa-eye" style="color:white;"></i></a>';
                    $btn1 = '&nbsp;<a href="stores/' . $row->store_id . '/edit" class="badge badge-success p-2"><i
                    class="fa-regular fa-pen-to-square"
                    style="color:white;"></i></a>';
                    $btn2 = '&nbsp;<a href="stores/destroy/' . $row->store_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $storeview." ".$btn1." ".$btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.store.index');
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data['categories'] = Category::get(["category_name", "cat_id"]);
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

        $logo = $request->file('store_image');
        $picture = FileService::fileUploaderWithoutRequest($logo, 'store/image/');
        $input['store_image'] = $picture;

        $logo1 = $request->file('gallery_image');
        $picture1 = FileService::fileUploaderWithoutRequest($logo1, 'gallery/image/');
        $input['gallery_image'] = $picture1;

        $store = $this->storeService->create($input);

        $addgallery['store_id'] = $store->store_id;
        $addgallery['gallery_image'] = $input['gallery_image'];

        $bankdetail['store_id'] = $store->store_id;
        $bankdetail['bank_name'] = $input['bank_name'];
        $bankdetail['branch_name'] = $input['branch_name'];
        $bankdetail['holder_name'] = $input['holder_name'];
        $bankdetail['account_number'] = $input['account_number'];
        $bankdetail['other_info'] = $input['other_info'];

        Gallery::create($addgallery);
        Bank::create($bankdetail);

        return redirect()->route($this->index_route_name)->with('success', $this->mls->messageLanguage('created', 'store', 1));
        
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

    public function edit(Stores $store)
    {
        $data['categories'] = Category::get(["category_name", "cat_id"]);
        $data['gallerys'] = Gallery::where('store_id', $store->store_id)->first();
        $data['bank_details'] = Bank::where('store_id', $store->store_id)->first();
        return view($this->edit_view, compact('store'), $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Stores $store)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['store_image'])) {
            $logo = $request->file('store_image');
            $picture = FileService::fileUploaderWithoutRequest($logo, 'store/image/');
            $input['store_image'] = $picture;
        }

        if (!empty($input['gallery_image'])) {
            $logo1 = $request->file('gallery_image');
            $picture1 = FileService::fileUploaderWithoutRequest($logo1, 'gallery/image/');
            $input['gallery_image'] = $picture1;
            $new = $input['gallery_image'];
            $id = $input['id'];
            DB::table('gallerys')->where('store_id', $id)->update(['gallery_image' => $new]);
        }

        $id = $input['id'];

        $bank_name = $input['bank_name'];
        $branch_name = $input['branch_name'];
        $holder_name = $input['holder_name'];
        $account_number = $input['account_number'];
        $other_info = $input['other_info'];

        DB::table('bank_details')->where('store_id', $id)->update(
            ['bank_name' => $bank_name,
                'branch_name' => $branch_name,
                'holder_name' => $holder_name,
                'other_info' => $other_info,
                'account_number' => $account_number,
            ]
        );

        $this->storeService->update($input, $store);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'store', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('stores')->where('store_id', $id)->delete();
        $result = DB::table('gallerys')->where('store_id', $id)->delete();
        $result = DB::table('bank_details')->where('store_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->storeService->updateById(['is_active' => $status], $id);
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

    public function storebyId($id)
    {

        $storeordercount = DB::table('orders')->where('store_id', $id)->count();

        $storedata = DB::table('gallerys')
            ->select('categories.category_name as cat_name', 'stores.*', 'gallerys.*')
            ->join('stores', 'stores.store_id', '=', 'gallerys.store_id')
            ->join('categories', 'categories.cat_id', '=', 'stores.category_name')
            ->where('stores.store_id', $id)->first();

        return view($this->store_view, compact('storedata', 'storeordercount'));
    }

}
