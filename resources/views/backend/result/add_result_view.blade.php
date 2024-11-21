@extends('admin.admin_dashboard')
@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Declare a Result</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Declare</a></li>
                        <li class="breadcrumb-item active">Result</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="card">
        <div class="card-body">

            <h4 class="card-title">Declare Student Result</h4>

            <form action="{{route('store.result')}}" method="POST">
                @csrf

                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Class</label>
                    <div class="col-sm-10">
                        {{-- <select name="class_id" class="form-select dynamic" data-dependent="student_id"> --}}
                        <select name="class_id" class="form-select dynamic" data-dependant="student">
                            <option selected="">Select a Class</option>
                            @foreach ($classes as $class)
                                <option value="{{$class->id}}">{{$class->class_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- end row -->



                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Student Name</label>
                    <div class="col-sm-10">
                        <select name="student_id" class="form-select" id="student">
                            <option selected="">Select Student</option>
                        </select>
                    </div>
                </div>
                <!-- end row -->


                <div class="row mb-3">
                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10" id="alert">
                        
                    </div>
                </div>
                <!-- end row -->



                <div class="row mb-3 showSubjects">
                    <label for="example-text-input" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10 sub">
                        
                    </div>
                </div>
                <!-- end row -->

                <button type="submit" class="btn btn-primary waves-effect waves-light">Declare Results</button>
            </form>
            
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('.showSubjects').hide();
        $('.dynamic').on('change', function (){
            let class_id = $(this).val();
            let dependant = $(this).data('dependant');
            let _token = "{{ csrf_token() }}";
            $.ajax({
                url: "{{ route('fetch.student') }}",
                method: "GET",
                datatype: "json",
                data: {class_id:class_id, _token:_token},
                success: function (result){
                    $('#student').html(result.students);
                    $('.sub').html(result.subjects);
                    $('.showSubjects').show();
                }
            });
        });

        $('#student').change(function(){
            let student_id = $(this).val();
            $.ajax({
                url: "{{ route('check.student.result') }}",
                method: "GET",
                datatype: "json",
                data: {student_id:student_id, _token:"{{ csrf_token() }}"},
                success: function (result){
                    $('#alert').html(result);
                }
            });
            
    });
}); /* end jquery */
</script>
@endsection