<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = "media";
    protected $auditableEvents = [];
    public $_name;
    public $_reference;
    public $_mime_type;
    public $_size;
    public $_file;
    public $_disk = 'public';
    public $_path = '';

    public $fillable = ['name', 'reference', 'mime_type', 'size'];


    public function _save()
    {
        if (!$this->_file) {
            if ($this->id && $this->_name) {
                $this->name = ($this->_name) ? $this->_name : $this->_file->getClientOriginalName();
                $this->size = $this->size;
                $this->reference = $this->reference;
                $this->mime_type = $this->mime_type;
            } else {
                return;
            }
        } else {

            if ($this->reference)
                Storage::disk('public')->delete($this->reference);

            $reference = Storage::disk($this->_disk)->put($this->_path . '/' . date('m-Y'), $this->_file);
            $this->name = ($this->_name) ? $this->_name : $this->_file->getClientOriginalName();
            $this->size = ($this->_size) ? $this->_size : $this->_file->getSize();
            $this->reference = ($this->_reference) ? $this->_reference : $reference;
            $this->mime_type = ($this->_mime_type) ? $this->_mime_type : $this->_file->getMimeType();
        }

        if ($this->id) {
            $this->save();
            return $this;
        } else {
            return Media::create([
                'name' => $this->name,
                'reference' => $this->reference,
                'size' => $this->size,
                'mime_type' => $this->mime_type
            ]);
        }
    }

    public function delete()
    {
        if ($this->reference)
            Storage::disk('public')->delete($this->reference);

        parent::delete();
    }

    public function buttons()
    {
        $mimes_types = [
            'image/png',
            'image/jpeg',
            'image/gif',
            'image/bmp',
            'image/svg+xml',
            'application/pdf',
            'application/vnd.ms-excel',
        ];

        $url = asset("storage/" . $this->reference);
        $html = '';
        if (in_array($this->mime_type, $mimes_types)) {
            $html = "<a class='apercu_btn' target='_blank' href='" . $url . "'><button type='button' class='btn green start'><i class='fa fa-eye'></i></button></a>";
        }

        $html .= "<a href='" . $url . "' target='_blank'><button type='button' download='" . $this->name . "' class='btn blue start'><i class='fa fa-download'></i></button></a>";

        return $html;
    }

    public function picture($w=40,$h=40){
        $src = $this->link();
        return '<a href="'.$src.'" target="_blank"><img class="img-xs" style="width: '.$w.'px;height: '.$h.'px;" src="'.$src.'"></a>';
    }

    public function link(){
        return asset('storage/'.$this->reference);
    }
}
