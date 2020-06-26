<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function store(Request $request)
    {
        $sender_id = auth()->user()->id;
        $reseiver_id = $request->reseiver_id;
        $filename = $request->image;
//        return $request->files;
        $realname = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->store('posts');
        $size = Storage::size($path);
        $extension = $request->file('image')->extension();
//            dd($size, $extension);
//        $params['sender_id'] = $sender_id;
        $params['sender_id'] = "5";
        $params['reseiver_id'] = $reseiver_id;
        $params['realname'] = $realname;
        $params['filename'] = $path;
        $params['size'] = $size;
        $params['ext'] = $extension;
        $params['delivered'] = 0;
//        return $params;
//        DB::table('posts')->insert($params);
        $post = Post::create($params);

        return $realname;
//        return view('st', compact('users', 'user', 'realname', 'filename', 'path', 'extension', 'size'));
    }

}
