<?php

namespace App\Http\Traits\Back;

use Illuminate\Http\Request;

trait FilterTrait
{
    /**
     * Фильтрует данные запроса
     * @param Request $request
     * @return array
     */

    public function filter(Request $request)
    {
        $where = [];
        if ($request->filter_like) {
            foreach ($request->filter_like as $k => $v) {
                if ($v) {
                    $where[] = [$k, 'like', '%' . $v . '%'];
                }
            }
        }
        if ($request->filter_same) {
            foreach ($request->filter_same as $k => $v) {
                if ($v || $v === '0') {
                    $where[] = [$k, '=', $v];
                }
            }
        }
        if ($request->filter_min) {
            foreach ($request->filter_min as $k => $v) {
                if ($v) {
                    $where[] = [$k, '>=', $v];
                }
            }
        }
        if ($request->filter_max) {
            foreach ($request->filter_max as $k => $v) {
                if ($v) {
                    $where[] = [$k, '<=', $v];
                }
            }
        }

        return $where;
    }
}
