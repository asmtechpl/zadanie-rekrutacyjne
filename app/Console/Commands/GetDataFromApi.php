<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;

/**
 * Class GetDataFromApi
 * @package App\Console\Commands
 */
class GetDataFromApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get users and posts data from API';

    /**
     * @var string
     */
    private $urlUsers = 'https://jsonplaceholder.typicode.com/users';

    /**
     * @var string
     */
    private $urlPosts = 'https://jsonplaceholder.typicode.com/posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        if($this->createOrUpdateUser())
            $this->info('Create/Update users success!');
        else
            $this->error('Create/Update users error');

        if($this->createOrUpdatePost())
            $this->info('Create/Update posts success!');
        else
            $this->error('Create/Update posts error');
    }

    /**
     * @return bool
     */
    private function createOrUpdateUser(): bool
    {
        $error = 0;
        foreach (json_decode(Http::acceptJson()->get($this->urlUsers)->body(), true) as $value) {

            try {
                $user = User::findOrFail($value['id']);
                $user->address
                    ->geo()
                    ->update($value['address']['geo']);
                unset($value['address']['geo']);
                $user->address()
                    ->update($value['address']);

                $user->company()
                    ->update($value['company']);
                if ($user->update($value) === 0)
                    $error++;
            } catch (ModelNotFoundException $exception) {
                $user = new User($value);
                $address = $user->address()
                    ->create($value['address'])
                    ->geo()
                    ->create($value['address']['geo']);
                $company = $user->company()->create($value['company']);
                $user->companyId = $company->id;
                $user->addressId = $address->id;
                if (!$user->save())
                    $error++;
            }
        }

        if ($error === 0)
            return true;

        return false;
    }

    /**
     * @return bool
     */
    private function createOrUpdatePost(): bool
    {
        $error = 0;
        foreach (json_decode(Http::acceptJson()->get($this->urlPosts)->body(), true) as $value) {

            try {
                $post = Post::findOrFail($value['id']);
                if ($post->update($value) === 0)
                    $error++;
            } catch (ModelNotFoundException $exception) {
                $post = new Post($value);
                if (!$post->save())
                    $error++;
            }
        }

        if ($error === 0)
            return true;

        return false;
    }
}
