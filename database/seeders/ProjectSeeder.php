<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = new Project;
        $project->title = 'js-campominato-grid';
        $project->slug = Str::slug($project->title);
        $project->description = 'Rappresentazione del mitico gioco Campo Minato, creato usando html, css e javascript.';
        $project->github_url = 'https://github.com/GrPaladino/js-campominato-grid';
        $project->image_preview = 'https://picsum.photos/200/300';
        $project->save();
    }
}
