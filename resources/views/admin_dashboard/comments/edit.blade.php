@extends("admin_dashboard.layouts.app")

@section("style")
<link href="{{asset('admin_dashboard_asset/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
<link href="{{asset('admin_dashboard_asset/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />

@endsection

@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Comments</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Comments</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit Comments</h5>
                <hr />
                <form action="{{route('admin.comments.update', $comment)}}" method="post" autocomplete="off"
                    enctype='multipart/form-data'>
                    @csrf
                    @method('PATCH')
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">

                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">
                                            Post Title
                                        </label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="p-1 rounded">
                                                    <div class="mb-3">
                                                        <select required class="single-select" name="post_id">
                                                            @foreach ($posts as $key => $post)
                                                            <option {{$comment->post_id === $key ? 'selected' : ''}} 
                                                                value="{{$key}}">{{$post}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('post_id')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">Post Comment</label>
                                        <textarea class="form-control" id="the_comment" rows="3"
                                            name="the_comment">{{old('the_comment', $comment->the_comment)}}</textarea>
                                        @error('the_comment')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <button class='btn btn-primary' type='submit'>Update Post</button>
                                    <a class="btn btn-danger btn-md" href="#" onclick="event.preventDefault(); document.getElementById('comment_form_delete_{{$comment->id}}').submit()">Delete Comment</a>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </div>
                </form>
                <form action="{{route('admin.comments.destroy', $comment)}}" id="comment_form_delete_{{$comment->id}}" method="post">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>


    </div>
</div>
<!--end page wrapper -->
@endsection

@section("script")

<script src="{{asset('admin_dashboard_asset/plugins/select2/js/select2.min.js')}}"></script>

<script>
    $(document).ready(function () {
            
	    $('.single-select').select2({
			theme: 'bootstrap4',
			width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
			placeholder: $(this).data('placeholder'),
			allowClear: Boolean($(this).data('allow-clear')),
		});

        setTimeout(() => {
            $('.general-message').fadeOut();
        }, 5000);
    });
</script>
@endsection