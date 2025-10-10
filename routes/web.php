<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Error\Error;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Administrator\Administrator;
use App\Http\Controllers\Auth\Auth;
use App\Http\Controllers\Frontend\Users;
use App\Http\Controllers\AdminWebsite\Admins;
use App\Http\Controllers\AdminQuotation\Admin_Quotation_system;
use App\Http\Controllers\Setting\Setting_General;
use App\Http\Controllers\Costumers\Costumers;




// untuk handle semua route app vue dan blade logic (memisahkan route logic laravel-vue)
Route::get('/wpc-esys/{any?}', function () {
    return view('app'); // Vue SPA
})->where('any', '.*');


// ini semua route handle App untuk laravel not vue
// Handle error 
Route::fallback(function () {
    return response()->view('errors.404', ['title'=>'404'], 404);
});


//route untuk error hak akses menu dan submenu
Route::get('Error/CheckAccessMenu',[Error::class,'ErrorCheckAccessMenu'])->name('error.check.access.menu');
Route::get('Error/CheckAccessSubMenu',[Error::class,'ErrorCheckAccessSubMenu'])->name('error.check.access.sub.menu');



// web Front Route
Route::get('/',[Users::class,'index'])->name('users.home');
Route::get('/About',[Users::class,'about'])->name('users.about');
Route::get('/Contact',[Users::class,'contact'])->name('users.contact');
Route::get('/Tracking',[Users::class,'tracking'])->name('users.tracking');

// start ini tidak di pakai
Route::get('/Wpc-Esys-home',[Users::class,'new_home_qoutation'])->name('users.qoute.home');
Route::get('/Wpc-Esys-Qoutation',[Users::class,'new_qoutation'])->name('users.qoute.new');
Route::get('/Qoute',[Users::class,'qoute'])->name('users.qoute');
// end ini tidak di pakai

// Api get Country, state From Oddo (bisa di pakai untuk controller lainya)
Route::get('/api/countries', [Users::class, 'countries'])->name('api.countries');
Route::get('/api/states/{countryId}', [Users::class, 'states'])->name('api.states');

// Route::get('/state', [Users::class, 'getState'])->name('users.get.state.origins');
// Api get metode pickup, delivery, post From Oddo 
Route::get('/pickup', [Users::class, 'pickupOrigins'])->name('users.qoute.pickup.origins');
Route::get('/delivery', [Users::class, 'deliveryDestination'])->name('users.qoute.delivery.destination');
Route::post('/qoutation/send-data', [Users::class, 'store_qoutation'])->name('users.qoutation.store');

// route get untuk news frontend
Route::get('/News',[Users::class,'news'])->name('users.news');
Route::get('/News-show/{slug}',[Users::class,'news_detail'])->name('users.news.show');

Route::get('/Network',[Users::class,'network'])->name('users.network');

Route::get('/Logistic',[Users::class,'logistic'])->name('users.logistic');
Route::get('/Logistic/Regulation-Services',[Users::class,'regulation_services'])->name('users.regulation.services');
Route::get('/Logistic/Value-Added-Services',[Users::class,'value_added_services'])->name('users.value.added.services');
Route::get('/Logistic/Buying-Consolidation',[Users::class,'buying_consolidation'])->name('users.buying.consolidation');
Route::get('/Logistic/Warehouse-and-Design',[Users::class,'warehouse_and_design'])->name('users.warehouse.and.design');
Route::get('/Logistic/Inventory',[Users::class,'inventory'])->name('users.inventory');
Route::get('/Logistic/Rate-Classification',[Users::class,'rate_classification'])->name('users.rate.classification');
Route::get('/Logistic/Vendor-Management',[Users::class,'vendor_management'])->name('users.vendor.management');
Route::get('/Logistic/Freight-Management',[Users::class,'freight_management'])->name('users.freight.management');


Route::get('/Transportation',[Users::class,'transportation'])->name('users.transportation');
Route::get('/Transportation/Tracking-System',[Users::class,'tracking_system'])->name('users.tracking.system');
Route::get('/Transportation/Consolidation-Service',[Users::class,'consolidation_service'])->name('users.consolidation.service');
Route::get('/Transportation/Freight-Forwarder',[Users::class,'freight_forwarder'])->name('users.freight.forwarder');
Route::get('/Transportation/Rail-Service',[Users::class,'rail_service'])->name('users.rail.service');
Route::get('/Transportation/Inter-Model',[Users::class,'inter_model'])->name('users.inter.model');


Route::get('/Warehouse',[Users::class,'warehouse'])->name('users.warehouse');
Route::get('/Warehouse/dedicated-warehouse',[Users::class,'dedicated_warehouse'])->name('users.dedicated.warehouse');
Route::get('/Warehouse/public-warehouse',[Users::class,'public_warehouse'])->name('users.public.warehouse');
Route::get('/Warehouse/warehouse-management-system',[Users::class,'warehouse_management_system'])->name('users.warehouse.management.system');

