<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DeleteMediaController extends Controller
{
   public function __invoke(Media $media)
   {
       // TODO: Implement __invoke() method.

       $media->delete();
       return response()->json([
           'message' => 'Media deleted',
       ]);
   }
}
