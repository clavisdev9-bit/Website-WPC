<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\usersModel;
use App\Models\MenuModel;
use App\Http\Requests\MenuValidation;
use App\Models\SubmenuModel;
use App\Http\Requests\submenuValidation;
use App\Models\RoleModel;
use App\Http\Requests\ValidationRole;
use App\Models\AccessMenuModel;
use App\Models\GroupModel;
USE App\Models\DivisionModel;
use App\Http\Requests\ValidationUser;
use App\Models\AccesssubMenuModel;
use App\Models\CountryNetworkAgentModel;
use App\Http\Requests\validationCountryAgentNetwork;
use App\Models\CityNetworkAgentModel;
use App\Http\Requests\StoreAgentCityNetworkRequest;
use App\Models\NetworkAgentModel;
use App\Http\Requests\StoreNetworkAgentRequest;
use App\Models\ContinentAgentModel;
use App\Http\Requests\StoreContinentRequest;
use App\Models\SubContinentModel;
use App\Http\Requests\StoreSubContinentRequest;


class Administrator extends Controller
{
        protected $usersModel;
        protected $MenuModel;
        protected $SubmenuModel;
        protected $RoleModel;
        protected $AccessMenuModel;
        protected $GroupModel;
        protected $DivisionModel;
        protected $AccesssubMenuModel;
        protected $CountryNetworkAgentModel;
        protected $CityNetworkAgentModel;
        protected $NetworkAgentModel;
        protected $ContinentAgentModel;
        protected $SubContinentModel;
        public function __construct(usersModel $usersModel, MenuModel $MenuModel, SubmenuModel $SubmenuModel, RoleModel $RoleModel,
         AccessMenuModel $AccessMenuModel, DivisionModel $DivisionModel,
          GroupModel $GroupModel, AccesssubMenuModel $AccesssubMenuModel,
           CountryNetworkAgentModel $CountryNetworkAgentModel,
           CityNetworkAgentModel $CityNetworkAgentModel,
           NetworkAgentModel $NetworkAgentModel,
           ContinentAgentModel $ContinentAgentModel,
           SubContinentModel $SubContinentModel,
           ) {
            $this->usersModel = $usersModel;
            $this->MenuModel = $MenuModel;
            $this->SubmenuModel = $SubmenuModel;
            $this->RoleModel = $RoleModel;
            $this->GroupModel = $GroupModel;
            $this->DivisionModel = $DivisionModel;
            $this->AccessMenuModel = $AccessMenuModel;
            $this->AccesssubMenuModel = $AccesssubMenuModel;
            $this->CountryNetworkAgentModel = $CountryNetworkAgentModel;
            $this->CityNetworkAgentModel = $CityNetworkAgentModel;
            $this->NetworkAgentModel = $NetworkAgentModel;
            $this->ContinentAgentModel = $ContinentAgentModel;
            $this->SubContinentModel = $SubContinentModel;

        }

    public function index()  {
            $TotalUsers = $this->usersModel->count();
            $TotalRole = $this->RoleModel->count();
            $TotalMenu = $this->MenuModel->count();
            $TotalSubmenu = $this->SubmenuModel->count();
        $data = [
                'title' => 'Dashboard',
                'users' => $TotalUsers,
                'role' => $TotalRole,
                'menu' => $TotalMenu,
                'submenu' => $TotalSubmenu
        ];
        return view('administrator.dashboard.file', $data);
    }


    public function Menu_Management() {
        $data = [
             'title' => 'Data Menu Management'
        ];
        return view('administrator.menu.datatable.file', $data);
    }


    public function getMenu(Request $request)
{
    if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->MenuModel->orderBy('menu', 'asc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('menu', 'LIKE', "%{$searchTerm}%");
        }
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $idmenuCrypt = Crypt::encrypt($row->id_menu);
                $updateMenu =  route('Administrator.menu.view.update',$idmenuCrypt);
                $deleteMenuUrl = route('Administrator.delete.menu.management', ['id' => $idmenuCrypt]);
                        $btn = '<a href="' .$updateMenu. '" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';

                        $btn .= '<form action="' . $deleteMenuUrl . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';

                    
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}



public function createMenu() {
     $data = [
             'title' => 'Form Add Menu Management'
        ];
        return view('administrator.menu.form.create', $data);
}


public function storeMenu(MenuValidation $request) {
     
  try {
      //   cek name already exist
      if (MenuModel::isMenuExists($request->input('menu'))) {
          return redirect()->route('Administrator.menu')
              ->with('error', 'Menu name already exists.');
      }

      $this->MenuModel->create([
          'menu' => $request->input('menu')
      ]);
      
  
     return redirect()->route('Administrator.menu')->with('success','success save');
     } catch (\Throwable $th) {
         return redirect()->route('Administrator.menu')->with('error','Failed to create data. Please try again.');
     }
}

public function showMenu (Request $request, $id)  {
    $idDecy = Crypt::decrypt($id);
    $getMenu = $this->MenuModel->findOrFail($idDecy);
    $data  = [
        'title' => 'Update Management Menu',
        'idMenu' => $id,
        'row' => $getMenu
    ];
  return view('administrator.menu.form.update', $data);
}
 

public function UpdateMenu(MenuValidation $request)  {
    try {
        try {
            $menuid = $request->input('idMenu');
            $idMenuDecrypted = Crypt::decrypt($menuid);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Administrator.menu.management')
                ->with('error', 'Invalid menu ID!');
        }
    
          $menuData = $this->MenuModel->findOrFail($idMenuDecrypted);
    
        //   cek name already exist
          if (MenuModel::isMenuExists($request->input('menu'), $idMenuDecrypted)) {
            return redirect()->route('Administrator.menu')
                ->with('error', 'Menu name already exists!');
          }
    
          $menuData->update([
            'menu' => $request->input('menu')
        ]);
    
        return redirect()->route('Administrator.menu')->with('success','update success');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.menu')->with('error','Failed to update data. Please try again.');
    }
}


public function DeleteMenu($id)  {
    try {
        $idMenuDecrypted = Crypt::decrypt($id);
        $menuData = MenuModel::find($idMenuDecrypted);

        if (!$menuData) {
            return redirect()->route('Administrator.menu')
                ->with('error', 'Data ID Not Found!');
        }

        $menuData->delete();
        
        return redirect()->route('Administrator.menu')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Administrator.menu')
            ->with('error', 'Invalid menu ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.menu')
            ->with('error', 'Failed to delete data. Please try again.');
    }
}
  // end code menu





