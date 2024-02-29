<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Services\Languageservice;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class LanguageController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $languageservice, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/languages';
        //route
        $this->index_route_name = 'admin.languages.index';
        $this->create_route_name = 'admin.languages.create';
        $this->detail_route_name = 'admin.languages.show';
        $this->edit_route_name = 'admin.languages.edit';

        //view files
        $this->index_view = 'admin.language.index';
        $this->create_view = 'admin.language.create';
        $this->edit_view = 'admin.language.edit';

        //service files
        $this->languageservice = new Languageservice();
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

            // $data = DB::table('languages')->get();

            $query = Language::query();

            if ($request->has('language_name')) {
                $name = $request->input('language_name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(language_name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(language_name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }


            return \DataTables::of($query)->addIndexColumn()
              
                ->addColumn('language_status', function ($model) {
                    return $model->language_status == 0 ? 'Yes' : 'No';
                })
                ->rawColumns(['language_status'])
                ->addColumn('action', function ($row) {

                    $btn1 = '<a href="languages/' . $row->language_id . '/edit" class="badge badge-success p-2"><i
                    class="fa-regular fa-pen-to-square"
                    style="color:white;"></i></a>';
                    $btn2 = '&nbsp;<a href="languages/destroy/' . $row->language_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn1 . " " . $btn2;

                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.language.index');
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
        $category = $this->languageservice->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'language', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Language $language)
    {
        return view($this->detail_view, compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Language $language)
    {
        return view($this->edit_view, compact('language'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Language $language)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->languageservice->update($input, $language);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'language', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('languages')->where('language_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

}
