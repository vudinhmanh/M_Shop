<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\PostCatalogue;
class PostCatalogueChildrenRule implements ValidationRule
{
    protected $id;
    public function __construct($id){
        $this->id = $id;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $flag = PostCatalogue::isNodeCheck($this->id);
        if($flag == false){
            $fail('Không thể xoá do vẫn còn danh mục con');
        }
    }
}
