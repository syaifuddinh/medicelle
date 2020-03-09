<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $appends = ['content'];

    public function getContentAttribute() {
        if(array_key_exists('content', $this->attributes)) {
            $content = json_decode($this->attributes['content']);
            $has_logo = $content->logo ?? null;
            if($has_logo) {
                $content->logo = isset($content->logo) ? asset('files/' . $content->logo) : asset('');
            }
            $has_logo2 = $content->logo2 ?? null;
            if($has_logo2) {
                $content->logo2 = isset($content->logo2) ? asset('files/' . $content->logo2) : asset('');
            }
            return $content;
        }
        return json_decode('{}');
    }

}
