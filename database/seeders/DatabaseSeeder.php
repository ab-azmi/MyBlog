<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        \App\Models\User::truncate();
        \App\Models\Role::truncate();
        \App\Models\Category::truncate();
        \App\Models\Post::truncate();
        \App\Models\Tag::truncate();
        \App\Models\Comment::truncate();
        \App\Models\Image::truncate();
        \App\Models\Permission::truncate();
        \App\Models\Abouts::truncate();
        Schema::enableForeignKeyConstraints();

        \App\Models\Role::factory(1)->create();
        \App\Models\Role::factory(1)->create(['name' => 'admin']);

        $blog_routes = Route::getRoutes();
        $permissions_ids = [];
        foreach($blog_routes as $route){
            if(strpos($route->getName(), 'admin') !== false){
                $permission = Permission::create(['name' => $route->getName()]);
                $permissions_ids[] = $permission->id;
            }
        }

        \App\Models\Role::where('name', 'admin')->first()->permissions()->sync($permissions_ids);

         $users = \App\Models\User::factory(10)->create();
            \App\Models\User::factory()->create([
            'name' => 'Azmi',
            'email' => 'azmi.kiva@gmail.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'role_id' => 2,
        ]);

         foreach($users as $user){
             $user->image()->save(\App\Models\Image::factory()->make());
         }

         \App\Models\Category::factory(10)->create();
        \App\Models\Category::factory()->create(['name' => 'uncategorized']);

        $posts = \App\Models\Post::factory(50)->create();

        \App\Models\Comment::factory(100)->create();

        \App\Models\Tag::factory(10)->create();

        foreach($posts as $post){
            $tags_ids = [];
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;
            $tags_ids[] = \App\Models\Tag::all()->random()->id;

            $post->tags()->sync($tags_ids);
            $post->image()->save(\App\Models\Image::factory()->make());
        }

        \App\Models\Abouts::factory(1)->create();
    }
}
