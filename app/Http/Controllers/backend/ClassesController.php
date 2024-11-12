<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\classes;

class ClassesController extends Controller
{
    public function CreateClass(){
        return view('backend.class.create_class_view');
    }


    public function StoreClass(Request $request){
        $class = new classes();
        $class->class_name = $request->class_name;
        $class->section = $request->section;
        $class->save();


        $notification = array(
            'message' => 'Student Class Created Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.classes')->with($notification);
    }


    public function ManageClasses(){
        $classes = classes::all();
        return view('backend.class.manage_classes_view',compact('classes'));
    }

    public function EditClass($id){
        $class = classes::find($id);
        
        return view('backend.class.edit_class_view',compact('class'));
    }

    public function UpdateClass(Request $request){
        $id = $request->id;
        classes::find($id)->update([
            'class_name' => $request->class_name,
            'section' => $request->section
        ]);

        $notification = array(
            'message' => 'Student Class Updated Successfully',
            'alert-type' => 'info'
        );

        return redirect()->route('manage.classes')->with($notification);
    }

    public function DeleteClass($id){
        classes::find($id)->delete();

        $notification = array(
            'message' => 'Student Class Deleted Successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);
    }
}