// Contact Form route(public)
// Route::post('Contact/contact-form-store', [Users::class, 'Contact_messages_store'])->name('users.contact.form.store');
Route::post('Contact/contact-form-store', [Users::class, 'Contact_messages_store'])
    ->name('users.contact.form.store')
    ->middleware('throttle:contact_form'); // Maksimal 5 request per 1 menit per IP



// Auth Route
Route::get('Auth/Login',[Auth::class,'login_page'])->name('Auth.login');
Route::get('Auth/Logout',[Auth::class,'Logout'])->name('Auth.logout');
Route::get('Auth/Registeration',[Auth::class,'register_page'])->name('Auth.register');
Route::post('Auth/Login-Checks',[Auth::class,'login_checks_auth'])->name('Auth.checks.authentication');



// Route  Administrator
Route::prefix('Administrator')->name('Administrator.')
->middleware('check.access.menu')
->middleware('check.access.submenu')
->group(function () {
Route::get('Dashboard',[Administrator::class,'index'])->name('dashboard');
});


Route::prefix('Administrator')->name('Administrator.')
->middleware('check.access.menu')
->middleware('check.access.submenu')
->group(function () {
Route::get('Menu', [Administrator::class, 'Menu_Management'])->name('menu');
Route::get('Get-menu-management', [Administrator::class, 'getMenu'])->name('get.menu.management');
Route::get('create-menu-management', [Administrator::class, 'createMenu'])->name('create.menu.management');
Route::post('store-menu-management', [Administrator::class, 'storeMenu'])->name('store.menu.management');
Route::get('view-menu-update/{id}', [Administrator::class, 'showMenu'])->name('menu.view.update');
Route::put('store-update-menu-management', [Administrator::class, 'UpdateMenu'])->name('update.menu.management');
Route::delete('menu-delete-management/{id}', [Administrator::class, 'DeleteMenu'])->name('delete.menu.management');
});



Route::get('Administrator/Sub-Menu-management', [Administrator::class, 'submenuManagement'])->name('Administrator.sub.menu.management');
Route::get('Administrator/Get-submenu-management', [Administrator::class, 'getSubMenu'])->name('Administrator.get.submenu.management');
Route::get('Administrator/create-submenu-management', [Administrator::class, 'createSubmenu'])->name('Administrator.create.submenu.management');
Route::post('Administrator/Store-submenu-management', [Administrator::class, 'storeSubMenu'])->name('Administrator.store.submenu.management');
Route::get('Administrator/view-submenu-update/{id}', [Administrator::class, 'showSubmenu'])->name('Administrator.submenu.view.update');
Route::put('Administrator/store-update-submenu-management', [Administrator::class, 'UpdateSubMenu'])->name('Administrator.update.submenu.management');
Route::delete('Administrator/submenu-delete-management/{id}', [Administrator::class, 'DeleteSubMenu'])->name('Administrator.delete.submenu.management');


Route::get('Administrator/Roles-management', [Administrator::class, 'RoleManagement'])->name('Administrator.role.management');
Route::get('Administrator/Get-role-management', [Administrator::class, 'getRole'])->name('Administrator.get.role.management');
Route::get('Administrator/create-role-management', [Administrator::class, 'createRole'])->name('Administrator.create.role.management');
Route::post('Administrator/Store-role-management', [Administrator::class, 'storeRole'])->name('Administrator.store.role.management');
Route::get('Administrator/view-role-update/{id}', [Administrator::class, 'showRole'])->name('Administrator.role.view.update');
Route::put('Administrator/store-update-role-management', [Administrator::class, 'UpdateRole'])->name('Administrator.update.role.management');
Route::delete('Administrator/role-delete-management/{id}', [Administrator::class, 'DeleteRole'])->name('Administrator.delete.role.management');
Route::get('Administrator/role-access-menu/{id}', [Administrator::class, 'AccessRoleMenu'])->name('Administrator.role.access.menu');
Route::post('Administrator/change-access-menu', [Administrator::class, 'ChangeAccessMenu'])->name('Administrator.change.access.menu');

