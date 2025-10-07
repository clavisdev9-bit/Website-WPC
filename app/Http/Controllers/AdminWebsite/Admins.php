<?php

namespace App\Http\Controllers\AdminWebsite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Blogs;
use App\Models\CategoryModelsBlogs;
use App\Http\Requests\validationContentAdd;
use App\Models\ContactMessage;

class Admins extends Controller
{
    protected $Blogs;
    protected $CategoryModelsBlogs;
    protected $ContactMessage;
  public function __construct(Blogs $Blogs, CategoryModelsBlogs $CategoryModelsBlogs, ContactMessage $ContactMessage) {
    $this->Blogs = $Blogs;
    $this->CategoryModelsBlogs = $CategoryModelsBlogs;
    $this->ContactMessage = $ContactMessage;
  }

    public function Homes_Admins() {
        $data  = [
            'title' => 'Home Admin Website '
      ];
       return view('admin-website/homes/file', $data);
    }


   public function News_Company()  {
    
           $data = [
             'title' => 'List News Company'
        ];
        return view('admin-website/news/file', $data);
    }


    public function Get_Blogs(Request $request)  {
         if ($request->ajax()) {
   
        $query = $this->Blogs
    ->select(
        'blogs.*',
        'blog_categories.name as name_category',
        'ms_users.fullname as name_author',
    )
    ->leftJoin('blog_categories', 'blogs.category_id', '=', 'blog_categories.id')
    ->leftJoin('ms_users', 'blogs.author_id', '=', 'ms_users.id_user')
    ->orderBy('blogs.created_at', 'desc')
    ->get();

// Cek apakah ada parameter pencarian
if ($request->has('search') && !empty($request->input('search')['value'])) {
    $searchTerm = $request->input('search')['value'];
    $query->where('blogs.title', 'LIKE', "%{$searchTerm}%");
}

        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()

              
             ->addColumn('image_blogs', function($row) {
                // Menggunakan route dengan parameter filename
                $imageUrl = route('blogs.image.show', ['filename' => $row->image]);
                return '<img src="' . htmlspecialchars($imageUrl, ENT_QUOTES, 'UTF-8') . '" width="50" height="50" class="img-thumbnail">';
            })

            ->addColumn('details', function ($row) {
                return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                               data-title="' . htmlspecialchars($row->title, ENT_QUOTES, 'UTF-8') . '"
                               data-slug="' . htmlspecialchars($row->slug, ENT_QUOTES, 'UTF-8') . '"
                               data-excerpt="' . htmlspecialchars($row->excerpt, ENT_QUOTES, 'UTF-8') . '"
                               data-name_category="' . htmlspecialchars($row->name_category, ENT_QUOTES, 'UTF-8') . '"
                               data-name_author="' . htmlspecialchars($row->name_author, ENT_QUOTES, 'UTF-8') . '"
                               data-content="' . htmlspecialchars($row->content, ENT_QUOTES, 'UTF-8') . '"
                               data-meta_title="' . htmlspecialchars($row->meta_title, ENT_QUOTES, 'UTF-8') . '"
                               data-meta_description="' . htmlspecialchars($row->meta_description, ENT_QUOTES, 'UTF-8') . '"
                               data-is_published="' . htmlspecialchars($row->is_published ? 'Publish' : 'Not Publish', ENT_QUOTES, 'UTF-8') . '"
                               data-created_at="' . htmlspecialchars(date('d M Y H:i', strtotime($row->created_at)), ENT_QUOTES, 'UTF-8') . '">

                               <i class="fa fa-sticky-note"> </i> Details
                        </a>';
            })

            ->addColumn('action', function ($row) {
                $getIdBlogs = Crypt::encrypt($row->id);
                $urlEditBlog = route('get.blogs.update', $getIdBlogs);
                $urlDeleteBlog = route('Admins.delete.blogs', $getIdBlogs);
                        $btn = '<a href="' . $urlEditBlog . '" class="btn btn-pill btn-outline-warning btn-sm"><i class="fa fa-edit"></i></a>';
                        $btn .= '<form action="' . $urlDeleteBlog . '" method="POST" class="d-inline">
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
            ->rawColumns(['action','details','image_blogs','title'])
            ->make(true);
    }
    }


    public function Form_add_Blogs()  {
        $getCate = $this->CategoryModelsBlogs->all();
         $data = [
             'title' => 'Form Add News-Blog Company',
             'Category' => $getCate
        ];
        return view('admin-website/news/form/create', $data);
    }



    public function Store_add_Blogs(validationContentAdd $request)
{
    $user = getUserData();

    try {
         if (Blogs::isTitleExists($request->input('title'))) {
            return redirect()->route('Admins.landing.page')
                ->with('error', 'Title already exists.');
        }

        $blog = new Blogs();
        $blog->title            = $request->input('title');
        $blog->slug             = Str::slug($request->input('title'));
        $blog->meta_title       = $request->input('meta_title');
        $blog->meta_description = $request->input('meta_description');
        $blog->excerpt          = $request->input('excerpt');
        $blog->content          = $request->input('content');
        $blog->category_id      = $request->input('category_id');
        $blog->is_published     = $request->input('is_published');
        $blog->author_id        = $user->id_user;

        // Upload file kalau ada
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $imageName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            // Simpan ke storage/app/public/blogs
            $file->storeAs('blogs', $imageName, 'public');
            // Simpan nama file ke DB
            $blog->image = $imageName;
        } else {
            // Kalau tidak ada file → pakai default
            $blog->image = 'default.jpg';
        }
        $blog->save();
        return redirect()->route('Admins.landing.page')->with('success', 'Success Create Data Content News');
    } catch (\Throwable $th) {
        return redirect()->route('Admins.landing.page')->with('error', 'Failed to Create data. Please try again.');
    }
}



public function destroyContent($id) 
{
     try {
            $idUserDecrypted = Crypt::decrypt($id);
            $userData = Blogs::find($idUserDecrypted);
 
            $images = $userData->image;
          
            if (!$userData) {
                return redirect()->route('Admins.landing.page')
                    ->with('error', 'Data ID Not Found!');
            }


            if ($images && $images !== 'default.jpg') {
                // Menentukan path file gambar di storage/app/avatar
                $imagePath = storage_path('app/public/blogs/' . $images);
                // Memastikan gambar ada di folder tersebut dan menghapusnya
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
    
            $userData->delete();
            
            return redirect()->route('Admins.landing.page')->with('success', 'Success Delete Data Content News');
        } catch (DecryptException $e) {
            return redirect()->route('Admins.landing.page')
                ->with('error', 'Invalid ID!');
        } catch (\Throwable $th) {
            return redirect()->route('Admins.landing.page')
                ->with('error', 'Failed to delete data. Please try again.');
        }
}


public function Get_Blogs_Update_view($id)  {
    $getCate = $this->CategoryModelsBlogs->all();
     $decyId = Crypt::decrypt($id);
     $encyIdBlogs = Crypt::encrypt($decyId);
     $getDataBlogs = $this->Blogs->findOrFail($decyId);
         $data = [
             'title' => 'Form Update News-Blog Company',
             'Category' => $getCate,
             'row' => $getDataBlogs,
             'idBlogs' => $encyIdBlogs
        ];
        return view('admin-website/news/form/update', $data);
}



public function UpdateBlog(validationContentAdd $request) {
    $user = getUserData();
    try {
        
        try {
            $idBlogs = $request->input('id', null);
            $idDecy = Crypt::decrypt($idBlogs);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('Admins.landing.page')
                ->with('error', 'Invalid User ID!');
        }

        $blog = $this->Blogs->findOrFail($idDecy);

        if (Blogs::isTitleExistsup($request->input('title'), $idDecy)) {
            return redirect()->route('Admins.landing.page')
                ->with('error', 'Title already exists!');
        }
        
           // ambil data gambar baru dan lama
           $newImage = $request->file('image');
           $oldImage = $request->input('imageold');
           // Jika ada gambar baru
           if ($newImage) {
               // Simpan gambar baru di folder 'images' dalam storage 'public'
               // $imagePath = $newImage->store('assets/backend/dist/img/avatar/', 'public');
               $imagePath =  $newImage->store('blogs', 'public');
               $imageName = basename($imagePath);
   
               // Hapus gambar lama jika ada dan bukan gambar default
               if ($oldImage && $oldImage !== 'default.jpg') {
                  //  $oldImagePath = storage_path('app/avatar/' . $oldImage);
                   $oldImagePath = storage_path('app/public/blogs/' . $oldImage);
                   if (file_exists($oldImagePath)) {
                       unlink($oldImagePath);
                   }
               }
           } else {
               // Jika tidak ada gambar baru, gunakan gambar lama
               $imageName = $oldImage;
           }
                // Update data di database
                  $blog->update([
                        'title'            => $request->input('title'),
                        'slug'             => Str::slug($request->input('title')),
                        'meta_title'       => $request->input('meta_title'),
                        'meta_description' => $request->input('meta_description'),
                        'excerpt'          => $request->input('excerpt'),
                        'content'          => $request->input('content'),
                        'category_id'      => $request->input('category_id'),
                        'is_published'     => $request->input('is_published'),
                        'author_id'        => $user->id_user,
                        'image'            => $imageName
                    ]);
                   // Redirect dengan pesan sukses
                      return redirect()->route('Admins.landing.page')->with('success','Success Update Data Content News');
                } catch (\Throwable $th) {
                    return redirect()->route('Admins.landing.pageAdministrator.user.management')->with('error','Failed to create data. Please try again.');
                }
      }



    //   untuk contact request
    public function getDataContactRequest(Request $request) {
          $data = [
                'title' => 'List Request Contact'
          ];
          return view('admin-website/user-request-form/data/file', $data);
    }




    public function get_data_request_file(Request $request) 
    {
           if ($request->ajax()) {
        // Mulai query tanpa get() dulu
        $query = $this->ContactMessage->orderBy('id', 'asc');
        // Cek apakah ada parameter pencarian
        if ($request->has('search') && !empty($request->input('search')['value'])) {
            $searchTerm = $request->input('search')['value'];
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }
      
        // Gunakan DataTables langsung dari Query Builder, tanpa ->get()
        return DataTables::of($query)
            ->addIndexColumn()
            
            ->addColumn('details', function ($row) {
                 $formattedDate = Carbon::parse($row->created_at)
            ->locale('id')
            ->translatedFormat('l, j F Y');
                return '<a id="sets" class="btn btn-pill btn-outline-orange btn-sm" data-bs-toggle="modal" data-bs-target="#modal-large"
                             data-nm="' . htmlspecialchars($row->name, ENT_QUOTES, 'UTF-8') . '"
                             data-em="' . htmlspecialchars($row->email, ENT_QUOTES, 'UTF-8') . '"
                             data-phones="' . htmlspecialchars($row->phone, ENT_QUOTES, 'UTF-8') . '"
                             data-crte="' . htmlspecialchars($formattedDate, ENT_QUOTES, 'UTF-8') . '"
                             data-sub="' . htmlspecialchars($row->subject, ENT_QUOTES, 'UTF-8') . '"
                             data-masage="' . htmlspecialchars($row->message, ENT_QUOTES, 'UTF-8') . '"
                            >
                            <i class="fa fa-sticky-note"> </i> Details
                        </a>';
            })



            ->addColumn('action', function ($row) {
                $idRoleCrypt = Crypt::encrypt($row->id);
                $deleteRUrl = route('Admins.users.contact.form.delete', $idRoleCrypt);
                        $btn = '';
                        $btn .= '<form action="' . $deleteRUrl . '" method="POST" class="d-inline">
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
            ->rawColumns(['action','details'])
            ->make(true);
    }

    }


    public function Contact_messages_delete($id)  {
        try {
        $idCmdDecrypted = Crypt::decrypt($id);
        $cmdData = ContactMessage::find($idCmdDecrypted);

        if (!$cmdData) {
            return redirect()->route('Admins.List.contact.request')
                ->with('error', 'Data ID Not Found!');
        }
        $cmdData->delete();
        return redirect()->route('Admins.List.contact.request')->with('success', 'Success delete');
    } catch (DecryptException $e) {
        return redirect()->route('Admins.List.contact.request')
            ->with('error', 'Invalid menu ID!');
    } catch (\Throwable $th) {
        return redirect()->route('Admins.List.contact.request')
            ->with('error', 'Failed to delete data. Please try again.');
    }
    }
}