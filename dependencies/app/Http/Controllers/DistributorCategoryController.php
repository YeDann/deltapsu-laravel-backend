<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use Validator;

class DistributorCategoryController extends Controller
{
    /**
     * 五類經銷商分類共用一個 controller，以 $type 區分對應的資料表。
     * 分類定義（label / field / pivot）集中於 config/distributor.php。
     * 結構：{table}（id, slug, status, order_seq）+ {table}_translation（fk_id, name, local）。
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    private function guard($type)
    {
        abort_unless(config("distributor.categories.{$type}"), 404);
    }

    /** 經銷商地區（continents type_id=2），供 Sales Territory 綁定所屬地區。 */
    private function continents()
    {
        return DB::table('continents as c')
            ->join('continents_translations as t', 't.cont_id', '=', 'c.id')
            ->where('c.type_id', 2)->where('t.local', 'en')
            ->orderBy('c.order_seq')
            ->select('c.id', 't.name')
            ->get();
    }

    public function index($type)
    {
        $this->guard($type);
        $contents = DB::table($type . ' as c')
            ->join($type . '_translation as t', 't.fk_id', '=', 'c.id')
            ->where('t.local', 'en')
            ->select('c.*', 't.name')
            ->orderBy('c.order_seq', 'asc')
            ->get();

        return view('distributor-category.index')
            ->with('name', 'contact_us')
            ->with('menu', 'distributor_filter')
            ->with('submenu', 'distcat_' . $type)
            ->with('type', $type)
            ->with('typeLabel', config("distributor.categories.{$type}.label"))
            ->with('continents', $this->continents()->keyBy('id'))
            ->with('contents', $contents);
    }

    public function create($type)
    {
        $this->guard($type);
        return view('distributor-category.create')
            ->with('name', 'contact_us')
            ->with('menu', 'distributor_filter')
            ->with('submenu', 'distcat_' . $type)
            ->with('type', $type)
            ->with('typeLabel', config("distributor.categories.{$type}.label"))
            ->with('continents', $this->continents());
    }

    public function store(Request $request, $type)
    {
        $this->guard($type);
        $validate = Validator::make($request->all(), ['name' => 'required']);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        $name = $request->name;
        $slug = Str::slug($name) ?: Str::slug($type . '-' . uniqid());
        $order = (int) DB::table($type)->max('order_seq') + 1;

        $data = [
            'slug' => $slug,
            'status' => 1,
            'order_seq' => $order,
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
        ];
        if ($type === 'distributor_sales_territory') {
            $data['continent_id'] = $request->continent_id ?: null;
        }
        $id = DB::table($type)->insertGetId($data);

        foreach (DB::table('language')->get() as $lang) {
            DB::table($type . '_translation')->insert([
                'fk_id' => $id,
                'name' => $name,
                'local' => $lang->name,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        return redirect()->route('distributorCategory.index', $type)->with('flash_message', 'Insert Data successfully');
    }

    public function edit($type, $id)
    {
        $this->guard($type);
        $contents = DB::table($type . ' as c')
            ->where('c.id', $id)
            ->leftJoin($type . '_translation as t', 't.fk_id', '=', 'c.id')
            ->select('c.*', 't.name', 't.local')
            ->get();

        return view('distributor-category.edit')
            ->with('name', 'contact_us')
            ->with('menu', 'distributor_filter')
            ->with('submenu', 'distcat_' . $type)
            ->with('type', $type)
            ->with('typeLabel', config("distributor.categories.{$type}.label"))
            ->with('continents', $this->continents())
            ->with('language', DB::table('language')->get())
            ->with('contents', $contents);
    }

    public function update(Request $request)
    {
        $type = $request->type;
        $this->guard($type);
        $validate = Validator::make($request->all(), ['name' => 'required']);
        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate->errors());
        }

        $id = $request->type_id;
        $names = $request->name; // name[local]

        $upd = [
            'status' => $request->status,
            'order_seq' => $request->order_seq,
            'updated_at' => \Carbon\Carbon::now(),
        ];
        if ($type === 'distributor_sales_territory') {
            $upd['continent_id'] = $request->continent_id ?: null;
        }
        DB::table($type)->where('id', $id)->update($upd);

        foreach ((array) $request->langloop as $local) {
            $exists = DB::table($type . '_translation')->where('fk_id', $id)->where('local', $local)->exists();
            if ($exists) {
                DB::table($type . '_translation')->where('fk_id', $id)->where('local', $local)
                    ->update(['name' => $names[$local] ?? '', 'updated_at' => \Carbon\Carbon::now()]);
            } else {
                DB::table($type . '_translation')->insert([
                    'fk_id' => $id, 'name' => $names[$local] ?? '', 'local' => $local,
                    'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now(),
                ]);
            }
        }

        return redirect()->route('distributorCategory.index', $type)->with('flash_message', 'Update Data successfully');
    }

    public function destroy($type, $id)
    {
        $this->guard($type);
        DB::table($type)->where('id', $id)->delete();
        DB::table($type . '_translation')->where('fk_id', $id)->delete();
        // 一併移除經銷商關聯，避免孤兒資料
        DB::table(config("distributor.categories.{$type}.pivot"))->where('category_id', $id)->delete();
        return back()->with('flash_message', 'Delete Data successfully');
    }
}
