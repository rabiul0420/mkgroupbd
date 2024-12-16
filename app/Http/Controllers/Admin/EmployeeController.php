<?php

namespace App\Http\Controllers\Admin;

use App\Models\Menu;
use App\Models\User;
use App\Models\MenuActivity;
use Illuminate\Http\Request;
use App\Models\UserPermission;
use App\Models\EmployeeDesignation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::oldest()->paginate(50);
        $designations = EmployeeDesignation::all();
        return view('admin.employee.employee_list',compact('employees','designations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = $designations = EmployeeDesignation::all();
        $route = route("admin.employees.store");
        $page_title = "Add New Employee";
        $employee_id = User::getEmployeeId();
        $menus = Menu::with('activities')->get();
        return view('admin.employee.employee_add_edit',compact('designations','route','page_title','employee_id','menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // return $request;
        $this->validate($request,[
            'name' => 'required|string|max:50',
            'father_name' => 'required|string|max:50',
            'mother_name' => 'required|string|max:50',
            'national_id' => 'required|max:500',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'blood_group' => 'required',
            'email' => 'required|email|max:50|unique:users',
            'mobile' => 'required|max:15|unique:users',
            'password' => 'required|max:10',
            'designation' => 'required|int',
            'joining_date' => 'required|date',
            'salary' => 'required',
            'login_permission' => 'required|int|in:0,1',
            'status' => 'required|int|in:0,1',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpge,jpg,png',
            'cv_file' => 'required|mimes:pdf',
            'display_on_website' => 'required|in:0,1'
        ]);

        $user = new User();
        $user->employee_id = User::getEmployeeId();
        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->national_id = $request->national_id;
        $user->date_of_birth = date('Y-m-d',strtotime($request->date_of_birth));
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->password = Hash::make($request->password);
        $user->designation_id = $request->designation;
        $user->login_permission = $request->login_permission;
        $user->status = $request->status;
        $user->present_address = $request->present_address;
        $user->permanent_address = $request->permanent_address;
        $user->joining_date = date('Y-m-d',strtotime($request->joining_date));
        $user->salary = $request->salary;
        $user->last_working_date = $request->last_working_date ? date('Y-m-d',strtotime($request->last_working_date)) : null;
        $user->image = uploadImage($request->file('photo'),'assets/files/employees/photos/');
        $user->cv_path = uploadFile($request->file('cv_file'),'assets/files/employees/cvs/');
        $user->display_on_website = $request->display_on_website;
        $user->linkedin_url = $request->linkedin_url ?? null;
        $user->facebook_url = $request->facebook_url ?? null;
        $user->save();
        $activity_ids = $request->activity_id;

        if(isset($activity_ids) && count($activity_ids)) {
            UserPermission::whereIn('user_id',[$user->id])->delete();
            foreach ($activity_ids as $activity_id) {
                $menu_id = MenuActivity::find($activity_id)->menu_id;
                $user_permission = new UserPermission();
                $user_permission->user_id = $user->id;
                $user_permission->menu_id = $menu_id;
                $user_permission->activity_id = $activity_id;
                $user_permission->save();
            }
 
            foreach (MenuActivity::where('is_dependant',"Yes")->get() as $activity) {
                $menu_id = MenuActivity::find($activity_id)->menu_id;
                $user_permission = new UserPermission();
                $user_permission->user_id = $user->id;
                $user_permission->menu_id = $menu_id;
                $user_permission->activity_id = $activity_id;
                $user_permission->save();
            }
        } else {
            UserPermission::whereIn('user_id',[$user->id])->delete();
         }
        return redirect()->route('admin.employees.index')->with(savedMessage());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function show($employee_id)
    {
        $user = User::where('employee_id',$employee_id)->firstOrFail();
        $menus = Menu::with('activities')->get();
        return view('admin.employee.employee_details',compact('user','menus'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designations = $designations = EmployeeDesignation::all();
        $data = User::where('employee_id',$id)->firstOrFail();
        $route = route("admin.employees.update",$data->id);
        $page_title = "Edit Employee - ".$data->name;
        $menus = Menu::with('activities')->get();
        return view('admin.employee.employee_add_edit',compact('designations','route','page_title','route','data','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $rules = [
            'name' => 'required|string|max:50',
            'father_name' => 'required|string|max:50',
            'mother_name' => 'required|string|max:50',
            'national_id' => 'required|max:500',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
            'blood_group' => 'required',
            'email' => 'required|email|max:50|unique:users,email,'.$user->id,
            'mobile' => 'required|max:15|unique:users,mobile,'.$user->id,
            'designation' => 'required|int',
            'joining_date' => 'required|date',
            'salary' => 'required',
            'login_permission' => 'required|int|in:0,1',
            'status' => 'required|int|in:0,1',
            'present_address' => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255',
            'display_on_website' => 'required|in:0,1',
        ];
        /**
         * if ($request->isMethod('PUT') && is_null($user->password)) {
                if (!$request->has('password')) {  // Check if password is also absent in request
                    return back()->withErrors(['password' => 'The password field is required.']);
                }
            }
         */
        if ($request->isMethod('PUT')) {  
            if(is_null($user->password)) {
                $rules['password'] = 'required|min:6';
            }
            if(is_null($user->image)) {
                $rules['photo'] = 'required|image|mimes:jpge,jpg,png';
            }
            if(is_null($user->cv_path)) {
                $rules['cv_file'] = 'required|mimes:pdf';
            }
        }
        $this->validate($request, $rules);

        $user->name = $request->name;
        $user->father_name = $request->father_name;
        $user->mother_name = $request->mother_name;
        $user->national_id = $request->national_id;
        $user->date_of_birth = date('Y-m-d',strtotime($request->date_of_birth));
        $user->gender = $request->gender;
        $user->blood_group = $request->blood_group;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        if(isset($request->password)) {
            $user->password = Hash::make($request->password);

        }
        $user->designation_id = $request->designation;
        $user->login_permission = $request->login_permission;
        $user->status = $request->status;
        $user->present_address = $request->present_address;
        $user->permanent_address = $request->permanent_address;
        $user->joining_date = date('Y-m-d',strtotime($request->joining_date));
        $user->salary = $request->salary;
        $user->last_working_date = $request->last_working_date ? date('Y-m-d',strtotime($request->last_working_date)) : null;
        if($request->file('photo')) {
            $user->image = uploadImage($request->file('photo'),'assets/files/employees/photos/');
        }
        if($request->file('cv_file')) {
            $user->cv_path = uploadFile($request->file('cv_file'),'assets/files/employees/cvs/');
        }
        $user->display_on_website = $request->display_on_website;
        $user->linkedin_url = $request->linkedin_url ?? null;
        $user->facebook_url = $request->facebook_url ?? null;
        $user->save();
        $activity_ids = $request->activity_id;

        if(isset($activity_ids) && count($activity_ids)) {
            UserPermission::whereIn('user_id',[$user->id])->delete();
            foreach ($activity_ids as $activity_id) {
                $menu_id = MenuActivity::find($activity_id)->menu_id;
                $user_permission = new UserPermission();
                $user_permission->user_id = $user->id;
                $user_permission->menu_id = $menu_id;
                $user_permission->activity_id = $activity_id;
                $user_permission->save();
            }
 
            foreach (MenuActivity::where('is_dependant',"Yes")->get() as $activity) {
                $menu_id = MenuActivity::find($activity_id)->menu_id;
                $user_permission = new UserPermission();
                $user_permission->user_id = $user->id;
                $user_permission->menu_id = $menu_id;
                $user_permission->activity_id = $activity_id;
                $user_permission->save();
            }
        } else {
            UserPermission::whereIn('user_id',[$user->id])->delete();
         }
        return redirect()->route('admin.employees.index')->with(updateMessage());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
