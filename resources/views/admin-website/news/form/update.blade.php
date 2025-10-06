@extends('layouts.app')
@section('content')

<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          {{ $title }}
        </h2>
        <p class="text-muted">
            {{ $title }}
        </p>
      </div>
    </div>
  </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">{{ $title }}</h3>
          </div>
            <div class="card-body">
               <form method="POST" action="{{ route('Admins.update.blogs') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">title Blog <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title' , $row->title) }}" placeholder="Title">
                                <input type="hidden" class="form-control" name="id" value="{{ old('id' , $idBlogs) }}" placeholder="id">
                                @error('title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                      
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Meta Title <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('meta_title') is-invalid @enderror" name="meta_title" value="{{ old('meta_title', $row->meta_title) }}" placeholder="meta title">
                                @error('meta_title')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        
                         <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Meta Description <small class="text-danger">*</small></label>
                                <input type="text" class="form-control @error('meta_description') is-invalid @enderror" name="meta_description" value="{{ old('meta_description' , $row->meta_description) }}" placeholder="meta description">
                                @error('meta_description')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label" >Category Blog<small class="text-danger">*</small></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category">
                                    <option selected value="">Select</option>
                                   @foreach ($Category as $cat)
                                      <option value="{{ $cat->id }}" {{ old('category_id', $row->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                   @endforeach
                                </select>
                                    @error('category_id')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>




                     <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" >Status Publish <small class="text-danger">*</small></label>
                            <select class="form-select @error('is_published') is-invalid @enderror" name="is_published" id="is_published">
                                <option selected value="">Select</option>
                                <option value="1" {{ old('is_published', $row->is_published ?? '') == 1 ? 'selected' : '' }}>Publish</option>
                                <option value="0" {{ old('is_published', $row->is_published ?? '') == 0 ? 'selected' : '' }}>Not Publish</option>
                            </select>
                                @error('is_published')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                        </div>
                        </div>
                    </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" >Excerpt Blog<small class="text-danger">*</small></label>
                                    <textarea name="excerpt" id="" cols="3" rows="3" class="form-control">{{ $row->excerpt }}</textarea>
                                    @error('excerpt')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label" >Content Blog<small class="text-danger">*</small></label>
                                    <textarea name="content" id="editor" cols="6" rows="6" class="form-control">{{ $row->content }}</textarea>
                                    @error('content')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                            </div>
                        </div>


                    <div class="row">
    <div class="col-md-4">
        <div class="mb-3">
            <label for="image" class="form-label">Image <small class="text-danger">(*)</small></label>
            
            {{-- Preview Image --}}
            <img id="imgPreview" 
                src="{{ isset($row) && $row->image ? asset('storage/blogs/' . $row->image) : asset('storage/blogs/default.png') }}" 
                class="img-thumbnail mb-2" 
                alt="Preview" 
                style="width: 100px; height: 100px; object-fit: cover;"/>
            
            {{-- Input File --}}
            <input 
                class="form-control @error('image') is-invalid @enderror" 
                type="file" 
                name="image" 
                id="image"
                accept="image/png, image/jpeg, image/jpg, image/gif">

                  <input type="hidden" name="imageold" value="{{($row->image)}}" class="form-control mt-2" id="coversold">

            <small class="text-muted">Rekomendasi: 100x100px, format: JPG/PNG/GIF</small>

            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

 <div class="text-end">
                        <button type="submit" class="btn btn-outline-primary">Update</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>
                    </div>



</form>
</div>
</div>
</div>
</div>
<style>
    .ck-editor__editable_inline {
        min-height: 200px; /* lebih tinggi ke bawah */
    }
</style>
<script type="text/javascript">
    // assetCode
    $(document).ready(function() {
      
       
        $("#category").select2({
          placeholder: "SELECT A CATEGORY BLOG",
           allowClear: true,
           theme: 'bootstrap4',
        });

        $("#is_published").select2({
          placeholder: "SELECT A STATUS PUBLISH",
           allowClear: true,
           theme: 'bootstrap4',
        });
    });

     document.getElementById('image').addEventListener('change', function (event) {
        let reader = new FileReader();
        reader.onload = function () {
            document.getElementById('imgPreview').src = reader.result;
        };
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor.create(document.querySelector('#editor')).catch(error => {
      console.error(error);
  });
</script>
@endsection