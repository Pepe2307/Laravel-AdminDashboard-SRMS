@extends('admin.admin_dashboard')
@section('admin')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Manage Subjects</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                    <li class="breadcrumb-item active">Subjects</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">

        <h4 class="card-title">View Subjects Information</h4>

        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>#</th>
                <th>Subject Name</th>
                <th>Subject Code</th>
                <th>Creation Date</th>
                <th>Updated Date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

                @foreach ($subjects as $key => $subject)

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$subject->subject_name}}</td>
                    <td>{{$subject->subject_code}}</td>
                    <td>{{$subject->created_at}}</td>
                    <td>{{$subject->updated_at}}</td>
                    <td style="text-align: center; font-size: 20px"> 
                        <a href="{{route('edit.subject', $subject->id)}}" style="color: #444; margin-right: 30px"><i class="fas fa-edit"></i></a>
                        <a href="{{route('delete.subject', $subject->id)}}" id="delete" style="color: #444;" ><i class="fas fa-trash-alt"></i></a> 
                    </td>
                    
                    
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection