<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tag;
use App\Models\InstitutionalPriority;

class RemoveTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pt:tag:remove';

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
        // Display a list of all tags and their IDs
        $tags = Tag::all(['id', 'name']);
        $this->info('Available tags:');
        foreach ($tags as $tag) {
            $this->info("ID: {$tag->id}, Name: {$tag->name}");
        }

        // Ask the user which ID to remove
        $id = $this->ask('Enter the ID of the tag to remove');

        // Find the tag by ID
        $tag = Tag::find($id);

        if ($tag) {
            $tag->delete();
            $this->info("Tag '{$tag->name}' successfully removed!");
        } else {
            $this->error('Tag not found.');
        }

        return 0;
    }
}
