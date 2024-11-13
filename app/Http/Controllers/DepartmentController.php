<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        
        return view('department.index',['departments'=>$departments]);
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(Request $request)
    {
        
        // تحقق من صحة الطلب
        $request->validate([
            'title' => ['required', 'string'],
            
        ]);


        // إنشاء 
        $department = Department::create([
            'title' => $request->title,
        ]);

        return redirect()->route('department.index'); // إعادة التوجيه بعد التخزين
    }
    public function edit($id)
    {
        $department = Department::find($id);
        return view('department.create', ['department' => $department]);
    }

    public function update(Request $request,$department_id)
         {
            
            $department = Department::where('id',$department_id)->first();
            
            $request->validate([
                'title' => ['required', 'string'],
             
            ]);
 
            $department->update([
                'title' => $request->title,
             
            ]);
            
             
             return redirect()->route('department.index'); 
            }

     public function destroy($department_id)
     { 
        
        $department = Department::where('id',$department_id)->first();

         $department->delete();
       
         return redirect()->route('department.index');

     }

    public function show($department_id) {
        $department = Department::findOrFail($department_id); // Fetch the product by ID
        return view('department.show', compact('department')); // Pass the product to the view
    }
}
