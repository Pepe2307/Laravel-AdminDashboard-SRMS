@extends('admin.admin_dashboard')
@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Student Admission</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Student</a></li>
                        <li class="breadcrumb-item active">Admission</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Fill Student Info</h4>

            <form action="{{route('store.student')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="text" name="full_name" placeholder="Full Name">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Roll Id</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="text" name="roll_id" placeholder="Roll Id">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="email" name="email" placeholder="Email">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        <select name="class_id" class="form-select" aria-label="Default select example">
                            <option selected="">Select a Class</option>
                            @foreach ($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <input class="form-check-input" type="radio" name="gender" value="male" checked="">
                        <label class="form-check-label" for="formRadios1"> Male </label>

                        <input class="form-check-input" type="radio" name="gender" value="female" checked="">
                        <label class="form-check-label" for="formRadios1"> Female </label>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="date" name="dob" placeholder="mm/dd/yy">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="file" name="photo" id="Image">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-email-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <img id="ShowImage" src="{{ asset('uploads/no_image.png') }}" alt="avatar-4" class="rounded avatar-md">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Student</button>
            </form>
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#Image').on('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#ShowImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection