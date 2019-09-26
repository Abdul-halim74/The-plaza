<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
	function relationTocart(){
		return $this->hasOne('App\Product', 'id', 'product_id');
	}
}
