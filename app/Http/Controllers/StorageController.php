<?php

namespace App\Http\Controllers;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageController extends Controller
{
    
    public function index()
    {
        $storages = Storage::all();
        
        return view('storage.index',['storages'=>$storages]);
    }

    public function create()
    {
        return view('storage.create');
    }

    public function store(Request $request)
    {
        
        // تحقق من صحة الطلب
        $request->validate([
            'item' => ['required', 'string'],
            'quantity' => ['required','integer']
            
        ]);


        // إنشاء 
        $storage = Storage::create([
            'item' => $request->item,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('storage.index'); // إعادة التوجيه بعد التخزين
    }
    public function edit($id)
    {
        $storage = Storage::find($id);
        return view('storage.create', ['storage' => $storage]);
    }

    public function update(Request $request,$storage_id)
         {
            
            $storage = Storage::where('id',$storage_id)->first();
            
            $request->validate([
                'item' => ['required', 'string'],
                'quantity' => ['required','integer']
                
            ]);
 
            $storage = Storage::create([
                'item' => $request->item,
                'quantity' => $request->quantity,
            ]);
            
             
             return redirect()->route('storage.index'); 
            }

     public function destroy($storage_id)
     { 
        
        $storage = Storage::find($storage_id);

         $storage->delete();
       
         return redirect()->route('storage.index');

     }

    public function show($storage) {
        $storage = Storage::findOrFail($storage); // Fetch the product by ID
        return view('storage.show', compact('storage')); // Pass the product to the view
    }

}
