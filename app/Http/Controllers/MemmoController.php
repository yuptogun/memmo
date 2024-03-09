<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\Config;

class MemmoController extends Controller
{
    public function index()
    {
        return view(Auth::check() ? 'memmo' : 'welcome');
    }

    public function showShared(string $shareCode)
    {
        $memmo = Cache::remember("memmo:shared:$shareCode", 86400, function () use ($shareCode) {
            $memmo = Config::where(fn ($where) =>
                $where->where(fn ($w1) => $w1->keyValue('share_code_alias', $shareCode))
                    ->orWhere(fn ($w2) => $w2->keyValue('share_code', $shareCode))
            )->firstOrFail()->configurable;
            return $memmo && $memmo->is_shared ? $memmo : null;
        });

        return $memmo ? view('show-public', ['memmo' => $memmo]) : abort(404);
    }
}
