@extends('admin.admin_dashboard')
@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Student</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Edit</a></li>
                        <li class="breadcrumb-item active">Student</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Edit Student Info</h4>

            <form action="{{route('update.student')}}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="id" value="{{$student->id}}">

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Full Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="text" name="full_name" value="{{$student->name}}">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Roll Id</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="text" name="roll_id" value="{{$student->roll_id}}">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="email" name="email" value="{{$student->email}}">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        <select name="class_id" class="form-select" aria-label="Default select example">
                            <option selected="">Select a Class</option>
                            @foreach ($classes as $class)
                                <option {{ $student->class_id == $class->id ? 'selected' : ''}} value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Gender</label>
                    <div class="col-sm-10">
                        <input class="form-check-input" type="radio" name="gender" value="male" {{ $student->gender == 'male' ? 'checked' : ''}}>
                        <label class="form-check-label" for="formRadios1"> Male </label>

                        <input class="form-check-input" type="radio" name="gender" value="female" {{ $student->gender == 'female' ? 'checked' : ''}}>
                        <label class="form-check-label" for="formRadios1"> Female </label>
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Date of Birth</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="date" name="dob" value="{{$student->dob}}">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Photo</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="photo" id="Image">
                    </div>
                </div>
                <!-- end row -->

                <div class="row mb-3">
                    <label for="example-email-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <img id="ShowImage" src="{{ empty($student->photo)? asset('uploads/no_image.png') : asset('/uploads/student_photos/'.$student->photo) }}" alt="avatar-4" class="rounded avatar-md">
                    </div>
                </div>


                <button type="submit" class="btn btn-primary waves-effect waves-light">Update Student</button>
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