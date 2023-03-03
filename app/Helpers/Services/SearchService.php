<?php

namespace App\Helpers\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SearchService
{
    public function search($table, Request $request)
    {
        $search_columns = $this->get_search_columns($table);
        $data = DB::table($table);
        if ($request->search != '') {
            foreach ($search_columns as $key => $search_column) {
                if ($key == 1) $data = $data->where($search_column, 'like', '%' . $request->search . '%');
                else $data = $data->orWhere($search_column, 'like', '%' . $request->search . '%');
            }
        }

        return $data->get();
    }

    public function get_search_columns(string $table)
    {
        return Arr::where(Schema::getColumnListing($table), function ($value, $key) use ($table) {
            return Schema::getColumnType($table, $value) == 'string';
        });
    }
}
