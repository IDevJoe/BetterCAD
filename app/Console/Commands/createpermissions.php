<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class createpermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permissions:autoseed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates standard permissions for BetterCAD';

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
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (User::AVAILABLE_PERMISSIONS as $perm) {
            if (Permission::where('name', $perm)->first() == null) {
                Permission::create(['name' => $perm]);
            }
        }
        return 0;
    }
}
