<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\MainModel;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable, MainModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'firstname',
        'lastename',
        'username',
        'role',
        'cin',
        'phone',
        'adresse',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function __toString(){
        return ( $this->id ) ? $this->firstname." ".$this->lastename." " : "";
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('user_edit',$this->id).'" target="_blank">'.$this->__toString().'</a>' : "";
    }

    public static function selectable(){ return ['id','firstname','lastename', DB::raw("CONCAT(firstname,' ',lastename) as text")]; }
    
    public function groupes(){
        return $this->belongsToMany('App\Models\Groupe','usergroupes','user_id');
    }

    public function picture(){
        return $this->belongsTo('App\Models\Media','avatar','id');
    }

    public function avatar(){
        return  '<span class="avatar">' . ($this->picture ? $this->picture->reference : substr($this->name, 0, 2) ).'</span>';
    }

    public function getavatar($size="lg"){
        return $this->picture ? $this->getavatarlink($size) : $this->getavatarlink($size, asset("logo.png"));
    }

    public function getavatartext($size="lg"){
        return $this->picture ? '' : '<span class="avatar avatar-'.$size.' avatar-blue mr-4">'.substr($this->name, 0, 2).'</span>';
    }

    public function getavatarlink($size="lg", $link = null){
        return '<img src="'.( $link == null ? $this->picture->link() : $link ).'" alt="'.$this->firstname.'" class="avatar-'.$size.'">';
    }

    public function getavatarfulllink(){
        return $this->picture ? $this->picture->link() : asset('avatar.jpg');
    }

    public function roles(){
        $roles = [];
        $roles[] = strtolower($this->role);

        foreach ($this->groupes as $groupe) {
            foreach (explode(',', $groupe->roles) as $role) {
                array_push($roles, strtolower($role) );
            }
        }
        return $roles;
    }
    
    public function isGranted($role){
        
        if($this->role == "ADMIN")
           return true;

        $roles = $this->roles();
//dd($roles);
        if( in_array( strtolower($role), $roles) )
            return true;


        return false;
    }

    public function scopeGroupe($query)
    {
        global $filter;
        $filter = request('filter');

        if( $filter["groupes"] and $filter["groupes"]['value'] ){
            return $query->whereHas('groupes', function ($query) {
                global $filter;


                $query->where('groupe_id', $filter["groupes"]['value']);
            });
        }
    }


    public function getfirstname(){ return $this->firstname; }
    public function getlastename(){ return $this->lastename; }
    public function getusername(){ return $this->username; }
    public function getemail(){ return $this->email; }
    public function getcin(){ return $this->cin; }
    public function getphone(){ return $this->phone; }
}
