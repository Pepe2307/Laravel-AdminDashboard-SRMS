@extends('admin.admin_dashboard')
@section('admin')

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Manage Classes</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Manage</a></li>
                    <li class="breadcrumb-item active">Classes</li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->

<div class="card">
    <div class="card-body">

        <h4 class="card-title">View Classes Information</h4>

        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
            <thead>
            <tr>
                <th>#</th>
                <th>Class Name</th>
                <th>Section</th>
                <th>Creation Date</th>
                <th>Action</th>
            </tr>
            </thead>

            <tbody>

                @foreach ($classes as $key => $class)

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{$class->class_name}}</td>
                    <td>{{$class->section}}</td>
                    <td>{{$class->created_at}}</td>
                    <td style="text-align: center; font-size: 20px"> 
                        <a href="{{route('edit.class', $class->id)}}" style="color: #444; margin-right: 30px"><i class="fas fa-edit"></i></a>
                        <a href="{{route('delete.class', $class->id)}}" id="delete" style="color: #444;" ><i class="fas fa-trash-alt"></i></a> 
                    </td>
                    
                    
                </tr>

                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection