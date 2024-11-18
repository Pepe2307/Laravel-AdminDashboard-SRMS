@extends('admin.admin_dashboard')
@section('admin')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Manage Students</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                    <li class="breadcrumb-item active">Students</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">

        <h4 class="card-title">View Students Information</h4>

        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Student Name</th>
                <th>Roll ID</th>
                <th>Class</th>
                <th>Registration Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

                @foreach ($students as $key => $student)

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <img class="rounded-circle header-profile-user" src="{{ empty($student->photo)? asset('uploads/no_image.png') : asset('/uploads/student_photos/'.$student->photo) }}"
                        alt="Header Avatar" sizes=" width:30px height:30px padding:0px"; >
                    </td>
                    <td>{{$student->name}}</td>
                    <td>{{$student->roll_id}}</td>
                    <td>{{$student->class->class_name}}</td>
                    <td>{{$student->created_at}}</td>
                    <td>{{$student->status}}</td>
                    <td style="text-align: center; font-size: 20px"> 
                        <a href="{{route('edit.student', $student->id)}}" style="color: #444; margin-right: 30px"><i class="fas fa-edit"></i></a>
                        <a href="{{route('delete.student', $student->id)}}" id="delete" style="color: #444;" ><i class="fas fa-trash-alt"></i></a> 
                    </td>
                    
                    
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection