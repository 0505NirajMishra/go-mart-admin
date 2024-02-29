<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reviewandrating;
use App\Services\ManagerLanguageService;
use App\Services\Ratingservice;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class RatingController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $ratingservice, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/reviews';
        //route
        $this->index_route_name = 'admin.reviews.index';
        $this->create_route_name = 'admin.reviews.create';
        $this->detail_route_name = 'admin.reviews.show';
        $this->edit_route_name = 'admin.reviews.edit';

        //view files
        $this->index_view = 'admin.review.index';
        $this->create_view = 'admin.review.create';
        $this->edit_view = 'admin.review.edit';

        //service files
        $this->ratingservice = new Ratingservice();
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

    // public function index(Request $request)
    // {
    //     $items = $this->intrestService->datatable();
    //     if ($request->ajax()) {
    //         return view('admin.category.category_table', ['categorys' => $items]);
    //     } else {
    //         return view('admin.category.index', ['categorys' => $items]);
    //     }
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {

            $query = Reviewandrating::Join('users', 'users.id', '=', 'reviewandratings.user_id')
                ->Join('items', 'items.item_id', '=', 'reviewandratings.item_id')
                ->Join('orders', 'orders.order_id', '=', 'reviewandratings.order_id')
                ->Join('stores', 'stores.store_id', '=', 'reviewandratings.store_id')
                ->select(
                    'users.name as user_name',
                    'items.item_name as item_as_name',
                    'reviewandratings.*',
                    'orders.order_id as order_as_id',
                    'stores.store_name as store_as_name'
                );

            if ($request->has('order_review')) {
                $searchValue = $request->input('order_review');
                $query->where(function ($q) use ($searchValue) {
                    $q->where('reviewandratings.order_review', 'like', '%' . $searchValue . '%')
                        ->orWhere('reviewandratings.order_review', 'like', '%' . $searchValue . '%')
                        ->orWhere('reviewandratings.order_review', 'like', '%' . $searchValue . '%');
                });
            }
            
            return \DataTables::of($query)->addIndexColumn()

                ->addColumn('rating', function ($product) {
                    $rating = $product->rating;
                    $stars = '';
                    for ($i = 1; $i <= 5; $i++) {
                        $stars .= ($i <= $rating) ? '★' : '☆';
                    }
                    return `<div>` . $stars . `</div>`;
                })
                ->rawColumns(['rating'])
                ->addColumn('action', function ($row) {
                    $btn1 = '<a href="reviews/' . $row->rating_id . '/edit" class="badge badge-success p-2"><i
                    class="fa-regular fa-pen-to-square"
                    style="color:white;"></i></a>';
                    $btn2 = '&nbsp;<a href="reviews/destroy/' . $row->rating_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn1 . " " . $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.review.index');

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
        $category = $this->ratingservice->create($input);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'order', 1));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */

    public function edit(Reviewandrating $review)
    {
        return view($this->edit_view, compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reviewandrating $review)
    {
        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->ratingservice->update($input, $review);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'order', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('reviewandratings')->where('rating_id', $id)->delete();
        return redirect()->back()->withSuccess('Data Delete Successfully!');
    }

    public function status($id, $status)
    {
        $status = ($status == 1) ? 0 : 1;
        $result = $this->ratingservice->updateById(['is_active' => $status], $id);
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
