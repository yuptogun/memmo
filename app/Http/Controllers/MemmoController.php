<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

use App\Models\Memmo;
use App\Models\Config;

class MemmoController extends Controller
{
    public function index()
    {
        return view(Auth::check() ? 'memmo' : 'welcome');
    }

    public function showShared(string $shareCode)
    {
        $memmo = Cache::remember("memmos:share_code:$shareCode", 86400, fn() =>
            Config::whereHasMorph('configurable', [Memmo::class])
                ->keyValue('share_code', $shareCode)
                ->firstOrFail()
                ?->configurable
        );

        return $memmo->is_shared ? view('show-public', ['memmo' => $memmo]) : abort(404);
    }
}
