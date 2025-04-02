<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Media;
use App\Models\Bin;
use App\Models\Action;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function take()
    {
        return view('take');
    }

    public function upload_video(Request $request)
    {
        if( !$request->file('video') )
            return response()->json([
                'error'=>'Please take a short video',
            ]);

        $bin = Bin::where('code', $request->qrcodetext)->first();

        if( !$bin || !$bin->id )
            return response()->json([
                'error'=>'Bin not found.',
            ]);

        $media = new Media();
        $media->_file = $request->file('video');
        $media->_path = 'video';
        $media = $media->_save();

        $action = Action::create([
            'code'=>"123",
            'state'=>"created",
            'note'=>0,
            'user_id'=>auth()->user()->id,
            'media_id'=>$media->id
        ]);

        if( $action && $action->id )
            return response()->json([
                'success'=>'Your action has been created.',
            ]);
        
        
        return response()->json([
            'error'=>'Please try again.',
        ]);
    }

    public function history()
    {
        $actions = Action::where('user_id', auth()->user()->id)->get();

        return view('history', [
            'actions'=>$actions
        ]);
    }
}
