@extends('admin.admin_dashboard')
@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Subject Creation</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Subject</a></li>
                        <li class="breadcrumb-item active">Creation</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Create Subject</h4>

            <form action="{{route('store.subject')}}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Subject Name</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="text" name="subject_name" placeholder="Subject Name">
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Subject Code</label>
                    <div class="col-sm-10">
                        <input class="form-control" required type="text" name="subject_code" placeholder="Subject Code">
                    </div>
                </div>
                <!-- end row -->

                <button type="submit" class="btn btn-primary waves-effect waves-light">Create Subject</button>
            </form>
            
        </div>
    </div>

</div>
@endsection