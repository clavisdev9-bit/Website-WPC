<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
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
        public function __construct(usersModel $usersModel, MenuModel $MenuModel, SubmenuModel $SubmenuModel, RoleModel $RoleModel, AccessMenuModel $AccessMenuModel, DivisionModel $DivisionModel, GroupModel $GroupModel, AccesssubMenuModel $AccesssubMenuModel) {
            $this->usersModel = $usersModel;
            $this->MenuModel = $MenuModel;
            $this->SubmenuModel = $SubmenuModel;
            $this->RoleModel = $RoleModel;
            $this->GroupModel = $GroupModel;
            $this->DivisionModel = $DivisionModel;
            $this->AccessMenuModel = $AccessMenuModel;
            $this->AccesssubMenuModel = $AccesssubMenuModel;
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

}
