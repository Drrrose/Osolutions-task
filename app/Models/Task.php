<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\TaskPriority;

class Task extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'priority',
        'category_id',
        'due_date',
        'completed',
        'image_url',
    ];

    protected $casts = [
        'due_date' => 'date',
        'completed' => 'boolean',
        'priority' => TaskPriority::class,
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    protected static function booted()
    {
        static::creating(function (Task $task) {
            if (empty($task->image_url)) {
                $task->image_url = 'https://picsum.photos/seed/' . str()->random(8) . '/400/300';
            }
        });
    }


    public function scopeFilter($query, array $filters)
    {
        $map = [
            'category_id' => 'category_id',
            'completed'   => 'completed',
            'priority'    => 'priority',
        ];

        foreach ($map as $key => $column) {
            if (array_key_exists($key, $filters) && $filters[$key] !== null) {
                $query->where($column, $filters[$key]);
            }
        }

        return $query;
    }

}
