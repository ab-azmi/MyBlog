@extends("admin_dashboard.layouts.app")

@section("style")
<script src="https://cdn.tiny.cloud/1/lpe9b02kzkbppz26gl15na4725k7rbe0kuakp2xu3auio3jb/tinymce/5/tinymce.min.js"
    referrerpolicy="origin"></script>
@endsection

@section("wrapper")
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">About</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">About</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card">
            <div class="card-body p-4">
                <h5 class="card-title">Edit About</h5>
                <hr />
                <form action="{{route('admin.abouts.update')}}" method="post" autocomplete="off"
                    enctype='multipart/form-data'>
                    @csrf
                    <div class="form-body mt-4">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="border border-3 p-4 rounded">
                                    <div class="mb-3">
                                        <label for="inputProductDescription" class="form-label">"Who are we"
                                            text</label>
                                        <textarea required name="first_text" class="form-control" id="first_text">{{old('first_text', $abouts->first_text)}}</textarea>
                                        @error('first_text')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="second_text" class="form-label">Bottom Text</label>
                                        <textarea name="second_text" class="form-control" id="second_text">{{old('second_text', $abouts->second_text)}}</textarea>
                                        @error('second_text')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <label for="inputProductDescription" class="form-label">
                                                    Top Image
                                                </label>
                                                <input type="file" name="first_image" value=""
                                                    class="form-control" id="inputProductTitle">
                                                @error('first_image')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5 p-2">
                                            <img src="{{asset('storage/'.$abouts->first_image)}}" class="img-fluid img-thumbnail"
                                                alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <label for="inputProductDescription" class="form-label">
                                                    Bottom Image
                                                </label>
                                                <input  type="file" name="second_image" value=""
                                                    class="form-control" id="inputProductTitle">
                                                @error('second_image')
                                                <p class="text-danger">{{$message}}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-5 p-2">
                                            <img src="{{asset('storage/'.$abouts->second_image)}}" class="img-fluid img-thumbnail"
                                                alt="" srcset="">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="our_mission" class="form-label">Mission text</label>
                                        <textarea class="form-control" id="our_mission" rows="3" name="our_mission">
                                            {{old('our_mission', $abouts->our_mission)}}
                                        </textarea>
                                        @error('our_mission')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="our_vision" class="form-label">Vision Text</label>
                                        <textarea class="form-control" id="our_vision" rows="3" name="our_vision">
                                            {{old('our_vision', $abouts->our_vision)}}
                                        </textarea>
                                        @error('our_vision')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="services" class="form-label">Services Text</label>
                                        <textarea class="form-control" id="services" rows="3" name="services">
                                            {{old('services', $abouts->services)}}
                                        </textarea>
                                        @error('services')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>

                                    <button class='btn btn-primary' type='submit'>Update About</button>

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


<script>
    $(document).ready(function () {

        setTimeout(() => {
            $('.general-message').fadeOut();
        }, 5000);
    
        let TinyMCEInit = (id) =>{
            tinymce.init({
                selector: id,
                plugins: 'advlist autolink lists link charmap print preview hr anchor pagebreak code',
                toolbar_mode: 'floating',
                height: '300',
                toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | code | ltr rtl',
            });
        };

        TinyMCEInit('#our_mission');
        TinyMCEInit('#our_vision');
        TinyMCEInit('#services');
        TinyMCEInit('#first_text');
        TinyMCEInit('#second_text');
    });

</script>
@endsection