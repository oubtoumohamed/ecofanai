<?php

namespace App\Traits;

trait MainModel {

    public static function scopeList($query)
    {
        if( request('forAction') == "loadSelect" )
            return $query->select( self::selectable() )->filter()->orderBy( self::getOrderbyColumn() , self::getOrderbyDirection() )->limit( self::getPerPage() )->get();
        
        return $query->filter()->orderBy( self::getOrderbyColumn() , self::getOrderbyDirection() )->paginate()->withPath(self::url_params(true,['page'=>null]));
    }

    public static function scopeSession($query, $start = null)
    {
        // start date FORMAT Y m d

        if( !$start )
            $start = date('Y-m-d');

        if( $start == date('Y-m-d') && ( date('H') >= 00 && date('H') < 9 )){
            $start = date('Y-m-d', strtotime($start . ' -1 day'));
        }
        $end = date('Y-m-d', strtotime($start . ' +1 day'));

        return $query->where([
            ['created_at', '>=', $start.' 09:00:00'],
            ['created_at', '<=', $end.' 08:59:59'],
        ]);
    }

    public static function get_code_sexe($c)
    {
        $s = '';
        switch ($c) {
            case 'mme':
            case 'mlle':
            case 'fille':
            case 'fnn':
                $s = 'F';
                break;
            case 'mr':
            case 'garcon':
            case 'mnn':
                $s = 'M';
                break;
            
            default:
                // code...
                break;
        }

        return $s;
    }

    public static function codes_civilite()
    {
        return [
            'Feminin'=>[
                'mme'=>'Madame',
                'mlle'=>'Mademoiselle',
                'fille'=>'Fille',
                'fnn'=>'Nouveau-née',
            ],
            'Masculin'=>[
                'mr'=>'Monsieur',
                'garcon'=>'Garçon',
                'mnn'=>'Nouveau-né',
            ],
        ];
    }

    public static function selectable()
    {
        return ['id'];
    }

    public function getPerPage()
    {
        return 30;
    }

    public static function getOrderbyColumn()
    {
        return "id";
    }

    public static function getOrderbyDirection()
    {
        return "desc";
    }

    public static function url_params($full = false,$params = []){
        $path = request()->getPathInfo();
        $withparams = request()->getRequestUri();

        if( count($params) ){
            if(!strpos($withparams,'?'))
                $withparams = $withparams . '?';
            foreach ($params as $key => $value){
                if(!strpos($withparams, $key.'='))
                    $withparams = $withparams .'&'. $key."=".$value;
                elseif($value != null){
                    $v = request($key);
                    $withparams = str_replace($key.'='.$v, $key."=".$value, $withparams);
                }else{
                    $v = request($key);
                    $withparams = str_replace('?'.$key.'='.$v, '', $withparams);
                    $withparams = str_replace('&'.$key.'='.$v, '', $withparams);
                }
            }
        }

        if( $full )
            return $withparams;

        return str_replace($path, '', $withparams);
    }

    public static function scopeFilter($query){
        return self::applyFilter($query);
    }

