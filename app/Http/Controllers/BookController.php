<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Department;
use App\Models\Doctor;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index()
    {
        $books = Book::all();
       
        return view('book.index',['books'=>$books]);
    }

    public function create()
    {
        $depts = Department::all();
        $doctors = Doctor::all();

        return view('book.create',['depts'=>$depts,'doctors'=>$doctors]);
    }

    public function store(Request $request)
    {

        // // تحقق من صحة الطلب
        // $request->validate([
        //     'name' => ['required', 'string'],
        //     'phone' => ['required', 'string'],
        //     'address' => ['required', 'string'],
        //     'gender' => ['required',],
        //     'age' => ['required', 'integer'],
            
        // ]);


        // إنشاء 
        
        $book = Book::create([
            'dept_Id' => $request->dept_id,
             'doctor_id'=> $request->doctor_id,
             'bookDate'=> $request->bookDate,
             'patient_name'=> $request->patient_name,
             'phone'=> $request->phone,
        ]);

      

        return redirect()->route('book.index'); // إعادة التوجيه بعد التخزين
    }
    public function edit($id)
    {
        $book = Book::find($id);
        return view('book.create', ['book' => $book]);
    }

    public function update(Request $request,$book_id)
         {
            
            $book = Book::where('id',$book_id)->first();
            
 
            $book = Book::create([
                'dept_id' => $request->dept_id,
                 'doctor_id'=> $request->doctor_id,
                 'bookDate'=> $request->bookDate,
                 'patient_name'=> $request->patient_name,
                 'phone'=> $request->phone,
            ]);
            
             
             return redirect()->route('book.index'); 
            }

     public function destroy($book_id)
     { 

        $book = Book::where('id',$book_id)->first();

        $book->delete();
      
        return redirect()->route('book.index');
     
     }

}
