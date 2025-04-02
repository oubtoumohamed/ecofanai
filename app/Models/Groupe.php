<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\MainModel;

class Groupe extends Model
{
    use MainModel;

    protected $fillable = [
        'name','roles'
    ];

    public function __toString(){
        return $this->name;
    }

    public function __toHtml(){
        return ( $this->id ) ? '<a href="'.route('groupe_edit',$this->id).'" target="_blank">'.$this->name.'</a>' : "";
    }

    public function getname(){
        return $this->name;
    }

    public function users(){
        return $this->hasMany('User','usergroupe','groupe_id');
    }

    public function get__roles(){

        $actions = [
            'LIST'=>'Listage',
            'CREATE'=>'Création',
            'EDIT'=>'Modification',
            'DELETE'=>'Suppression',
            'SHOW'=>'Affichage',
        ];

        return [
            'ACHAT' =>[
                'name' => 'Achat',
                'actions' => array_merge($actions, [
                    'VALIDE'=>'Validation'
                ]),
            ],
            'FABRICATION' =>[
                'name' => 'Fabrication',
                'actions' => array_merge($actions, [
                    'VALIDE'=>'Validation'
                ]),
            ],
            'TRANSFERT' =>[
                'name' => 'Transfert',
                'actions' => $actions,
            ],
            'ORDER' =>[
                'name' => 'Vente',
                'actions' => $actions,
            ],
            'VERSEMENT' =>[
                'name' => 'Versement',
                'actions' => $actions,
            ],
            'CHARGE' =>[
                'name' => 'Charge',
                'actions' => $actions,
            ],
            'PRODUCT' =>[
                'name' => 'Produit',
                'actions' => $actions,
            ],
            'CATEGORIE' =>[
                'name' => 'Categories',
                'actions' => $actions,
            ],
            'USER' =>[
                'name' => 'Utilisateurs',
                'actions' => $actions,
            ],
            'GROUPE' =>[
                'name' => 'Droits d\'accès',
                'actions' => $actions,
            ],
        ];
    }
}
