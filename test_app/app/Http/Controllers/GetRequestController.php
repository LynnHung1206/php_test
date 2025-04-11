<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetRequestController extends Controller
{
    /**
     * DI
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
    }

    /**
     * 提供 global function
     * @return void
     */
    function helperFunc(): void
    {
        $request = request();
    }

    /**
     * 直接獲取實例 強耦合
     * 但可能取到錯的東西 應避免使用
     * @return void
     */
    function getInstance(): void
    {
        $request = (new \Illuminate\Http\Request)->instance();
    }


}
