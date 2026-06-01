<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistributorContinentNameSeeder extends Seeder
{
    /**
     * Normalize the Distributors (type_id=2) Taiwan tab label to "Taiwan"
     * for en / de / tr (was "Taiwan Region" / empty). Idempotent.
     *
     * @return void
     */
    public function run()
    {
        $cid = DB::table('continents as c')
            ->join('continents_translations as t', 't.cont_id', '=', 'c.id')
            ->where('c.type_id', 2)
            ->where('t.local', 'en')
            ->whereIn('t.name', ['Taiwan Region', 'Taiwan'])
            ->value('c.id');

        if (!$cid) {
            echo "Taiwan distributor continent not found, skip\n";
            return;
        }

        foreach (['en', 'de', 'tr'] as $local) {
            $exists = DB::table('continents_translations')->where('cont_id', $cid)->where('local', $local)->exists();
            if ($exists) {
                DB::table('continents_translations')->where('cont_id', $cid)->where('local', $local)->update(['name' => 'Taiwan']);
            } else {
                DB::table('continents_translations')->insert(['cont_id' => $cid, 'local' => $local, 'name' => 'Taiwan']);
            }
        }
        echo "Set Taiwan continent (id={$cid}) name to 'Taiwan' for en/de/tr\n";
    }
}
