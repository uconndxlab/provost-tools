<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use App\Models\InstitutionalPriority;

class CreateTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pt:tag:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new tag.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Create or find the tag
        $tag = Tag::firstOrCreate(['name' => $name]);

        $tag->save();


        $this->info("Tag '{$tag->name}' successfully created!");
        return 0;
    }
}
