<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use App\Services\SubcategoryService;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\Datatables;

class SubcategoryController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService;

    public function __construct()
    {
        //Data
        $this->uploads_image_directory = 'files/subcategorys';
        //route
        $this->index_route_name = 'admin.subcategorys.index';
        $this->create_route_name = 'admin.subcategorys.create';
        $this->detail_route_name = 'admin.subcategorys.show';
        $this->edit_route_name = 'admin.subcategorys.edit';

        //view files
        $this->index_view = 'admin.subcategory.index';
        $this->create_view = 'admin.subcategory.create';
        $this->edit_view = 'admin.subcategory.edit';

        //service files
        $this->intrestService = new SubcategoryService();
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

            $query = Subcategory::Join('categories', 'categories.cat_id', '=', 'subcategorys.category_id')
                ->select('categories.category_name as cat_name', 'subcategorys.*');

            if ($request->has('subcategory_name')) {
                $searchValue = $request->input('subcategory_name');
                $query->where(function ($q) use ($searchValue) {
                    $q->where('subcategorys.subcategory_name', 'like', '%' . $searchValue . '%')
                        ->orWhere('subcategorys.subcategory_name', 'like', '%' . $searchValue . '%');
                });
            }

            return \DataTables::of($query)->addIndexColumn()

                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="subcategorys/' . $row->id . '/edit" class="badge badge-success p-2"><i
                    class="fa-regular fa-pen-to-square"
                    style="color:white;"></i></a>';
                    $btn2 = '&nbsp;<a href="subcategorys/destroy/' . $row->id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn1 . " " . $btn2;

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.subcategory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $data['category'] = Category::get(["category_name", "cat_id"]);
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

        $logo = $request->file('subcategory_image');
        $picture = FileService::fileUploaderWithoutRequest($logo, 'subcategory/image/');
        $input['subcategory_image'] = $picture;

        $subcategory = $this->intrestService->create($input);

        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'subcategory', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */

    public function show(Subcategory $subcategory)
    {
        return view($this->detail_view, compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(Subcategory $subcategory)
    {
        $data['category'] = Category::get(["category_name", "cat_id"]);
        return view($this->edit_view,compact('subcategory'),$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, Subcategory $subcategory)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);

        if (!empty($input['subcategory_image'])) {
            $logo = $request->file('subcategory_image');
            $picture = FileService::fileUploaderWithoutRequest($logo, 'subcategory/image/');
            $input['subcategory_image'] = $picture;
        }

        $this->intrestService->update($input, $subcategory);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'subcategory', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('subcategorys')->where('id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

}