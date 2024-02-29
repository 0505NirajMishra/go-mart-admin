<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\PasswordReset;
use App\Models\User;
use App\Services\FileService;
use App\Services\ManagerLanguageService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\Datatables;

class UserController extends Controller
{
    protected $mls, $change_password;

    public function __construct()
    {
        //mls is used for manage language content based on keys in messages.php
        $this->mls = new ManagerLanguageService('messages');
        //view files
        $this->change_password = 'admin.admin_profile.change_password';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $query = User::where('status', '0');

            if ($request->has('name')) {
                $name = $request->input('name');
                $query->where(function ($query) use ($name) {
                    $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($name) . '%'])
                        ->orWhereRaw('UPPER(name) LIKE ?', ['%' . strtoupper($name) . '%']);
                });
            }

            return \DataTables::of($query)->addIndexColumn()
                ->addColumn('login_type', function ($model) {
                    return $model->login_type == '0' ? 'Store' : ($model->login_type == '1' ? 'Customer' : 'Driver');
                })
                ->addColumn('action', function ($row) {
                    $btn2 = '<a href="users/destroy/' . $row->id . '" data-toggle="tooltip" data-original-title="Delete" class="badge badge-danger p-2">
                    <i class="fa-solid fa-trash-can" style="color:white;"></i>
                    </a>';
                    return $btn2;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.user.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
        return view('admin.user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $image = FileService::imageUploader($request, 'profile', 'profile/image/');
        if ($image != null) {
            $input['profile'] = $image;
        }
        $user = User::create($input);

        $user->assignRole($request->input('roles'));

        return redirect()->route('admin.users.index')
            ->with('success', $this->mls->messageLanguage('created', 'user', 1));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

        return view('admin.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['Admin', 'Admin'])->pluck('name', 'name');
        $userRole = $user->roles->pluck('name', 'name');
        return view('admin.user.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if (!empty($input['image'])) {
            $image = FileService::imageUploader($request, 'image', 'profile/image/');
            if ($image != null) {
                $input['image'] = $image;
            }
        } else {
            $input = Arr::except($input, array('image'));
        }

        $user = User::find($id);
        $user->update($input);
        //model_has_roles hasn't its modal file, so we have to use DB.
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        // return redirect()->route('admin.users.index')
        return redirect()->back()
            ->with('success', $this->mls->messageLanguage('updated', 'user', 1));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // $result=DB::table('users')->where('id', $id)->delete();
        $result = UserService::delete_user($id);

        return redirect()->back()->withSuccess('Data Delete Successfully!');

    }

    public function search1(Request $request)
    {

        $name = $request->input('user_id');

        $users = User::where('name', 'LIKE', '%' . $name . '%')->get();

        return response()->json($users);
    }

//     public function search(Request $request)
// {

//     echo" dn nd dkl nsdl";
//     die;
// if($request->ajax())
// {
// $output="";
// $products=DB::table('users')->where('name','LIKE','%'.$request->search."%")->get();
// if($products)
// {
// foreach ($products as $key => $product) {
// $output.='<tr>'.
// '<td>'.$product->name.'</td>'.
// '<td>'.$product->email.'</td>'.
// // '<td>'.$product->description.'</td>'.
// // '<td>'.$product->price.'</td>'.
// '</tr>';
// }
// return Response($output);
//    }
// }
// }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $records = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->orWhere('phone', 'like', '%' . $query . '%')
            ->get();
        return response()->json($records);
    }

    // public function createPDF() {
    //     // retreive all records from db
    //     $data = User::all();
    //     // share data to view
    //     view()->share('users',$data);
    //     $pdf = PDF::loadView('pdf_view', $data);
    //     // download PDF file with download method
    //     return $pdf->download('pdf_file.pdf');
    //   }

    public function status($id, $status)
    {

        $status = ($status == 1) ? 0 : 1;
        $result = UserService::update(['is_active' => $status], $id);
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

    /**
     * Update the language in User.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateLanguage(User $user, $language)
    {
        $result = $user->update(['lang' => $language]);
        session()->put('locale', $language);
        if ($result) {
            return response()->json([
                'status' => 1,
                'message' => $this->mls->onlyNameLanguage('language_updated'),
                'status_name' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 0,
                'message' => $this->mls->onlyNameLanguage('language_not_updated'),
                'status_name' => 'error',
            ]);
        }
    }

    public function emailapprove($id, $status)
    {

        $update = array('email_status' => $status);
        $result = UserService::status($update, $id);
        return redirect()->back()->withSuccess('Email Status Update Successfully!');

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

    public function phoneapprove($id, $phonestatus)
    {
        $update = array('phone_status' => $phonestatus);
        $result = UserService::status($update, $id);
        return redirect()->back()->withSuccess('Phone Status Update Successfully!');
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

    public function popular($id, $popular)
    {
        $update = array('popular' => $popular);
        $result = UserService::status($update, $id);
        return redirect()->back()->withSuccess('Popular Status Update Successfully!');
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

    public function trending($id, $trending)
    {
        $update = array('trending' => $trending);
        $result = UserService::status($update, $id);
        return redirect()->back()->withSuccess('Trending Status Update Successfully!');
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

    /**
     * Forget Password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function resetPasswordLoad(Request $request)
    {
        $resetData = DB::table('password_resets')->where('token', $request->token)->first();
        if ($resetData) {
            if (isset($request->token)) {
                $user = User::where('email', $resetData->email)->get();
                return view('admin.email.resetPassword', compact('user'));
            } else {
                return view('admin.email.404');
            }
        } else {
            return view('admin.email.404');
        }

    }

    //Password Reset Functionality

    public function resetPassword(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);
        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email', $user->email)->delete();

        return "
        <div class='container'>
            <div class='row justify-content-center vh-100'>
                <div class='col-md-6 col-sm-6 col-lg-6 col-xl-6 mx-auto'>
                    <div class='card'>
                        <div class='card-body d-flex flex-column align-items-center'>
                            <p class='card-text'>Your password has been reset successfully.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>";

    }

}