<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\StoreFile;
use Illuminate\Http\Request;

class StoreUploadController extends Controller
{
    //
    public function createForm(){
        return view('livewire.store.store-upload');
      }

    public function storeupload(Request $req){
        $req->validate([
          'file' => 'required|mimes:csv,txt,xlx,xls,pdf,img,png|max:2048'
        ]);
        $fileModel = new StoreFile();
        if($req->file()) {
            $fileName = time().'_'.$req->file->getClientOriginalName();
            $filePath = $req->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$req->file->getClientOriginalName();
            $fileModel->file_path = '/storage/' . $filePath;
            $fileModel->save();
            return back()
            ->with('success','File has been uploaded.')
            ->with('file', $fileName);
    }  
}

}