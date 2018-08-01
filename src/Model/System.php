<?php

namespace UploadFile\Model;

class System extends \Illuminate\Database\Eloquent\Model
{

    protected $table = 'system';
    protected $guarded = [];
    public $timestamps = false;
    protected $primaryKey = '';
    public $incrementing = false;

    use \jdavidbakr\ReplaceableModel\ReplaceableModel;


    protected $casts = [
        'val' => 'array'
    ];
}