Route::get('/avatar/{filename}', function ($filename) {
    $path = storage_path('app/public/profile/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);

    return response($file, 200)->header("Content-Type", $type);
})->name('avatar.show');

Route::get('Administrator/Users-management', [Administrator::class, 'UserManagement'])->name('Administrator.user.management');
Route::get('Administrator/Get-user-management', [Administrator::class, 'getUser'])->name('Administrator.get.user.management');
Route::get('Administratorcreate-user-management', [Administrator::class, 'createUser'])->name('Administrator.create.user.management');
Route::post('Administrator/Store-user-management', [Administrator::class, 'storeUser'])->name('Administrator.store.user.management');
Route::get('Administrator/view-user-update/{id}', [Administrator::class, 'showUser'])->name('Administrator.user.view.update');
Route::put('Administrator/update-user-management', [Administrator::class, 'UpdateUser'])->name('Administrator.update.user.management');
Route::delete('Administrator/user-delete-management/{id}', [Administrator::class, 'DeleteUser'])->name('Administrator.delete.user.management');
Route::get('Administrator/access-user-submenu/{id}', [Administrator::class, 'AccessUser'])->name('Administrator.user.access.submenu');
Route::post('Administrator/change-access-submenu', [Administrator::class, 'ChangeAccessSubMenu'])->name('Administrator.change.access.submenu');



// Admin Cms Website Route (blogs)
Route::get('Admins/Homes',[Admins::class,'Homes_Admins'])->name('Admins.homes');
Route::get('/blogs/{filename}', function ($filename) {
    $path = storage_path('app/public/blogs/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    return response($file, 200)->header("Content-Type", $type);
})->name('blogs.image.show');



// Admin-Web route
// route blog admin
Route::get('Admins/List-blogs-company',[Admins::class,'News_Company'])->name('Admins.landing.page');
Route::get('Admins/Get-blogs', [Admins::class, 'Get_Blogs'])->name('get.blogs');
Route::get('Admins/add-content-blogs', [Admins::class, 'Form_add_Blogs'])->name('form.add.blogs');
Route::post('Admins/store-content-blogs', [Admins::class, 'Store_add_Blogs'])->name('store.blogs');
Route::delete('Admins/delete-content-blogs/{id}', [Admins::class, 'destroyContent'])->name('Admins.delete.blogs');
Route::get('Admins/Get-blogs-update/{id}', [Admins::class, 'Get_Blogs_Update_view'])->name('get.blogs.update');
Route::put('Admins/store-update-blogs', [Admins::class, 'UpdateBlog'])->name('Admins.update.blogs');

// route category blog
Route::get('Admins/Master-Category-Blogs',[Admins::class,'Category_Blog'])->name('Admins.List.category.blog');
Route::get('Admins/Get-category-blog', [Admins::class, 'Get_Category_Blog'])->name('get.category.blogs');
Route::get('Admins/add-category-blogs', [Admins::class, 'Form_Add_Category_Blogs'])->name('form.add.category.blogs');
Route::post('Admins/store-category-blogs', [Admins::class, 'store_category_blogs'])->name('store.category.blogs');
Route::get('Admins/Get-blogs-category-update/{id}', [Admins::class, 'Get_blogs_category_update_view'])->name('get.blogs.category.update');
Route::put('Admins/store-update-category-blogs', [Admins::class, 'update_category_blogs'])->name('Admins.update.category.blogs');
Route::delete('Admins/delete-category-blogs/{id}', [Admins::class, 'destroy_category_blogs'])->name('Admins.delete.category.blogs');


// route contact request
Route::get('Admins/List-contact-request',[Admins::class,'getDataContactRequest'])->name('Admins.List.contact.request');
Route::get('Admins/Get-List-contact-request', [Admins::class, 'get_data_request_file'])->name('get.data.request');
Route::delete('Admins/Contact-form-delete/{id}', [Admins::class, 'Contact_messages_delete'])->name('Admins.users.contact.form.delete');


// Admin Quotation system (qoutation)
Route::get('Admin_Quotation_system/Home', [Admin_Quotation_system::class, 'Home'])->name('Request.Quotation.Dashboard');
Route::get('Admin_Quotation_system/List-Request-Quotation',[Admin_Quotation_system::class,'List_Request_Quotation'])->name('List.Request.Quotation.quotation');
Route::get('Admin_Quotation_system/Get-quotation', [Admin_Quotation_system::class, 'Get_Quotations'])->name('get.quotation');
// Api get Country, state From Oddo (bisa di pakai untuk controller lainya)
Route::get('/external/api/countries', [Admin_Quotation_system::class, 'countries'])->name('api.countries');
Route::get('/external/api/states/{countryId}', [Admin_Quotation_system::class, 'states'])->name('api.states');

// Admin Quotation system (Contact)
Route::get('Admin_Quotation_system/System-contact-sync',[Admin_Quotation_system::class,'List_System_contact_sync'])->name('Admin.quotation.system.contact.sync');
Route::get('Admin_Quotation_system/Get-contact-sync', [Admin_Quotation_system::class, 'Get_data_contact_fix_sync'])->name('Admin.quotation.get.system.contact.sync');


// Costumers Route
Route::get('Costumers/Home',[Costumers::class,'Homes_Costumers'])->name('Costumers.homes');
Route::get('Costumers/Costumer-Document',[Costumers::class,'Costumers_Document'])->name('Costumers.document');


// Setting General
Route::get('Setting_General/Logout', [Setting_General::class, 'Logout'])->name('Setting_General.logout');
Route::get('Setting_General/Change-password', [Setting_General::class, 'ChangePassword'])->name('Setting_General.change.password');
Route::post('Setting_General/Change-password-user', [Setting_General::class, 'ChangePasswordUser'])->name('Setting_General.change.password.user');
Route::get('Setting_General/Change-profile', [Setting_General::class, 'ChangeProfile'])->name('Setting_General.change.profile');
Route::put('Setting_General/Change-profile-user', [Setting_General::class, 'ChangeProfileUser'])->name('Setting_General.change.profile.user');

