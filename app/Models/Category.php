<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory , Sluggable;

    protected $fillable = [
        'name','parent_id','image','status'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;
        $parents->push($this);

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function child()
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }

    public function children()
    {
        return $this->child()->with('children');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
