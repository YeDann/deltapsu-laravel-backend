<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPropertyTranslation extends Model
{

        /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product_has_property_translation';
    protected $fillable = [
        'per_fk_id','product_id','value_text','local','updated_at','created_at'
    ];
}

