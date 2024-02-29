<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Services\Currencyservice;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class CurrencyController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $currencyService, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/currencys';
        //route
        $this->index_route_name = 'admin.currencys.index';
        $this->create_route_name = 'admin.currencys.create';
        $this->detail_route_name = 'admin.currencys.show';
        $this->edit_route_name = 'admin.currencys.edit';

        //view files
        $this->index_view = 'admin.currency.index';
        $this->create_view = 'admin.currency.create';
        $this->edit_view = 'admin.currency.edit';

        //service files
        $this->currencyService = new Currencyservice();
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

            $query = Currency::query();

            if ($request->has('name')) {
                $name = $request->input('name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }

            return \DataTables::of($query)->addIndexColumn()
               
                ->addColumn('symbol_at_right', function ($model) {
                    return $model->symbol_at_right == '0' ? 'Yes' : 'No';
                })
                ->rawColumns(['symbol_at_right'])
                ->addColumn('currency_status', function ($model) {
                    return $model->currency_status == '0' ? 'Active' : 'Deactive';
                })
                ->rawColumns(['currency_status'])
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="currencys/'. $row->currency_id .'/edit" class="btn btn-warning btn-sm">Edit</a>';
                    $btn2 = '&nbsp;&nbsp;<a href="currencys/destroy/'. $row->currency_id .'" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-sm" >Delete</a>';
                    return $btn1 . "" . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.currency.index');
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
        $category = $this->currencyService->create($input);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('created', 'currency', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        return view($this->detail_view, compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        return view($this->edit_view, compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {

        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->currencyService->update($input, $currency);
        return redirect()->route($this->index_route_name)
        ->with('success', $this->mls->messageLanguage('updated', 'currency', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('currencys')->where('currency_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }


    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->currencyService->updateById(['is_active' => $status], $id);
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

    public function active($id, $status)
    {
        $update = array('status' => $status);
        $result = Currencyservice::status($update, $id);
        return redirect()->back()->withSuccess('Status Update Successfully!');
    }


}