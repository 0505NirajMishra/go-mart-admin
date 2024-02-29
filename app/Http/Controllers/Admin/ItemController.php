<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Addons;
use App\Models\Addsize;
use App\Models\Category;
use App\Models\Item;
use App\Models\Stores;
use App\Services\FileService;
use App\Services\ItemService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class ItemController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/items';
        //route
        $this->index_route_name = 'admin.items.index';
        $this->create_route_name = 'admin.items.create';
        $this->detail_route_name = 'admin.items.show';
        $this->edit_route_name = 'admin.items.edit';

        //view files
        $this->index_view = 'admin.item.index';
        $this->create_view = 'admin.item.create';
        $this->edit_view = 'admin.item.edit';

        //service files
        $this->intrestService = new ItemService();
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

            $query = Item::join('categories', 'items.category_id', '=', 'categories.cat_id')
                ->join('stores', 'stores.store_id', '=', 'items.store_id')
                ->select('items.*', 'categories.category_name as cat_as_name', 'stores.store_name as str_name');

            if ($request->has('item_name')) {
                $name = $request->input('item_name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(item_name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(item_name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }

            return DataTables::of($query)->addIndexColumn()

                ->addColumn('publish', function ($model) {
                    return $model->item_publish == 'Yes' ? '<span class="badge badge-success">Yes</span>' : '<span class="badge badge-danger">No</span>';
                })
                ->rawColumns(['publish'])

                ->addColumn('action', function ($row) {

                    $btn1 = '<a href="items/' . $row->item_id . '/edit" class="badge badge-success p-2"><i
                    class="fa-regular fa-pen-to-square"
                    style="color:white;"></i></a>';
                    $btn2 = '&nbsp;<a href="items/destroy/' . $row->item_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn1 . " " . $btn2;

                })
                ->rawColumns(['action'])

                ->make(true);
        }

        return view('admin.item.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data['categories'] = Category::get(["category_name", "cat_id"]);
        $data['stores'] = Stores::get(["store_name", "store_id"]);
        return view($this->create_view, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserIntrestRequest $request
     * @return \Illuminate\Http\Response
     */

    public function show(Item $item){

    }

    public function store(Request $request)
    {

        $input = $request->except(['_token', 'proengsoft_jsvalidation']);

        // $storediscountprice = $input['item_price'] * $input['dis_item_price'] / 100;

        $mainprice = $input['item_price'] * $input['quantity']  ;

        // $input['dis_item_price'] = $storediscountprice;
        $input['item_price'] = $mainprice;

        $logo = $request->file('item_image');
        $picture = FileService::fileUploaderWithoutRequest($logo, 'item/image/');
        $input['item_image'] = $picture;

        $logo1 = $request->file('organic_image');
        $picture1 = FileService::fileUploaderWithoutRequest($logo1, 'item/image/');
        $input['organic_image'] = $picture1;

        $input['item_weight'] = json_encode($request->item_weight);

        $item = $this->intrestService->create($input);

        // if (!empty($request->item_weight))
        // {
            // $addons['item_id'] = $category->item_id;
            // $addons['addons_title'] = json_encode($request->addons_title);
            // $addons['addons_price'] = json_encode($request->addons_price);
            // Addons::create($addons);
        // }

        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'item', 1));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {

        $data['categories'] = Category::get(["category_name", "cat_id"]);
        $data['stores'] = Stores::get(["store_name", "store_id"]);
        return view($this->edit_view, $data, compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        // $storediscountprice = $input['item_price'] * $input['dis_item_price'] / 100;

        // $input['dis_item_price'] = $storediscountprice;

        if (!empty($input['item_image'])) {
            $logo = $request->file('item_image');
            $picture = FileService::fileUploaderWithoutRequest($logo, 'item/image/');
            $input['item_image'] = $picture;
        }

        if (!empty($input['organic_image'])) {
            $oraganic_image = $request->file('organic_image');
            $store_image = FileService::fileUploaderWithoutRequest($oraganic_image, 'item/image/');
            $input['organic_image'] = $store_image;
        }

        $this->intrestService->update($input, $item);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'item', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('items')->where('item_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->intrestService->updateById(['is_active' => $status], $id);
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
