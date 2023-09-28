<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use App\Helpers\CustomerHelper;
use App\User;
use App\StaffWorkingHour;
use Carbon\Carbon;
use Config;

class AccessController extends Controller
{
  public function index(){

    // Breadcrumbs  
     $breadcrumbs = [
        ['link' => "/", 'name' => "Home"], ['link' => "#", 'name' => " Extra Components"], ['name' => "Access Controller"],
    ];
    //Pageheader set true for breadcrumbs
    $pageConfigs = ['pageHeader' => true];
        
      return view('pages.access-control',['pageConfigs'=>$pageConfigs,'breadcrumbs'=>$breadcrumbs]);
    }
    public function roles($role){
      if(Auth::user()){
          // check group is empty
        $roles = DB::table('roles')->count();
        if($roles == null){
          //if group empty add two group and assign permission
          $editor = Role::create(['name' => 'Editor']);
          $permissionEditor = Permission::create(['name' => 'create articles']);
          $editor->givePermissionTo($permissionEditor);

          $admin = Role::create(['name' => 'Admin']);
          $permission = Permission::create(['name' => 'approve articles']);
          $admin->givePermissionTo($permission,$permissionEditor);
        } 
        //if 
          $user = Auth::user();
          if($role === 'admin'){
            $user->removeRole('Editor');
            $user->assignRole('Admin');
          }
          else{
            $user->removeRole('Admin');
            $user->assignRole('Editor'); 
         }
      }
      return redirect()->back();
    }
    public function home(){
        return view('pages.dashboard-ecommerce');
    }
    public function rolelists(Request $request){
      $data = DB::table('roles')->get();
      return view('pages.roles-permissions.roles',compact('data'));

    }
    public function permissionlists(Request $request){
      $data = DB::table('permissions')->get();
      return view('pages.roles-permissions.permissions',compact('data'));

    }
    public function RolesPermissions(Request $request){
      $roles = DB::table('roles')->get();
      $permissions = DB::table('permissions')->get();
      $data = DB::table('role_has_permissions')
      ->select('role_has_permissions.*','roles.name as role','permissions.name as permission')
      ->join('roles','roles.id','=','role_has_permissions.role_id')
      ->join('permissions','permissions.id','=','role_has_permissions.permission_id')
      ->get();
      return view('pages.roles-permissions.roles-permissions',compact('roles','permissions','data'));

    }
    public function RolesPermissionsSelected(Request $request,$role_id){
      
      $data = DB::table('role_has_permissions')
      ->where('role_id',$role_id)
      ->get();
      return $data;
    }
    public function RolesPermissionsSetup(Request $request){
      //print_r($request->all());exit;
      $role = Role::where('id',$request->role)->first();
      $data = DB::table('role_has_permissions')
      ->where('role_id',$request->role)
      ->delete();
      foreach($request->permisions as $per){
        
        $role->givePermissionTo($per);
      }
      return back();
    }
    public function staffWorkingTime(Request $request){
      $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Staff Working Hours"]

        ];

        $types = User::get();
        //dd($types);

        $input_value = $request->all();
        $start_date = Carbon::today()->format('Y-m-d');
        $end_date = Carbon::today()->format('Y-m-d');

        $filters = [];

        $filters['from_date'] = isset($input_value['from_date']) ? Carbon::parse($input_value['from_date'])->format('Y-m-d') : $start_date;

        $filters['to_date'] = isset($input_value['to_date']) ? Carbon::parse($input_value['to_date'])->format('Y-m-d') : $end_date;

        $filters['staff_id'] = isset($input_value['staff_id']) ? $input_value['staff_id'] : '';

        

        //DB::enableQueryLog();
       

        $customers = StaffWorkingHour::
        where(function($query) use ($filters){
            if(isset($filters['staff_id']) && $filters['staff_id']!=''){
              $query->where('staff_id',$filters['staff_id']);
            }
            $query->whereBetween('login_date',[$filters['from_date'],$filters['to_date']]);

        })
        
        ->orderBy('id','DESC')->get();
        //dd($customers);

      return view('pages.roles-permissions.staff_working_hours', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'types' => $types, 'customers' => $customers]);

    }
    public function staffWorkingTimeView(Request $request,$id){
      $configData = CustomerHelper::configData('admin_config');

        $pageConfigs = ['pageHeader' => true];

        $breadcrumbs = [

            ["link" => "/".$configData['route']."/", "name" => "Home"], ["name" => "Staff "]

        ];
      $date = Carbon::today()->format('Y-m-d');

      $customers = StaffWorkingHour::with(['user'=>function($query){

          //$query->where('id', 'account_name','account_name_slug');

      },'end_date' => function($query)use($date){
        $query->where('login_date',$date);

      }])->where('login_date',$date)->where('staff_id',$id)->get();
      //dd($customers);

    return view('pages.roles-permissions.staff_working_hours_views', ['configData' => $configData, 'pageConfigs' => $pageConfigs, 'breadcrumbs' => $breadcrumbs, 'customers' => $customers]);
    }
}
