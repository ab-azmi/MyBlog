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
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Add New User</h5>
                <hr />
                <form action="{{route('admin.users.store')}}" method="post" autocomplete="off"
                    enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">User Name</label>
                                        <input required type="text" name="name" value="{{old('name')}}" class="form-control" id="inputProductTitle"
                                            placeholder="Enter Name">
                                        @error('name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">User Email</label>
                                        <input required type="email" name="email" value="{{old('email')}}" class="form-control" id="inputProductTitle"
                                            placeholder="Enter Email">
                                        @error('email')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">User Password</label>
                                        <input required type="password" name="password" class="form-control" id="inputProductTitle"
                                            placeholder="Enter Password">
                                        @error('password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">User Image</label>
                                        <input required type="file" name="image" value="{{old('image')}}" class="form-control"
                                            id="inputProductTitle" >
                                        @error('image')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputProductTitle" class="form-label">
                                            User Role
                                        </label>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="p-1 rounded">
                                                    <div class="mb-3">
                                                        <select required class="single-select" name="role_id">
                                                            @foreach ($roles as $key => $role)
                                                            <option value="{{$key}}">{{$role}}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('role_id')
                                                        <p class="text-danger">{{$message}}</p>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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