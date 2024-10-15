<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ImageController extends Controller
{
  public function show($filename)
  {
      // Cek apakah file ada di storage
      if (!Storage::disk('public')->exists("images/$filename")) {
          return response()->json(['error' => 'File not found'], 404);
      }
  
      // Mengembalikan file
      return response()->file(storage_path("app/public/images/$filename"));
  }
  
}
