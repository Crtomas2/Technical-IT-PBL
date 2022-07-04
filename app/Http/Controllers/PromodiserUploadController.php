<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PromodiserTable;
use Illuminate\Http\Request;

class PromodiserUploadController extends Controller
{
    //
    public function createForm(){
        return view('promodiser-upload');
      }

    public function promodiserUpload(Request $req){
        $req->validate([
            'file' => 'required|mimes:csv,txt,xlx,xls,pdf,img,png|max:2048'
          ]);
          $fileModel = new PromodiserTable();
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
