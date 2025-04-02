<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Groupe;
use App\Models\Media;

class UserController extends Controller
{
    /*
     * Create a new controller instance.
     */

    public function __construct()
    {
        //$this->middleware('auth');
    }

    /*
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::list();

        if( request('forAction') == 'loadSelect' )
            return response()->json( $users );

        return view('user.list', [
            'results'=>$users
        ]);
    }

    public function vendors()
    {
        $users = User::where('role', 'VENDOR')->list();
        return response()->json( $users );
    }

    /*
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $groupes = Groupe::all();
        
        return view('user.update',[
            'object'=> new User(),
            'groupes'=>$groupes
        ]);
    }

    /*
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'firstname' => 'required|string|max:255',
            'lastename' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users'
        ]);

        $avatar = null;

        $media = new Media();
        if($request->file('avatar')){
            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $avatar = $media->id;
        }

        $user = User::create([
            'firstname'=>request('firstname'),
            'lastename'=>request('lastename'),
            'username'=>request('username'),
            'role'=>request('role'),
            'email'=>request('email'),
            'phone'=>request('phone'),
            'cin'=>request('cin'),
            'avatar'=>$avatar,
            'password'=>bcrypt( request('password') ),
        ]);

           
        $user->groupes()->sync(request('groupe'));

        return redirect()->route('user_edit', $user->id);
    }

    /*
     * Display the specified resource.
     */

    public function show($id)
    {
        return $this->edit($id);
        /*$user = User::findOrFail($id);
        return view('user.show', [
            'object'=>$user
        ]);*/
    }

    /*
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $groupes = Groupe::all();

        return view('user.update', [
            'object'=>$user,
            'groupes'=>$groupes
        ]);
    }

    /*
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->validate(request(), [
            'firstname' => 'required|string|max:255',
            'lastename' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);

        $user->firstname = request('firstname');
        $user->lastename = request('lastename');
        $user->username = request('username');
        $user->email = request('email');
        $user->cin = request('cin');
        $user->phone = request('phone');
        //$user->role = request('role');
        
        $media = new Media();
        if($request->file('avatar')){
            if($user->avatar)
                $media = Media::find($user->avatar);

            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $user->avatar = $media->id;
        }

        if(request('password'))
            $user->password = bcrypt(request('password'));
            
        $user->groupes()->sync(request('groupe'));
        
        $user->save();

        return redirect()->route('user_edit', $user->id);
    }



    /*
     * Show the form for editing the specified resource.
     */
    public function profile()
    {
        return view('user.profile', [
            'object'=> user()
        ]);
    }

    public function update_profile(Request $request)
    {
        $user = user();

        $this->validate(request(), [
            'firstname' => 'required|string|max:255',
            'lastename' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users,email,'.$user->id
        ]);


        $user->firstname = request('firstname');
        $user->lastename = request('lastename');
        $user->email = request('email');
        $user->cin = request('cin');
        $user->phone = request('phone');
        
        $media = new Media();
        if($request->file('avatar')){
            if($user->avatar)
                $media = Media::find($user->avatar);

            $media->_file = $request->file('avatar');
            $media->_path = 'Avatar';
            $media = $media->_save();

            if($media)
                $user->avatar = $media->id;
        }

        if(request('password'))
            $user->password = bcrypt(request('password'));

        $user->save();

        return redirect()->route('user_profile');
    }

    /*
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if( $user->picture )
            $user->picture->delete();
        $user->delete();

        return redirect()->route('user');
    }

}
