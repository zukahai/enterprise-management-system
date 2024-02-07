<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class TruncateAllTables extends Command
{
    protected $signature = 'truncate:all';

    protected $description = 'Truncate all tables';

    public function handle()
    {
        $tables = DB::select('SHOW TABLES');
        
        // Tạm thời tắt kiểm tra ràng buộc khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach($tables as $table) {
            $table_array = get_object_vars($table);
            $table_name = $table_array[key($table_array)];

            DB::table($table_name)->truncate();
        }

        // Bật lại kiểm tra ràng buộc khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->info('All tables truncated successfully.');
    }
}
