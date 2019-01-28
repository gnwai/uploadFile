<?php

namespace Wubuze\UploadFile\Model\File;



trait FileGroupRelation
{

	public function fileGroup ()
	{
		$qry = $this->hasMany('App\Model\File\FileGroup', 'id', 'id');
		if ( $qry ) {
//			return $qry->where('model', Base::getClassName());
		}
	}

}