  // start code submenu
  public function submenuManagement()  {
    $data = [
         'title' =>  'Data Sub-Menu'
    ];
    return view('administrator.submenu.datatable.file', $data);
}



public function getSubMenu(Request $request) {
    if ($request->ajax()) {
   
        $query = $this->SubmenuModel
    ->select(
        'submenus.*',
        'submenus.title as titles',
        'menus.menu',
        'parent_submenu.title AS parent_menu_name'
    )
    ->leftJoin('menus', 'submenus.id_menu', '=', 'menus.id_menu')
    ->leftJoin('submenus AS parent_submenu', 'submenus.parent_id', '=', 'parent_submenu.id_submenu')
    ->orderBy('submenus.created_at', 'desc')
    ->get();

// Cek apakah ada parameter pencarian
if ($request->has('search') && !empty($request->input('search')['value'])) {
    $searchTerm = $request->input('search')['value'];
    $query->where('submenus.title', 'LIKE', "%{$searchTerm}%");
}

        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('icon', function($row) {
                return ($row->icon == null) ? 'Tidak Ada Icon Karena Bukan Submenu Utama' : $row->icon;
            })
            
            ->addColumn('url', function($row){
                return '<textarea class="form-control"  rows="2" cols="2" readonly>'.$row->url.'</textarea>';
            })

             ->addColumn('menu', function($row) {
                        $map = [
                            'Administrator'         => 'blue',
                            'Admin_Cms_Website'     => 'yellow',
                            'Admin_Quotation_system'=> 'red',
                            'Costumers'             => 'cyan',
                            'Setting_General'       => 'dark',
                        ];

                        $color = $map[$row->menu] ?? 'secondary';

                        return '<span class="badge bg-'.$color.'-lt">'.$row->menu.'</span>';
                    })


            ->addColumn('details', function ($row) {
                return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-menu="' . htmlspecialchars($row->menu, ENT_QUOTES, 'UTF-8') . '"
                             data-url="' . htmlspecialchars($row->url, ENT_QUOTES, 'UTF-8') . '"
                             data-title="' . htmlspecialchars($row->title, ENT_QUOTES, 'UTF-8') . '"
                             data-pmn="' . ($row->parent_menu_name == 0 ? 'Tidak Ada Parent' : $row->parent_menu_name) . '"
                             data-noted="' . htmlspecialchars($row->noted, ENT_QUOTES, 'UTF-8') . '"
                             data-icon="' . ($row->icon == 0 ? 'Tidak Ada Icon Karena Bukan Submenu Utama' : $row->icon) . '"
                             data-status="' . ($row->is_active == 0 ? 'Tidak Aktif Karena Bukan Submenu Utama' : 'Aktif Karena Submenu Utama') . '"
                            >
                            <i class="fa fa-sticky-note"> </i> Details
                        </a>';
            }) 

            ->addColumn('action', function ($row) {
                $getIdSubmenu = Crypt::encrypt($row->id_submenu);
                $urlEdit = route('Administrator.submenu.view.update', $getIdSubmenu);
                $urlDeleteSubmenu = route('Administrator.delete.submenu.management', $getIdSubmenu);
                        $btn = '<a href="'. $urlEdit .'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                        $btn .= '<form action="' . $urlDeleteSubmenu . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action','is_active','url','menu','details'])
            ->make(true);
    }
}


public function createSubmenu() {
    $getMenu = $this->MenuModel->all();
    $getSubMenu = $this->SubmenuModel->all();
    $data = [
        'title' =>  'Form Create Sub-Menu',
        'menu' => $getMenu,
        'submenu' => $getSubMenu
   ];
   return view('administrator.submenu.form.create', $data);
}


public function storeSubMenu(submenuValidation $request)  {
        try {
            if (SubmenuModel::isTitleExists($request->input('title'))) {
                return redirect()->route('Administrator.sub.menu.management')
                    ->with('error', 'Title name already exists.');
            }
            $this->SubmenuModel->create([
                'id_menu' => $request->input('menu'),
                'parent_id' => $request->input('parent') ?: null,
                'title' => $request->input('title'),
                'url' => $request->input('url'),
                'icon' => $request->input('icon'),
                'is_active' => $request->input('status'),
                'noted' => $request->input('noted')
            ]);
        return redirect()->route('Administrator.sub.menu.management')->with('success','success save');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.sub.menu.management')->with('error','Failed to create data. Please try again.');
        }
   }


   public function showSubmenu(Request $request, $id) {
    $getMenu = $this->MenuModel->all();
    $getSubMenu = $this->SubmenuModel->all();

    $DecyId = Crypt::decrypt($id);
    $getDataSubmenu = $this->SubmenuModel->findOrFail($DecyId);
   
    $data = [
        'title' =>  'Form Update Sub-Menu',
        'menu' => $getMenu,
        'submenu' => $getSubMenu,
        'idSubmenu' => $id,
        'row' => $getDataSubmenu
   ];
   return view('administrator.submenu.form.update', $data);
   }


     public function UpdateSubMenu(submenuValidation $request)  {
   
    try {
     try {
        $idSubMenu = $request->input('idSubmenu');
        $idSubMenuDecrypted = Crypt::decrypt($idSubMenu);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return redirect()->route('Administrator.sub.menu.management')
            ->with('error', 'Invalid Submenu ID!');
    }

      $subMenuData = $this->SubmenuModel->findOrFail($idSubMenuDecrypted);

      if (SubmenuModel::isSubMenuExists($request->input('title'), $idSubMenuDecrypted)) {
        return redirect()->route('Administrator.sub.menu.management')
            ->with('error', 'SubMenu Title already exists!');
      }

    $subMenuData->update([
        'id_menu' => $request->input('menu'),
         'parent_id' => $request->input('parent') ?: null,
        'title' => $request->input('title'),
        'url' => $request->input('url'),
        'icon' => $request->input('icon'),
        'is_active' => $request->input('status'),
        'noted' => $request->input('noted')
    ]);

    return redirect()->route('Administrator.sub.menu.management')->with('success','update success');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.sub.menu.management')->with('error','Failed to update data. Please try again.');
    }
  }


 public function DeleteSubMenu($id) {
    try {
        $idSubMenuDecrypted = Crypt::decrypt($id);
        $submenuData = SubmenuModel::find($idSubMenuDecrypted);

        if (!$submenuData) {
            return redirect()->route('Administrator.sub.menu.management')
                ->with('error', 'Data ID Not Found!');
        }

        $submenuData->delete();
        
        return redirect()->route('Administrator.sub.menu.management')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Administrator.sub.menu.management')
            ->with('error', 'Invalid submenu ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.sub.menu.management')
            ->with('error', 'Failed to delete data. Please try again.');
    }
  }



   public function RoleManagement()  {
    $data = [
        'title' =>  'Data Role'
   ];
   return view('administrator.role.datatable.file', $data);
  }


  public function getRole(Request $request) {
    if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->RoleModel->orderBy('role', 'asc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('role', 'LIKE', "%{$searchTerm}%");
        }
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('access', function($row) {
                $urlAccess = route('Administrator.role.access.menu', Crypt::encrypt($row->id_role));
                return '<a href="'.$urlAccess.'" class="btn btn-outline-orange btn-sm"><i class="fa fa-reply-all"></i> Access To Menu</a>';
            })


            ->addColumn('action', function ($row) {
                $idRoleCrypt = Crypt::encrypt($row->id_role);
                $editUrl = route('Administrator.role.view.update',$idRoleCrypt);
                $deleteRoleUrl = route('Administrator.delete.role.management', $idRoleCrypt);
                        $btn = '<a href="'. $editUrl .'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                        $btn .= '<form action="' . $deleteRoleUrl . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })


            ->rawColumns(['action','access'])
            ->make(true);
    }
  }



  public function createRole ()  {
    $data  = [
        'title' => 'Create Management Role'
    ];
  return view('administrator.role.form.create', $data);
  }


 public  function storeRole(ValidationRole $request)  {

    try {
        //   cek name already exist
        if (RoleModel::isRoleExists($request->input('role'))) {
            return redirect()->route('Administrator.role.management')
                ->with('error', 'Role name already exists.');
        }
  
        $this->RoleModel->create([
            'role' => $request->input('role'),
            'description' => $request->input('description_role')
        ]);
        
       return redirect()->route('Administrator.role.management')->with('success','success save');
       } catch (\Throwable $th) {
           return redirect()->route('Administrator.role.management')->with('error','Failed to create data. Please try again.');
       }
  }



   public function showRole(Request $request, $idRole) {
    $idDecy = Crypt::decrypt($idRole);
    $getDataRole = $this->RoleModel->findOrFail($idDecy);

    $data  = [
        'title' => 'Update Management Role',
        'row' => $getDataRole,
        'idRole' => $idRole

    ];
  return view('administrator.role.form.update', $data);
  }


 public  function UpdateRole(ValidationRole $request)  {
        try {
            $roleid = $request->input('idRole');
            try {
                $idDecy = Crypt::decrypt($roleid);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return redirect()->route('Administrator.menu.management')
                    ->with('error', 'Invalid Role ID!');
            }
            $roleData = $this->RoleModel->findOrFail($idDecy);
            //   cek name already exist
            if (RoleModel::isRoleExistsEdit($request->input('role'), $idDecy)) {
                return redirect()->route('Administrator.role.management')
                    ->with('error', 'Role name already exists!');
            }
            $roleData->update([
                'role' => $request->input('role'),
                'description' => $request->input('description_role')
            ]);
            return redirect()->route('Administrator.role.management')->with('success','update success');

        } catch (\Throwable $th) {
            return redirect()->route('Administrator.role.management')->with('error','Failed to create data. Please try again.');
        }
  }


  public function DeleteRole($id)  {
    try {
        $idRoleDecrypted = Crypt::decrypt($id);
        $roleData = RoleModel::find($idRoleDecrypted);
        if (!$roleData) {
            return redirect()->route('Administrator.role.management')
                ->with('error', 'Data ID Not Found!');
        }

        $roleData->delete();
        
        return redirect()->route('Administrator.role.management')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Administrator.role.management')
            ->with('error', 'Invalid submenu ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.role.management')
            ->with('error', 'Failed to delete data. Please try again.');
    }
  }


   public function AccessRoleMenu($id)  {
      $idRole  = Crypt::decrypt($id);
      $getdatamenu = MenuModel::all();
      $getroleid = RoleModel::findOrFail($idRole);

      $data = [
         'title' => 'List Access Role',
         'menu' => $getdatamenu, 
         'roles' => $getroleid
      ];
      return view('administrator.role.access.data', $data);
  }



public function ChangeAccessMenu(Request $request)  {

    $menuId = Crypt::decrypt($request->menuId);
    $roleId = Crypt::decrypt($request->roleId);
    // Siapkan data untuk query
    $data = [
        'id_role' => $roleId,
        'id_menu' => $menuId
    ];
    // Cek apakah data sudah ada di database
    $exists = $this->AccessMenuModel
        ->where($data)
        ->exists();
    if (!$exists) {
        // Jika tidak ada, lakukan insert
        $this->AccessMenuModel->insert($data);
        Session::flash('success', 'Access Changed');
    } else {
        // Jika ada, lakukan delete
        $this->AccessMenuModel->where($data)->delete();
        Session::flash('success', 'Access Changed');
    }
    // Kembalikan response JSON atau redirect sesuai kebutuhan
    return response()->json(['success' => true]);
 }




 public function UserManagement() {
     $data  = [
        'title' => 'User Management',
    ];
  return view('administrator.user.datatable.file', $data);
  }



    public function getUser(Request $request)  {
    if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->usersModel
        ->select('ms_users.*','division.name_division as nama_divisi','group_companies.name_group','roles.role')
        ->leftJoin('division','ms_users.divisi_id', '=', 'division.id')
        ->leftJoin('group_companies','ms_users.group_id', '=', 'group_companies.id_group')
        ->leftJoin('roles','ms_users.role_id', '=', 'roles.id_role')
        ->orderBy('fullname', 'asc');


        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('fullname', 'LIKE', "%{$searchTerm}%");
        }
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('image', function($row) {
                // Menggunakan route dengan parameter filename
                $imageUrl = route('avatar.show', ['filename' => $row->image]);
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })

            ->addColumn('access', function($row) {
                $urlAccess = route('Administrator.user.access.submenu', Crypt::encrypt($row->id_user));
                return '<a href="'.$urlAccess.'" class="btn btn-outline-orange btn-sm"><i class="fa fa-eye"> </i> Access User To submenu</a>';
            })

           



            ->addColumn('details', function ($row) {
                return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-fn="' . htmlspecialchars($row->fullname, ENT_QUOTES, 'UTF-8') . '"
                             data-un="' . htmlspecialchars($row->username, ENT_QUOTES, 'UTF-8') . '"
                             data-pw="' . htmlspecialchars($row->password, ENT_QUOTES, 'UTF-8') . '"
                             data-st="' . ($row->is_active === true ? 'Aktif' : 'Nonaktif') . '"
                            >
                            <i class="fa fa-sticky-note"> </i> Details
                        </a>';
            })

            ->addColumn('action', function ($row) {
                     $idUserCrypt = Crypt::encrypt($row->id_user);
                $editUrl = route('Administrator.user.view.update',$idUserCrypt);
                $userDeleteUrl = route('Administrator.delete.user.management', $idUserCrypt);
                        $btn = '<a href="'.$editUrl.'" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                        $btn .= '<form action="' . $userDeleteUrl . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })

            ->rawColumns(['action','access','details','image'])
            ->make(true);
    }
  }



  public function createUser()  {

    $getDataRole = $this->RoleModel->all();
    $getDataDivisi = $this->DivisionModel->all();
    $getdataGroup = $this->GroupModel->all();
   
    $data  = [
        'title' => 'Form Add User',
        'role' => $getDataRole,
        'divisi' => $getDataDivisi,
        'group' => $getdataGroup
    ];
    return view('administrator.user.form.create', $data);
  }



  public function storeUser(ValidationUser $request)  {
    try {
        //   cek username already exist
        if (usersModel::isUsernameExistsAdd($request->input('username'))) {
            return redirect()->route('Administrator.user.management')
                ->with('error', 'Username already exists.');
        }
  
        $this->usersModel->create([
            'fullname' => $request->input('fullname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => $request->input('role'),
            'group_id' => $request->input('group'),
            'divisi_id' => $request->input('divisi'),
            'is_active' => $request->input('status'),
            'image' => 'default.jpg',
        ]);
        
       return redirect()->route('Administrator.user.management')->with('success','success save');
       } catch (\Throwable $th) {
           return redirect()->route('Administrator.user.management')->with('error','Failed to create data. Please try again.');
       }
  }


    public function showUser($id)  {
    $getDataRole = $this->RoleModel->all();
    $getDataDivisi = $this->DivisionModel->all();
    $getdataGroup = $this->GroupModel->all();

    $decyId = Crypt::decrypt($id);
    $getDataUser = $this->usersModel->findOrFail($decyId);

    $data  = [
        'title' => 'Form Update User',
        'role' => $getDataRole,
        'divisi' => $getDataDivisi,
        'group' => $getdataGroup,
        'row' => $getDataUser,
        'id' => $id

    ];
    return view('administrator.user.form.update', $data);
  }



  public function UpdateUser(ValidationUser $request)
{
    try {
        // Ambil dan decrypt id_user
        try {
            $idUser = $request->input('id_user', null);
            $idDecy = Crypt::decrypt($idUser);
          
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Administrator.user.management')
                ->with('error', 'Invalid User ID!');
        }

        // Cari user berdasarkan id
        $user = $this->usersModel->findOrFail($idDecy);

        // Cek username duplikat
        if (usersModel::isUsernameExistsEdit($request->input('username'), $idDecy)) {
            return redirect()->route('Administrator.user.management')
                ->with('error', 'Username already exists!');
        }

        // Proses password baru jika ada
        $hashedPassword = $user->password;
        if (!empty($request->input('password'))) {
            $hashedPassword = \Illuminate\Support\Facades\Hash::make($request->input('password'));
        }

        // Proses gambar
        $newImage = $request->file('image');
        $oldImage = $request->input('imageold');

        if ($newImage) {
            // Simpan gambar baru di storage
            $imagePath = $newImage->store('profile', 'public');
            $imageName = basename($imagePath);

            // Hapus gambar lama kalau ada dan bukan default
            if ($oldImage && $oldImage !== 'default.jpg') {
                $oldImagePath = storage_path('app/public/profile/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $imageName = $oldImage;
        }

        // Update user
        $user->update([
            'fullname'  => $request->input('fullname'),
            'username'  => $request->input('username'),
            'email'     => $request->input('email'),
            'password'  => $hashedPassword,
            'role_id'   => $request->input('role'),
            'group_id'  => $request->input('group'),   // ⬅️ pastikan pakai nama kolom yang benar
            'divisi_id' => $request->input('divisi'),
            'is_active' => $request->input('status'),
            'image'     => $imageName,
        ]);

        return redirect()->route('Administrator.user.management')
            ->with('success', 'User updated successfully');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.user.management')
            ->with('error', 'Failed to update data. Please try again.');
    }
}




 public function DeleteUser ($id) {
        try {
            $idUserDecrypted = Crypt::decrypt($id);
            $userData = usersModel::find($idUserDecrypted);
 
            $images = $userData->image;
          
            if (!$userData) {
                return redirect()->route('Administrator.user.management')
                    ->with('error', 'Data ID Not Found!');
            }


            if ($images && $images !== 'default.jpg') {
                // Menentukan path file gambar di storage/app/avatar
                $imagePath = storage_path('app/public/profile/' . $images);
                // Memastikan gambar ada di folder tersebut dan menghapusnya
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            $userData->delete();
            
            return redirect()->route('Administrator.user.management')->with('success', 'Success delete');
        } catch (DecryptException $e) {
            return redirect()->route('Administrator.user.management')
                ->with('error', 'Invalid ID!');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.user.management')
                ->with('error', 'Failed to delete data. Please try again.');
        }
      }

  
      public function AccessUser($id)  {
        $id_user = Crypt::decrypt($id);
        $getdatasubmenu = $this->SubmenuModel
        ->select('submenus.*', 'menus.menu as menu_name')  // Pilih kolom dari tabel submenu dan kolom yang digabungkan
        ->leftJoin('menus', 'submenus.id_menu', '=', 'menus.id_menu')
        ->orderby('submenus.id_submenu','desc')  // Gabungkan tabel submenu dengan menu, tampilkan semua data dari submenu
        ->get();
    
        $getuserbyid = $this->usersModel
                ->where('id_user', $id_user)  // Menambahkan kondisi pencarian berdasarkan ID pengguna
                ->first();
    
        $data = [
            'title' => 'Management Access user',
            'submenu' => $getdatasubmenu,
            'userID' =>  $getuserbyid
        ];
        return view('administrator.user.access.file', $data);
    }



public function ChangeAccessSubMenu(Request $request)  {
        // Mendapatkan data dari request
    $submenu = $request->input('submenu');
    $userId = $request->input('userId');

    //  dd($submenu);
    // Menyiapkan data untuk query
    $data = [
        'id_submenu' => $submenu,
        'id_user' => $userId
    ];

    
    // Cek apakah data ada di tabel
    $exists = $this->AccesssubMenuModel
                ->where($data)
                ->exists();
                
    if (!$exists) {
        // Jika data tidak ada, lakukan insert
        $this->AccesssubMenuModel->insert($data);
        Session::flash('success', 'Access Changed');
       
    } else {
        // Jika data sudah ada, lakukan delete
        $this->AccesssubMenuModel->where($data)->delete();
        Session::flash('success', 'Access Changed');
     
    }
    // Mengembalikan response JSON
    return response()->json(['success' => true]);
    }


   


    // code master Agent Country
    public function AgentNetworkCountry()  {
         $data = [
              'title' => 'Agent Network Country'
         ];
         return view('administrator/agent-country/data/file',$data);
    }


    public function getDataAgentCountryNetwork(Request $request)
{
    if ($request->ajax()) {
        // Mulai query tanpa get() dulu
       $query = $this->CountryNetworkAgentModel
                    ->select(
                        'countries_network_agent.*',
                        'subcontinents_network_agent.name as name_subcontinent'
                    )
                    ->leftJoin(
                        'subcontinents_network_agent',
                        'subcontinents_network_agent.id',
                        '=',
                        'countries_network_agent.subcontinent_id'
                    )
                    ->orderBy('name', 'asc');

                // Cek apakah ada parameter pencarian
                if ($request->has('search') && !empty($request->input('search')['value'])) {
                    $searchTerm = $request->input('search')['value'];
                    $query->where('name', 'LIKE', "%{$searchTerm}%");
                }

        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('flag', function($row) {
                // Menggunakan route dengan parameter filename
                $imageUrl = route('flag.image.show', ['filename' => $row->flag]);
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })

            ->addColumn('action', function ($row) {
                $idCountry= Crypt::encrypt($row->id);
                $updateCountry =  route('Administrator.agent.network.country.view.update',$idCountry);
                $deleteCountry = route('Administrator.delete.agent.network.country', ['id' => $idCountry]);
                        $btn = '<a href="' . $updateCountry . '" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';

                        $btn .= '<form action="' . $deleteCountry. '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action','flag'])
            ->make(true);
    }
}



public function createDataAgentCountryNetwork()
{
    // $response = Http::get('http://53794bb17cf4.ngrok-free.app/countries');
  $response = Http::withoutVerifying()->get('https://53794bb17cf4.ngrok-free.app/countries');
    if ($response->successful()) {
        $json = $response->json();
        $countries = $json['data'] ?? []; // ambil isi 'data'
    } else {
        $countries = [];
    }

    // Simpan hasil API selama 1 jam (3600 detik)
    // $countries = Cache::remember('countries_data', 3600, function () {
    //     try {
    //         // Gunakan timeout agar tidak menggantung
    //         $response = Http::timeout(5)->get('http://53794bb17cf4.ngrok-free.app/countries');
              
    //         if ($response->successful()) {
    //             $json = $response->json();
    //             return $json['data'] ?? [];
    //         }
    //     } catch (\Exception $e) {
    //         // Kalau error (timeout, koneksi, dsb), return array kosong
    //         \Log::error('Error fetching countries: ' . $e->getMessage());
    //     }

    //     return []; // fallback default
    // });

    $getSubContinent =  $this->SubContinentModel->all();
    $data = [
        'title' => 'Form Add Agent Network Country',
        'dataCountry' => $countries,
        'SubContinent' => $getSubContinent
    ];
    return view('administrator/agent-country/form/create', $data);
}




    public function storeDataAgentCountryNetwork(Request $request)  {
        try {
                $Country = new CountryNetworkAgentModel();
                $Country->name             = $request->input('country');
                $Country->iso_code         = $request->input('iso_code');
                $Country->subcontinent_id  = $request->input('sub_continent');

        // Upload file kalau ada
                if ($request->hasFile('flag')) {
                    $file     = $request->file('flag');
                    $imageName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('flag', $imageName, 'public');
                    $Country->flag = $imageName;
                } else {
                    $Country->flag = 'default_flag.png';
                }
              
                $Country->save();

                
                return redirect()->route('Administrator.agent.network.country')->with('success','success save');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.country')->with('error','Failed to create data. Please try again.');
        }
    }


    public function showDataAgentCountryNetwork($id) {
        $response = Http::withoutVerifying()->get('https://53794bb17cf4.ngrok-free.app/countries');
            if ($response->successful()) {
                $json = $response->json();
                $countries = $json['data'] ?? []; // ambil isi 'data'
            } else {
                $countries = [];
            }

    //     $countries = Cache::remember('countries_data', 3600, function () {
    //     try {
    //         $response = Http::timeout(5)->get('http://53794bb17cf4.ngrok-free.app/countries');

    //         if ($response->successful()) {
    //             $json = $response->json();
    //             return $json['data'] ?? [];
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error('Error fetching countries: ' . $e->getMessage());
    //     }

    //     return []; // fallback jika API gagal
    // });


        
        
                $decyId = Crypt::decrypt($id);
                $encyIdCountry = Crypt::encrypt($decyId);
                $getDataBlogs = $this->CountryNetworkAgentModel->findOrFail($decyId);
                 $getSubContinent =  $this->SubContinentModel->all();
                $data = [
                    'title' => 'Form Add Agent Network Country',
                    'dataCountry' => $countries,
                    'row' => $getDataBlogs,
                    'idCountry' => $encyIdCountry,
                    'SubContinent' => $getSubContinent
                ];
                return view('administrator/agent-country/form/update', $data);
            }


    public function UpdateDataAgentCountryNetwork(Request $request) {

        
        // try {
        
        try {
            $idAgents = $request->input('id', null);
            $idDecy = Crypt::decrypt($idAgents);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Administrator.agent.network.country')
                ->with('error', 'Invalid Id Request!');
        }

        $agentCountry = $this->CountryNetworkAgentModel->findOrFail($idDecy);
           $newImage = $request->file('flag');
           $oldImage = $request->input('flag_old');
           // Jika ada gambar baru
           if ($newImage) {
               $imagePath =  $newImage->store('flag', 'public');
               $imageName = basename($imagePath);
               if ($oldImage && $oldImage !== 'default_flag.png') {
                $imagePath = storage_path('app/public/flag/' . $oldImage);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
               }
           } else {
               // Jika tidak ada gambar baru, gunakan gambar lama
               $imageName = $oldImage;
           }
                // Update data di database
                  $agentCountry->update([
                        'name'            => $request->input('country'),
                        'iso_code'          => $request->input('iso_code'),
                        'subcontinent_id'     => $request->input('subcontinent'),
                        'flag'            => $imageName
                    ]);
                   // Redirect dengan pesan sukses
                      return redirect()->route('Administrator.agent.network.country')->with('success','Success Update Data');
                // } catch (\Throwable $th) {
                //     return redirect()->route('Administrator.agent.network.country')->with('error','Failed to create data. Please try again.');
                // }
    }  
    
    

    public function DeleteDataAgentCountryNetwork($id) {
           try {
            $idUserDecrypted = Crypt::decrypt($id);
            $CountryData = CountryNetworkAgentModel::find($idUserDecrypted);
 
            $images = $CountryData->flag;
          
            if (!$CountryData) {
                return redirect()->route('Administrator.agent.network.country')
                    ->with('error', 'Data ID Not Found!');
            }


            if ($images && $images !== 'default_flag.png') {
                // Menentukan path file gambar di storage/app/avatar
                $imagePath = storage_path('app/public/flag/' . $images);
                // Memastikan gambar ada di folder tersebut dan menghapusnya
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            $CountryData->delete();
            
            return redirect()->route('Administrator.agent.network.country')->with('success', 'Success Delete Data');
        } catch (DecryptException $e) {
            return redirect()->route('Administrator.agent.network.country')
                ->with('error', 'Invalid ID!');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.country')
                ->with('error', 'Failed to delete data. Please try again.');
        }
    }



    // code untuk city agent network
    public function AgentNetworkCity()  {
          $data = [
              'title' => 'Agent Network City'
         ];
         return view('administrator/agent-city/data/file',$data);
    }


            public function getDataAgentCityNetwork(Request $request)
        {
            if ($request->ajax()) {
                $query = $this->CityNetworkAgentModel
                    ->select(
                        'cities_network_agent.*',
                        'countries_network_agent.name as name_country',
                        'countries_network_agent.flag as flag'
                    )
                    ->leftJoin('countries_network_agent', 'cities_network_agent.country_id', '=', 'countries_network_agent.id')
                    ->orderBy('cities_network_agent.name', 'asc');


                if ($request->has('search') && !empty($request->input('search')['value'])) {
                    $searchTerm = $request->input('search')['value'];


                    $query->where(function ($q) use ($searchTerm) {
                        $q->where('cities_network_agent.name', 'ILIKE', "%{$searchTerm}%")
                        ->orWhere('countries_network_agent.name', 'ILIKE', "%{$searchTerm}%");
                    });
                }

            return DataTables::of($query)
            ->filter(function ($instance) use ($request) {
                if ($request->has('search') && !empty($request->input('search')['value'])) {
                    $search = $request->input('search')['value'];

                    $instance->where(function ($q) use ($search) {
                        $q->where('cities_network_agent.name', 'ILIKE', "%{$search}%")
                        ->orWhere('countries_network_agent.name', 'ILIKE', "%{$search}%");
                    });
                }
            })
                    ->addIndexColumn()
                   ->addColumn('name_country', function($row) {
                        // Pastikan field 'flag' dan 'name_country' tersedia dari join
                        $imageUrl = route('flag.image.show', ['filename' => $row->flag ?? 'defaultFlag.png']);
                        $countryName = e($row->name_country ?? '-'); // e() untuk escape XSS

                        return '
                            <div class="d-flex align-items-center gap-2">
                                <img src="' . $imageUrl . '" 
                                    alt="' . $countryName . ' Flag"
                                    class="rounded" 
                                    style="width: 30px; height: 20px; object-fit: cover; border: 1px solid #ccc;">
                                <span>' . $countryName . '</span>
                            </div>
                        ';
                    })
                    ->addColumn('action', function ($row) {

                        $idCity = Crypt::encrypt($row->id);
                        $updateUrl = route('Administrator.agent.network.city.view.update', $idCity);
                        $deleteUrl = route('Administrator.delete.agent.network.city', ['id' => $idCity]);

                        $btn = '<a href="' . $updateUrl . '" class="btn btn-pill btn-outline-warning btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>';

                        $btn .= '<form action="' . $deleteUrl . '" method="POST" class="d-inline">
                                    '.csrf_field().'
                                    '.method_field('DELETE').'
                                    <button type="button" onclick="confirmDelete(this)" class="btn btn-pill btn-outline-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>';

                        return $btn;
                    })

                    ->rawColumns(['action','name_country'])
                    ->make(true);
            }

            abort(403, 'Unauthorized action.');
        }


        public function createDataAgentCityNetwork()  {
            $getDataCountry = $this->CountryNetworkAgentModel->all();
          
          $data = [
              'title' => 'Form Add Agent Network City',
              'country' => $getDataCountry
         ];
         return view('administrator/agent-city/form/create',$data);
    }


    public function storeDataAgentCityNetwork(StoreAgentCityNetworkRequest $request)  {
         try {
            if (CityNetworkAgentModel::isNameCityExists($request->input('name'))) {
                return redirect()->route('Administrator.agent.network.city')
                    ->with('error', 'City name already exists.');
            }
            $this->CityNetworkAgentModel->create([
                'country_id' => $request->input('country'),
                'name' => $request->input('name') ?: null,
                'lat' => $request->input('lat'),
                'lng' => $request->input('lng'),
            ]);
        return redirect()->route('Administrator.agent.network.city')->with('success','success save');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.city')->with('error','Failed to create data. Please try again.');
        }
    }


   public function showDataAgentCityNetwork($id)
    {
        $idDecy = Crypt::decrypt($id);
        $getDataCountry = $this->CountryNetworkAgentModel->all();
        $getData = $this->CityNetworkAgentModel->findOrFail($idDecy);
        $data = [
            'title' => 'Form Update Agent Network City',
            'country' => $getDataCountry,
            'row' => $getData,
            'id' => $id,
        ];
        return view('administrator.agent-city.form.update', $data);
    }


    public function UpdateDataAgentCityNetwork(Request $request, ) {
        try {
        try {
            $cityid = $request->input('id');
            $idCityDecrypted = Crypt::decrypt($cityid);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Administrator.agent.network.city')
                ->with('error', 'Invalid City Agent ID!');
        }
    
          $CityAgentNetworkData = $this->CityNetworkAgentModel->findOrFail($idCityDecrypted);
       
          if (CityNetworkAgentModel::isNameCityExistsUpdate($request->input('name'), $idCityDecrypted)) {
          return redirect()->route('Administrator.agent.network.city')
                ->with('error', 'City name already exists!');
        }

          $CityAgentNetworkData->update([
            'country_id' => $request->input('country'),
            'name' => $request->input('name') ?: null,
            'lat' => $request->input('lat'),
            'lng' => $request->input('lng')
        ]);
    
        return redirect()->route('Administrator.agent.network.city')->with('success','update success');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.agent.network.city')->with('error','Failed to update data. Please try again.');
    }
    }



    public function DeleteDataAgentCityNetwork($id) {
        try {
        $idCityDecrypted = Crypt::decrypt($id);
        $cityAgentData = CityNetworkAgentModel::find($idCityDecrypted);

        if (!$cityAgentData) {
            return redirect()->route('Administrator.agent.network.city')
                ->with('error', 'Data ID Not Found!');
        }
        $cityAgentData->delete();
        return redirect()->route('Administrator.agent.network.city')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Administrator.agent.network.city')
            ->with('error', 'Invalid menu ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.agent.network.city')
            ->with('error', 'Failed to delete data. Please try again.');
    }
    }



    // code Agent Network
    public function AgentNetwork() {
         $data = [
              'title' => 'Agent Network'
         ];
         return view('administrator/agent-network/data/file',$data);
    }

    public function getDataAgentNetwork(Request $request) {
          if ($request->ajax()) {
        $query = $this->NetworkAgentModel
            ->select(
                'agents_network.*',
                'agents_network.name as name_agent',
                'countries_network_agent.name as name_country',
                'countries_network_agent.flag as flag',
                'cities_network_agent.name as name_city',
            )
            ->leftJoin('countries_network_agent', 'agents_network.country_id', '=', 'countries_network_agent.id')
            ->leftJoin('cities_network_agent', 'agents_network.city_id', '=', 'cities_network_agent.id')
            ->orderBy('agents_network.id', 'desc')
            ->get();

            // Cek apakah ada parameter pencarian
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                $query->where('agents_network.name', 'LIKE', "%{$searchTerm}%");
            }

        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('name_country', function($row) {
                        $imageUrl = route('flag.image.show', ['filename' => $row->flag ?? 'defaultFlag.png']);
                        $countryName = e($row->name_country ?? '-'); // e() untuk escape XSS
                        return '
                            <div class="d-flex align-items-center gap-2">
                                <img src="' . $imageUrl . '" 
                                    alt="' . $countryName . ' Flag"
                                    class="rounded" 
                                    style="width: 30px; height: 20px; object-fit: cover; border: 1px solid #ccc;">
                                <span>' . $countryName . '</span>
                            </div>
                        ';
                    })

              ->addColumn('name_agent', function($row) {
                        $imageUrls = route('agent.image.show', ['filename' => $row->image ?? 'DefaultAgent.jpg']);
                        $AgentNames = e($row->name_agent ?? '-'); // e() untuk escape XSS
                        return '
                            <div class="d-flex align-items-center gap-2">
                                <img src="' . $imageUrls . '" 
                                    alt="' . $AgentNames . ' Agent"
                                    class="rounded" 
                                    style="width: 50px; height: 50px; object-fit: cover; border: 1px solid #ccc;">
                                <span>' . $AgentNames . '</span>
                            </div>
                        ';
                    })       

                    ->addColumn('status', function($row) {
                            if ($row->status == 'active') {
                                return '<span class="badge bg-success text-light">Active</span>';
                            } elseif ($row->status == 'inactive') {
                                return '<span class="badge bg-secondary text-light">Inactive</span>';
                            } else {
                                return '<span class="badge bg-warning text-light">Unknown</span>';
                            }
                        })
            

                        ->addColumn('details', function ($row) {
                            return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                                        data-menu=""
                                        
                                        >
                                        <i class="fa fa-sticky-note"> </i> Details
                                    </a>';
                        })

            ->addColumn('action', function ($row) {
                $getId= Crypt::encrypt($row->id);
                $urlEdit = route('Administrator.edit.agent.network', $getId);
                $urlDelete = route('Administrator.delete.agent.network', $getId);
                        $btn = '<a href="' . $urlEdit . '" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                        $btn .= '<form action="' . $urlDelete . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action','details','name_country','name_agent','status'])
            ->make(true);
    }
    }


    public function getCitiesByCountry($country_id)
{
    $cities = $this->CityNetworkAgentModel
                ->where('country_id', $country_id)
                ->orderBy('name', 'asc')
                ->get(['id', 'name']);

    return response()->json($cities);
}


    public function createDataAgentNetwork()  {
        $getDataCountry = $this->CountryNetworkAgentModel->all();
        $getDataCity = $this->CityNetworkAgentModel->all();

         $data = [
              'title' => 'Form Add Agent Network',
              'dataCountry' => $getDataCountry,
              'dataCity' => $getDataCity
         ];
         return view('administrator/agent-network/form/create',$data);
    }

    


    public function storeDataAgentNetwork(StoreNetworkAgentRequest $request)  {

            $country = $request->input('country');
    $countryData = $this->CountryNetworkAgentModel->find($country);

    // Pastikan ada country data
    if (!$countryData) {
        return redirect()->back()->with('error', 'Country not found!');
    }

    // Buat prefix 3 huruf dari nama negara (misal: Indonesia -> IND)
    $prefix = strtoupper(substr(Str::slug($countryData->name, ''), 0, 3));

    // Cari kode terakhir dengan prefix tsb (contoh: IND-001, IND-002)
    $lastCode = DB::table('agents_network')
        ->where('code', 'like', $prefix . '-%')
        ->orderByDesc('code')
        ->value('code');

    // Ambil angka terakhir (jika ada)
    if ($lastCode) {
        preg_match('/(\d+)$/', $lastCode, $matches);
        $nextNumber = isset($matches[1]) ? (int)$matches[1] + 1 : 1;
    } else {
        $nextNumber = 1;
    }

    // Format code baru
    $newCode = $prefix . '-' . str_pad($nextNumber, 3, '0', STR_PAD_LEFT);


    $Agents = new NetworkAgentModel();
    $Agents->name        = $request->input('name');
    // $Agents->code        = 'XXX';
    $Agents->code        = $newCode;
    $Agents->country_id  = $request->input('country');
    $Agents->city_id     = $request->input('city');
    $Agents->address     = $request->input('address');
    $Agents->lat         = $request->input('lat');
    $Agents->lng         = $request->input('lng');
    $Agents->phone       = $request->input('phone');
    $Agents->email       = $request->input('email');
    $Agents->status      = 'active';

    // Upload image (ubah dari "flag" jadi "image" agar sesuai dengan input form)
    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $imageName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
        $file->storeAs('agent', $imageName, 'public');
        $Agents->image = $imageName;
    } else {
        $Agents->image = 'default_agent.jpg';
    }
    $Agents->save();
    return redirect()->route('Administrator.agent.network')->with('success', 'Data agent berhasil disimpan.');
        }



public function editDataAgentNetwork($id)
{
   
    $decrypted = Crypt::decrypt($id);
    // Ambil data agent berdasarkan id
    $agent = $this->NetworkAgentModel->findOrFail($decrypted);

    // Ambil semua country & city untuk dropdown
    $getDataCountry = $this->CountryNetworkAgentModel->all();
    $getDataCity = $this->CityNetworkAgentModel
        ->where('country_id', $agent->country_id)
        ->orderBy('name', 'asc')
        ->get();

    $data = [
        'title' => 'Edit Agent Network',
        'agent' => $agent,
        'dataCountry' => $getDataCountry,
        'dataCity' => $getDataCity,
        'idData' => $id
    ];

    return view('administrator/agent-network/form/update', $data);
}



public function updateDataAgentNetwork(StoreNetworkAgentRequest $request, $id)
{
    try {
        // Dekripsi ID dari route parameter, bukan dari input form
        $idDecy = Crypt::decrypt($id);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return redirect()
            ->route('Administrator.agent.network')
            ->with('error', 'Invalid ID Request!');
    }

    try {
        // Ambil data agent berdasarkan ID
        $agent = $this->NetworkAgentModel->findOrFail($idDecy);

        // Kelola gambar
        $newImage = $request->file('image');
        $oldImage = $request->input('image_old');
        $imageName = $oldImage; // default pakai gambar lama

        if ($newImage) {
            // Simpan file baru
            $imagePath = $newImage->store('agent', 'public');
            $imageName = basename($imagePath);

            // Hapus file lama jika bukan default
            if ($oldImage && $oldImage !== 'default_agent.jpg') {
                Storage::disk('public')->delete('agent/' . $oldImage);
            }
        }

        // Update data
        $agent->update([
            'name'        => $request->input('name'),
            'country_id'  => $request->input('country'),
            'city_id'     => $request->input('city'),
            'address'     => $request->input('address'),
            'lat'         => $request->input('lat'),
            'lng'         => $request->input('lng'),
            'email'       => $request->input('email'),
            'phone'       => $request->input('phone'),
            'status'      => $request->input('status'),
            'image'       => $imageName,
        ]);

        return redirect()
            ->route('Administrator.agent.network')
            ->with('success', 'Success Update Data');
    } catch (\Throwable $th) {
        // Bisa juga di-log errornya
        return redirect()
            ->route('Administrator.agent.network')
            ->with('error', 'Failed to update data. Please try again.');
    }
}


public function deleteDataAgentNetwork($id)
{
    try {
        // Dekripsi ID dari route parameter
        $idDecy = Crypt::decrypt($id);
    } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
        return redirect()
            ->route('Administrator.agent.network')
            ->with('error', 'Invalid ID Request!');
    }

    try {
        // Cari agent
        $agent = $this->NetworkAgentModel->findOrFail($idDecy);

        // Hapus gambar lama jika bukan default
        if ($agent->image && $agent->image !== 'default_agent.jpg') {
            Storage::disk('public')->delete('agent/' . $agent->image);
        }

        // Hapus data agent
        $agent->delete();

        return redirect()
            ->route('Administrator.agent.network')
            ->with('success', 'Data Agent berhasil dihapus.');
    } catch (\Throwable $th) {
        // Bisa log error untuk debug
        return redirect()
            ->route('Administrator.agent.network')
            ->with('error', 'Gagal menghapus data agent. Silakan coba lagi.');
    }
}




// code master Agent Continent
    public function AgentNetworkContinent()  {
         $data = [
              'title' => 'Agent Network Continent'
         ];
         return view('administrator/agent-continent/data/file',$data);
    }


    public function getDataAgentContinentNetwork(Request $request) 
    {
        if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->ContinentAgentModel->orderBy('name', 'asc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }
        
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $idContinent= Crypt::encrypt($row->id);
                $updateContinent =  route('Administrator.agent.network.continent.view.update',$idContinent);
                $deleteContinent = route('Administrator.delete.agent.network.continent', ['id' => $idContinent]);
                        $btn = '<a href="' . $updateContinent . '" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';

                        $btn .= '<form action="' . $deleteContinent . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    }




    public function createDataAgenContinentNetwork()
    {
          $data = [
              'title' => 'Form Agent Network Continent'
         ];
         return view('administrator/agent-continent/form/create',$data);
    }



    public function storeDataAgentAgenContinentNetwork(StoreContinentRequest $request)  {
         try {
            if (ContinentAgentModel::isNameAgentContinentExists($request->input('name'))) {
                return redirect()->route('Administrator.agent.network.continent')
                    ->with('error', 'Continent name already exists.');
            }
            $this->ContinentAgentModel->create([
                'name' => $request->input('name') ?: null,
                'code' => $request->input('code') ?: null,
            ]);
        return redirect()->route('Administrator.agent.network.continent')->with('success','success save');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.continent')->with('error','Failed to create data. Please try again.');
        }
    }



    public function showDataAgentContinentNetwork($id)
    {
        $requestId = Crypt::decrypt($id);
        $getData = $this->ContinentAgentModel->findOrFail($requestId);

        $data = [
              'title' => 'Form  Update Agent Network Continent',
              'id' => $id,
              'row' => $getData
         ];
         return view('administrator/agent-continent/form/update',$data);
    }


    public function updateDataAgentNetworkContinent(Request $request, $id)  {
        try {
            try {
                $idDecy = Crypt::decrypt($id);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return redirect()->route('Administrator.agent.network.continent')
                    ->with('error', 'Invalid ID!');
            }
            $ContinentData = $this->ContinentAgentModel->findOrFail($idDecy);
            //   cek name already exist
            if (ContinentAgentModel::isNameAgentContinentExistsUpdate($request->input('name'), $idDecy)) {
                return redirect()->route('Administrator.agent.network.continent')
                    ->with('error', 'Name Continent already exists!');
            }
            $ContinentData->update([
                'name' => $request->input('name'),
                'code' => $request->input('code')
            ]);
            return redirect()->route('Administrator.agent.network.continent')->with('success','update success');

        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.continent')->with('error','Failed to create data. Please try again.');
        }
    }

    public function DeleteDataAgentContinentNetwork($id) {
         try {
        $idContDecrypted = Crypt::decrypt($id);
        $ContAgentData = ContinentAgentModel::find($idContDecrypted);

        if (!$ContAgentData) {
            return redirect()->route('Administrator.agent.network.continent')
                ->with('error', 'Data ID Not Found!');
        }
        $ContAgentData->delete();
        return redirect()->route('Administrator.agent.network.continent')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Administrator.agent.network.continent')
            ->with('error', 'Invalid ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.agent.network.continent')
            ->with('error', 'Failed to delete data. Please try again.');
    }
    }



    public function AgentNetworkSubContinent()  {
          $data = [
              'title' => 'Agent Network Sub-Continent'
         ];
         return view('administrator/agent-sub-continent/data/file',$data);
    }


    public function getDataAgentSubContinentNetwork(Request $request)  {
        if ($request->ajax()) {
        // Mulai query tanpa get() dulu
            $query = $this->SubContinentModel
            ->leftJoin('continents_network_agent', 'subcontinents_network_agent.continent_id', '=', 'continents_network_agent.id')
            ->select(
                'subcontinents_network_agent.*',
                'continents_network_agent.name as continent_name'
            )
            ->orderBy('subcontinents_network_agent.name', 'asc');

            // Search filter
            if ($request->has('search') && !empty($request->input('search')['value'])) {
                $searchTerm = $request->input('search')['value'];
                $query->where('subcontinents_network_agent.name', 'LIKE', "%{$searchTerm}%");
            }
        
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

            ->addColumn('action', function ($row) {
                $idSubContinent= Crypt::encrypt($row->id);
                $updateSubContinent =  route('Administrator.agent.network.subcontinent.view.update',$idSubContinent);
                $deleteSubContinent = route('Administrator.delete.agent.network.subcontinent', ['id' => $idSubContinent]);
                        $btn = '<a href="' . $updateSubContinent . '" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';

                        $btn .= '<form action="' . $deleteSubContinent . '" method="POST" class="d-inline">
                        '.csrf_field().'
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" 
                            onclick="confirmDelete(this)"
                            class="btn btn-pill btn-outline-danger btn-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}


public function createDataAgenSubContinentNetwork()  {
      $getContinent = $this->ContinentAgentModel->all();
      $data = [
              'title' => 'Agent Network Sub-Continent',
              'continent' => $getContinent
         ];
         return view('administrator/agent-sub-continent/form/create',$data);
}


public function storeDataAgentAgenSubContinentNetwork(StoreSubContinentRequest $request)  {
    try {
            if (SubContinentModel::isNameAgentSubContinentExists($request->input('name'))) {
                return redirect()->route('Administrator.agent.network.subcontinent')
                    ->with('error', 'SubContinent name already exists.');
            }

            $this->SubContinentModel->create([
                'name' => $request->input('name') ?: null,
                'code' => $request->input('code') ?: null,
                'continent_id' => $request->input('continent') ?: null,
            ]);
        return redirect()->route('Administrator.agent.network.subcontinent')->with('success','success save');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.subcontinent')->with('error','Failed to create data. Please try again.');
        }
}



public function showDataAgentSubContinentNetwork($id)  {
      $idDecrypt = Crypt::decrypt($id);
      $getContinent = $this->ContinentAgentModel->all();
      $getDataSubContinent = $this->SubContinentModel->findOrFail($idDecrypt);
      $data = [
              'title' => 'Form Agent Network Sub-Continent',
              'continent' => $getContinent,
              'row' => $getDataSubContinent,
              'id' => $id
         ];
         return view('administrator/agent-sub-continent/form/update',$data);
}

public function updateDataAgentNetworkSubContinent(Request $request, $id) {
   
    try {
            try {
                $idDecy = Crypt::decrypt($id);
            } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
                return redirect()->route('Administrator.agent.network.subcontinent')
                    ->with('error', 'Invalid ID!');
            }
            $SubContinentData = $this->SubContinentModel->findOrFail($idDecy);
            //   cek name already exist
            if (SubContinentModel::isNameAgentContinentExistsUpdate($request->input('name'), $idDecy)) {
                return redirect()->route('Administrator.agent.network.subcontinent')
                    ->with('error', 'Name Continent already exists!');
            }
            $SubContinentData->update([
                'name' => $request->input('name') ?: null,
                'code' => $request->input('code') ?: null,
                'continent_id' => $request->input('continent') ?: null,
            ]);
            return redirect()->route('Administrator.agent.network.subcontinent')->with('success','update success');
        } catch (\Throwable $th) {
            return redirect()->route('Administrator.agent.network.subcontinent')->with('error','Failed to create data. Please try again.');
        }
}



public function DeleteDataAgentSubContinentNetwork($id) {
      try {
        $idSubConDecrypted = Crypt::decrypt($id);
        $subContAgentData = SubContinentModel::find($idSubConDecrypted);

        if (!$subContAgentData) {
            return redirect()->route('Administrator.agent.network.subcontinent')
                ->with('error', 'Data ID Not Found!');
        }
        $subContAgentData->delete();
        return redirect()->route('Administrator.agent.network.subcontinent')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Administrator.agent.network.subcontinent')
            ->with('error', 'Invalid ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Administrator.agent.network.subcontinent')
            ->with('error', 'Failed to delete data. Please try again.');
    }
}

}

