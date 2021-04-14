<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class AddNewComment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'comment:create {id} {comment}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create/Add a new comment for an user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if (!$user = User::find($this->argument('id'))) {
            $this->error('Invalid user id provided');
            return;
        }
        $comment = $this->argument('comment');
        if (!$comment || $comment == "") {
            $this->error('Comment can\'t be empty');
            return;
        }
        $user->comments .= "\n" . $comment;
        $user->save();

        $this->info('Comment created');
        return 1;
    }
}
