<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Story extends Model
{
    use HasFactory;
    protected $table = 'story';
    protected $primaryKey ='story_id';
    protected $fillable =[
        'author_id',
        'type_id',
        'name',
        'thumbnail',
        'coin',
        'isActive',
    ];

    public function Author(): BelongsTo{ //one story belongs to one author
        return $this->belongsTo(Author::class, 'author_id'); //for default, it's author_id , but I still write for clearance
    }

    public function Type(): BelongsTo{
        return $this->belongsTo(Type::class, 'type_id');//for default, it's author_id , but I still write for clearance
    }

    public function Page(): HasMany{ // one story has many pages
        return $this->hasMany(Page::class,'story_id');//for default, it's author_id , but I still write for clearance
    }
}
