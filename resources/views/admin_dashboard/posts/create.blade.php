@extends("admin_dashboard.layouts.app")

@section("style")
<link href="{{asset('admin_dashboard_asset/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin_dashboard_asset/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
<link href="{{asset('admin_dashboard_asset/plugins/input-tags/css/tagsinput.css')}}" rel="stylesheet" />

<script src="https://cdn.tiny.cloud/1/lpe9b02kzkbppz26gl15na4725k7rbe0kuakp2xu3auio3jb/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>

@endsection

@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Posts</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Posts</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New Post</h5>
                <hr />
                <form action="{{route('admin.posts.store')}}" method="post" autocomplete="off" enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Title</label>
                                        <input required type="text" name="title" value="{{old('title')}}" class="form-control" id="inputProductTitle" placeholder="Enter product title">
                                        @error('title')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Slug</label>
                                        <input required type="text" class="form-control" id="inputProductTitle" name="slug" value="{{old('slug')}}"
                                            placeholder="Enter product title">
                                        @error('slug')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Excerpt</label>
                                        <input required type="text" class="form-control" id="inputProductTitle" name="excerpt" value="{{old('excerpt')}}"
                                            placeholder="Enter product title">
                                        @error('excerpt')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">Post Category (Recomended: 750x250px)</label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="p-1 rounded">
                                                    <div class="mb-3">
                                                        <select required class="single-select" name="category_id">
                                                            @foreach ($categories as $key => $category)
                                                            <option value="{{$key}}">{{$category}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('category_id')
                                                            <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                       <label class="form-label">Post Tags</label>
                                        <input type="text" name="tags" class="form-control" data-role="tagsinput" value="{{old('tags')}}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">
                                            Product Thumbnail
                                        </label>
                                        <input required id="thumbnail" id="file" type="file" accept=",image/*" name="thumbnail">
                                        @error('thumbnail')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Post Content</label>
                                        <textarea class="form-control" id="post_content" rows="3" name="body">{{old('body')}}</textarea>
                                        @error('body')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <button class='btn btn-primary' type='submit'>Add Post</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>

            </div>
        </div>


    </div>
</div>
<!--end page wrapper -->
@endsection

@section("script")

<script src="{{asset('admin_dashboard_asset/plugins/select2/js/select2.min.js')}}"></script>
<script src="{{asset('admin_dashboard_asset/plugins/input-tags/js/tagsinput.js')}}"></script>

<script>
    $(document).ready(function () {
            
	    $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});
		$('.multiple-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

        tinymce.init({
            selector: '#post_content',
            plugins: 'advlist autolink lists link image charmap print preview hr anchor pagebreak code',
            toolbar_mode: 'floating',
            height: '500',
            image_class_list: [
                {title: 'img-responsive', value: 'img-responsive'},
            ],

            paste_data_images: true,
            toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code | ltr rtl',

            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            paste_data_images: true,
            images_upload_url: "/tinymce_image",

            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');
                input.onchange = function() {
                    var file = this.files[0];
                    
                    var reader = new FileReader();
                    reader.readAsDataURL(file);
                    reader.onload = function () {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                };
                input.click();
            },

            // image_upload_handler: function(blobinfo, success, failure){
            // let formData = new FormData();
            // let csrf_token = $($this).parents("form").find("input[name='_token']").val();
            
            // let xhr = new XMLHttpRequest();
            // xhr.open('post', "{{route('/tinymce_image')}}");
            
            // xhr.onload = () =>{
            // if(xhr.status != 200){
            // failure("Http Error: " + xhr.status);
            // return;
            // }
            // let json = JSON.parse(xhr.responseText);
            // if(!json || typeof json.location != 'string'){
            // failure("Invalid JSON: " + xhr.responseText);
            // return;
            // }
            // success(json.location);
            // }
            
            // formData.append('_token', csrf_token);
            // formData.append('file', blobinfo.blob(), blobinfo.filename());
            // xhr.send(formData);
            // },
        });

        setTimeout(() => {
            $('.general-message').fadeOut();
        }, 5000);
    });
</script>
@endsection