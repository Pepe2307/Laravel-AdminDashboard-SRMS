<?php

namespace App\Http\Controllers\backend;

use App\Models\classes;
use App\Models\Subject;
use Illuminate\Http\Request;
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
}
