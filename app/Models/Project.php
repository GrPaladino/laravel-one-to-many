<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'github_url', 'image_preview'];

    public function getAbstract($n_chars = 30)
    {
        return (strlen($this->description) > $n_chars) ? substr($this->description, 0, $n_chars) . '...' : $this->description;
    }
}
