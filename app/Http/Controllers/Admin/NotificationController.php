<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\User;
use App\Services\ManagerLanguageService;
use App\Services\NotificationService;
use App\Services\UtilityService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\Datatables;

class NotificationController extends Controller
{
    protected $mls, $change_password, $assign_role, $uploads_image_directory;
    protected $index_view, $create_view, $edit_view, $detail_view, $tabe_view, $product_history_view;
    protected $index_route_name, $create_route_name, $detail_route_name, $edit_route_name;
    protected $intrestService, $utilityService, $customerService;

    public function __construct()
    {

        //Data
        $this->uploads_image_directory = 'files/notifications';
        //route
        $this->index_route_name = 'admin.notifications.index';
        $this->create_route_name = 'admin.notifications.create';
        $this->detail_route_name = 'admin.notifications.show';
        $this->edit_route_name = 'admin.notifications.edit';

        //view files
        $this->index_view = 'admin.notification.index';
        $this->create_view = 'admin.notification.create';
        $this->edit_view = 'admin.notification.edit';

        //service files
        $this->intrestService = new NotificationService();
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
            $data = DB::table('notifications')->get();
            return \DataTables::of($data)->addIndexColumn()
                ->filter(function ($instance) use ($request) {
                    if (!empty($request->get('notification_subject'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            return Str::contains($row['notification_subject'], $request->get('notification_subject')) ? true : false;
                        });
                    }

                    if (!empty($request->get('search'))) {
                        $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                            if (Str::contains(Str::lower($row['notification_subject']), Str::lower($request->get('search')))) {
                                return true;
                            } else if (Str::contains(Str::lower($row['notification_subject']), Str::lower($request->get('search')))) {
                                return true;
                            }

                            return false;
                        });
                    }

                })
                ->addColumn('action', function ($row) {

                    $btn2 = '<a href="notifications/destroy/' . $row->notification_id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn2;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.notification.index');

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

        $data = array();
        $screen = 0;
        $data = User::where('login_type', $input['notification_send_to'])->get();

        foreach ($data as $datas) {
            $input['user_id'] = $datas->id;
        }

        $battle = $this->intrestService->create($input, $screen);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('created', 'notification', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserIntrestRequest  $battle
     * @return \Illuminate\Http\Response
     */
    public function show(Notification $notification)
    {
        return view($this->detail_view, compact('notification'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        return view($this->edit_view, compact('notification'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {

        $input = $request->except(['_method', '_token', 'proengsoft_jsvalidation']);
        $this->intrestService->update($input, $notification);
        return redirect()->route($this->index_route_name)
            ->with('success', $this->mls->messageLanguage('updated', 'category', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserIntrest  $intrest
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $result = DB::table('notifications')->where('notification_id', $id)->delete();
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
