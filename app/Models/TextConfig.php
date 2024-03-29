<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TextConfig extends Model
{
    use HasFactory;
    protected $table = 'text_config';
    protected $primaryKey='id';
    protected $fillable = [
      'text_id',
      'page_id',
      'position',
    ];

    public function Text() :BelongsTo{
        return $this->belongsTo(Text::class, 'text_id');
    }

    public function Page() :BelongsTo{
        return $this->belongsTo(Page::class, 'page_id');
    }
}