    public static function applyFilter($query){

        $defaultOptions = [
            'text' => [
                'name' => '',
                'operation' => 'like',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'hidden' => [
                'name' => '',
                'operation' => 'like',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'datepicker' => [
                'name' => '',
                'operation' => 'date-like',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'datetimepicker' => [
                'name' => '',
                'operation' => 'date-time-like',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'timepicker' => [
                'name' => '',
                'operation' => 'time-like',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'number' => [
                'name' => '',
                'operation' => '=',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'email' => [
                'name' => '',
                'operation' => 'like',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
            ],
            'select' => [
                'name' => '',
                'operation' => '=',
                'compare' => null,
                'operation_compare' => null,
                'type' => '',
                'value' => '',
                'andor' => 'and',
                'scope'=>'0',
                'classes' => '',
                'data' => [],
                'optgroup'=>false,
                'groupby' => 'id',
                'distinct' => '',
                'one_empty' => 1,
                'table' => 'groupes',
                'join' => [],
                'fields' => ['id as key_','name as value_'],
                'where' => [],
                'whereIn' => [],
            ],
        ];

        $filter = request('filter');
        $id = request('id');

        if( $id )
            $query->where( 'id', '=', $id );

        if( $filter ){
            foreach ($filter as $name => $options) {
                $name = ( $name == '_id_' ) ? 'id' : $name;
                $type = array_key_exists('type', $options) ? $options['type'] : 'text';
                $field = array_merge( $defaultOptions[$type] , $options);

                if(isset($field['value']) && $field['value'] != "__-__-____" && $field['value'] != "__:__" && $field['scope'] == "0" ){
                    switch ($field['operation']) {
                        case null:
                            break;
                        case '=':
                        case '!=':
                        case '>':
                        case '>=':
                        case '<':
                        case '<=':

                            $date_format = '/^[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}$/';
                            if (preg_match($date_format, $field['value'])){
                                list($d, $m, $y) = explode('-', $field['value']);
                                $where__ = [ $name , $field['operation'] , $y.'-'.$m.'-'.$d ];
                            }else{
                                $where__ = [ $name , $field['operation'], $field['value'] ];
                            }

                            if( $field['compare'] ){
                                if($field['andor'] == 'or')
                                    $query->orWhere([ $where__ ]);
                                else
                                    $query->where([ $where__ ]);

                                list($date , $heure) = explode(' ', $field['compare']);
                                list($d, $m, $y) = explode('-', $date);
                                //dd($d,$m,$y);
                                $where__ = [ $name , $field['operation_compare'], $y.'-'.$m.'-'.$d.' '.$heure];
                            }

                            break;
                        case 'nulle':
                            $where__ = [ $name ,'IS NULL', 'NULL' ];
                            break;
                        case 'date-like':
                            if( $field['value'] ){
                                list($d, $m, $y) = explode('-', $field['value']);
                                $where__ = [ $name , 'like', '%'.$y.'-'.$m.'-'.$d.'%' ];
                            }
                            break;
                        case 'time-like':
                            if( $field['value'] ){
                                $where__ = [ $name , 'like', '%'.$field['value'].'%' ];
                            }
                            break;
                        case 'date-time-like':
                            if( $field['value'] ){
                                list($date,$time) = explode(' ', $field['value']);
                                list($d, $m, $y) = explode('-', $date);
                                list($hour,$min) = explode(':', $time);
                                $where__ = [ $name , 'like', '%'.$y.'-'.$m.'-'.$d.' '.$hour.'%' ];
                                //$where__ = [ $name , '<=', $y.'-'.$m.'-'.$d.' '.$hour.':'.$min ];
                            }
                            break;
                        
                        case 'like-start':
                            $where__ = [ $name , 'like', $field['value'].'%' ];
                            break;
                            
                        case 'like-end':
                            $where__ = [ $name , 'like', '%'.$field['value'] ];
                            break;

                        default:
                            if( $field['operation'] != "in" )
                                $where__ = [ $name , $field['operation'], '%'.$field['value'].'%' ];
                            break;
                    }

                    if($field['andor'] == 'or'){
                        $query->orWhere([ $where__ ]);
                    }else{
                        if( $field['operation'] == "nulle" )
                            $query->whereNull($name);
                        elseif( $field['operation'] == "in" )
                            $query->whereIn($name, explode(',', $field['value']));
                        else
                            $query->where([ $where__ ]);
                    }
                }
            }
        }

        return $query;
    }

    public static function dateFormat($date, $format = 'Y-m-d'){
        try{
            $dt = date_create($date);
            return date_format($dt, $format);
        }catch(\Exception $e){
            return $date;
        }
    }

    public static function dateTimeFormat($date, $format = 'Y-m-d H:i:s'){
        return self::dateFormat($date, $format);
    }

    public static function numberFormat($number, $decimale = 2 ){
        $number = number_format($number, $decimale, '.', '');
        return floatval($number);
    }

    /* Number To Words Function  */
    public static function subNumberToWords($number) {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(         
            0   => '',
            1   => 'Un',
            2   => 'Deux',
            3   => 'Trois',
            4   => 'Quatre',
            5   => 'Cinq',
            6   => 'Six',
            7   => 'Sept',
            8   => 'Huit',
            9   => 'Neuf',
            10  => 'Dix',
            11  => 'Onze',
            12  => 'Douze',
            13  => 'Treize',
            14  => 'Quatorze',
            15  => 'Quinze',
            16  => 'Seize',
            17  => 'Dix-sept',
            18  => 'Dix-huit',
            19  => 'Dix-neuf',
            20  => 'Vingt',
            30  => 'Trente',
            40  => 'Quarante',
            50  => 'Cinquante',
            60  => 'Soixante',
            70  => 'Soixante-dix',
            80  => 'Quatre-vingt',
            90  => 'Quatre-vingt-dix',
        );

        $digits = array('', 'Cent','Mille','Lakhs', 'Crores');

        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? '' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        return $Rupees;
    }

    /* Number To Words Function  */
    public static function numberToWords($number) {

        $Rupees = '';

        if( $number < 0 ){
            $number *= -1;
            $Rupees .= "Moins ";
        }

        $decimal = round($number - ($no = floor($number)), 2) * 100;

        $Rupees .= self::subNumberToWords($number);
        $paise = '';

        if( $decimal > 0 ){
            $paise = ' et '. self::subNumberToWords($decimal). 'centimes';
        }

        $Rupees .= ' Dirhams' . $paise;

        $Rupees = str_replace('Un Mille', 'Mille', $Rupees);
        $Rupees = str_replace('Un Cent', 'Cent', $Rupees);
        $Rupees = preg_replace('/\s+/', ' ',$Rupees);

        return $Rupees;
    }

    public static function refgenerate($from=0, $field='reference', $prefix=null){

        if( $from == 0 ){
            $from = self::where('created_at','like',date('Y-m-d').'%')->count();
        }

		$from = $from +1;

        if( $prefix == null )
            $prefix = date('ymd');
		
		$ref = $prefix . str_pad($from, 3, '0', STR_PAD_LEFT);

		$ref_check = self::where($field,$ref)->first();

		if($ref_check && $ref_check->id){
			return 	self::refgenerate($from, $field, $prefix);
		}

		return $ref;
	}

}