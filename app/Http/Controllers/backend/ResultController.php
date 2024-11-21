<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classes;
use App\Models\Student;
use App\Models\Result;

class ResultController extends Controller
{
    public function AddResult(){

        $classes = classes::all();
        return view('backend.result.add_result_view',compact('classes'));
    }

    public function FetchStudent(Request $request){
        $class_id = $request->class_id;
        $students = Student::where('class_id', $class_id)->get();
        $std_data = '<option>Select a Student</option>';
        foreach ($students as $student){
            $std_data .= '<option value="'.$student->id.'"> '.$student->name.' | '.$student->roll_id.' </option>';
        }

        $class = classes::with('subjects')->where('id', $class_id)->first();
        $class_subjects = $class->subjects;

        for ($i = 0; $i < count($class_subjects); $i++){
            $subject_data[$i] = '<label for="english">'.$class_subjects[$i]->subject_name.'</label>
            <input class="form-control" type="hidden" name="subject_ids[]" value="'.$class_subjects[$i]->id.'">
            <input class="form-control" required type="text" name="marks[]" placeholder="Enter mark out of 100">';
        }

        return response()->json(['students' => $std_data, 'subjects' => $subject_data]);
    }

    public function FetchStudentResult(Request $request){
        $student_id = $request->student_id;
        $result = Result::where('student_id', $student_id)->first();
        $message = '';

        if($result){
            $message .= '<div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <i class="mdi mdi-bullseye-arrow me-2"></i>
                        This Student\'s Result is Already Declared!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
        }

        return response()->json($message);
    }


    public function StoreResult(Request $request){
        $sub_count = count($request->subject_ids);
        for ($i = 0; $i < $sub_count; $i++){
            $result = [
                'student_id' => $request->student_id,
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_ids[$i],
                'marks' => $request->marks[$i]
            ];

            Result::create($result);
        }

        $notification = array(
            'message' => 'Result Declared Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('manage.results')->with($notification);
    }

    public function ManageResult(){
        $results = Result::groupBy('student_id')->get();
        return view('backend.result.manage_result', compact('results'));
    }

    public function EditResult($id){
        $result = Result::where('student_id', $id)->get();
        return view('backend.result.edit_result', compact('result'));
    }

    public function UpdateResult(Request $request){ 
        $sub_count = count($request->subject_ids);
        for ($i = 0; $i < $sub_count; $i++){
            $result = Result::where('id', $request->result_ids[$i])->update([
                'subject_id' => $request->subject_ids[$i],
                'marks' => $request->marks[$i],
            ]);
        }

        $notification = array(
            'message' => 'Result Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteResult($id){
        $result = Result::where('student_id', $id)->get();

        for ($i=0; $i < count($result); $i++) { 
            $result[$i]->delete();
        }

        $notification = array(
            'message' => 'Result Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
