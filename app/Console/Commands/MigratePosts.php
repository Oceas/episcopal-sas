<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Post;
use Carbon\Carbon;

class MigratePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and migrate posts from external WordPress site';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Define the URL to fetch the posts
        $url = 'https://myepiscopal.com/wp-json/myepiscopal/posts';

        // Fetch the posts using Laravel's HTTP client
        $response = Http::get($url);

        // Check if the request was successful
        if ($response->successful()) {
            // Decode the JSON response to an array
            $posts = $response->json();

            // Process each post
            foreach ($posts as $post) {
                // Check if a post with the same wp_post_id already exists
                $existingPost = Post::where('wp_post_id', $post['id'])->first();

                // Convert the post date to a SQL-compatible datetime format with time set to 8:00 AM
                $publishDate = Carbon::createFromFormat('F j, Y', $post['date'])->setTime(8, 0, 0);

                if ($existingPost) {
                    // Update the existing post
                    $existingPost->update([
                        'title' => $post['title'],
                        'slug' => $post['link'] ?? null, // Assuming the slug might not be provided
                        'excerpt' => $post['excerpt'] ?? null,
                        'content' => $post['content'] ?? null,
                        'publish_date' => $publishDate, // Use the formatted publish date
                        'author_name' => $post['author'] ?? 'anonymous',
                        'featured_image' => $post['featured_image'] ?? null,
                    ]);

                    $this->info('Updated post: ' . $existingPost->title);
                } else {
                    // Create a new post
                    Post::create([
                        'uuid' => (string) \Str::uuid(), // Generating a UUID for the new post
                        'wp_post_id' => $post['id'],
                        'title' => $post['title'],
                        'slug' => $post['link'] ?? null,
                        'excerpt' => $post['excerpt'] ?? null,
                        'content' => $post['content'] ?? null,
                        'publish_date' => $publishDate, // Use the formatted publish date
                        'author_name' => $post['author'] ?? 'anonymous',
                        'featured_image' => $post['featured_image'] ?? null,
                    ]);

                    $this->info('Created new post: ' . $post['title']);
                }
            }
        } else {
            // Log the error if the request fails
            $this->error('Failed to fetch posts from ' . $url);
        }
    }
}
