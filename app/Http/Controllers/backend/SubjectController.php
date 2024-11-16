<?php

namespace App\Http\Controllers\backend;

use App\Models\classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SubjectController extends Controller
{
    public function CreateSubject()
    {
        return view('backend.subject.create_subject_view');
    } //End Method


    public function StoreSubject( Request $request )
    {
        Subject::create([
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code
        ]);

        $notification = array(
            'message' => 'Subject Created Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.subjects')->with($notification);
        
    } //End Method

    public function ManageSubjects()
    {
        $subjects = Subject::all();
        return view('backend.subject.manage_subject_view',compact('subjects'));
    }

    public function EditSubject($id)
    {
        $subject = Subject::find($id);
        return view('backend.subject.edit_subject_view',compact('subject'));
    }

    public function UpdateSubject(Request $request)
    {
        $id = $request->id;
        Subject::where('id', $id)->update([
            'subject_name' => $request->subject_name,
            'subject_code' => $request->subject_code
        ]);

        $notification = array(
            'message' => 'Subject Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.subjects')->with($notification);
    }

    public function DeleteSubject($id)
    {
        Subject::find($id)->delete();

        $notification = array(
            'message' => 'Subject Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.subjects')->with($notification);
    }

    //Subject Combination
    public function AddSubjectCombination()
    {
        $classes = classes::all();
        $subjects = Subject::all();
        return view('backend.subject.add_subject_combination', compact('classes', 'subjects'));
    }
    public function StoreSubjectCombination(Request $request){
        $class = classes::find($request->class_id);
        $subjects = $request->subject_ids;
        $class->subjects()->attach($subjects);


        $notification = array(
            'message' => 'Combination Done Successfully!',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }

    public function ManageSubjectCombination(){
        $results = DB::table('classes_subject')
            ->join('classes', 'classes_subject.classes_id', 'classes.id')
            ->join('subjects', 'classes_subject.subject_id', 'subjects.id')
            ->select('classes_subject.*', 'classes.class_name', 'classes.section', 'subjects.subject_name')
            ->get();

        return view('backend.subject.manage_subject_combination', compact('results'));
    }

    public function DeactivateSubjectCombination($id){
        $status = DB::table('classes_subject')->select('status')->where('id', $id)->first();

        if($status->status == 1){
            DB::table('classes_subject')->where('id', $id)->update(['status' => 0]);

            $notification = array(
                'message' => 'Subject De-activated Successfully!',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
        }
        elseif($status->status == 0){
            DB::table('classes_subject')->where('id', $id)->update(['status' => 1]);

            $notification = array(
                'message' => 'Subject Activated Successfully!',
                'alert-type' => 'info'
            );
    
            return redirect()->back()->with($notification);
        }
    }
}
