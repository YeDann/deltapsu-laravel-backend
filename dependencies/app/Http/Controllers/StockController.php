<?php

namespace App\Http\Controllers;

use App\Services\Dilp\DilpClient;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * 經銷商庫存查詢端點（前台 Stock 按鈕 AJAX 入口）。
 * 薄控制器：驗料號 → 委派 DilpClient → 回 JSON；任何失敗回 {ok:false} 讓前台優雅顯示。
 */
class StockController extends Controller
{
    public function check(Request $request, DilpClient $dilp): JsonResponse
    {
        $code = trim((string) $request->query('code', ''));

        if ($code === '') {
            return response()->json(['ok' => false, 'rows' => []]);
        }

        try {
            $rows = $dilp->search($code, $request->ip());

            return response()->json(['ok' => true, 'rows' => $rows]);
        } catch (Throwable $e) {
            Log::warning('Stock check failed', ['code' => $code, 'error' => $e->getMessage()]);

            return response()->json(['ok' => false, 'rows' => []]);
        }
    }

    /**
     * 取得經銷商聯絡 email（前台「無購物車連結」時 mailto 用）；查無或失敗回 {ok:false}。
     */
    public function contact(Request $request, DilpClient $dilp): JsonResponse
    {
        $id = trim((string) $request->query('id', ''));

        if ($id === '') {
            return response()->json(['ok' => false]);
        }

        try {
            $email = $dilp->distributorEmail($id, $request->ip());

            return response()->json(['ok' => true, 'email' => $email]);
        } catch (Throwable $e) {
            Log::warning('Stock contact failed', ['id' => $id, 'error' => $e->getMessage()]);

            return response()->json(['ok' => false]);
        }
    }
}
