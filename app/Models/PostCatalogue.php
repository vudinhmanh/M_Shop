<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class PostCatalogue extends Model
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'parentid',
        'lft',
        'rgt',
        'level',
        'image',
        'icon',
        'album',
        'publish',
        'follow',
        'order',
        'user_id',
        'deleted_at',
    ];
    protected $table = 'post_catalogues';
    public function languages(){
        return $this->belongsToMany(Languages::class, 'post_catalogue_language' , 'post_catalogue_id', 'language_id')
        ->withPivot(
            'name',
            'canonical',
            'meta_title',
            'meta_keyword',
            'meta_description',
            'description',
            'content'
        )->withTimestamps();
    }
    public function post_catalogue_language(){
        return $this->hasMany(PostCatalogueLanguage::class,'post_catalogue_id','id');
    }
    public static function isNodeCheck($id = 0){
        $postCatalogue = PostCatalogue::find($id);
        if($postCatalogue->rgt - $postCatalogue->lft !==1){
            return false;
        }
        return true;
    }
}   
