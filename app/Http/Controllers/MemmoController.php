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
            $m = Config::keyValue('share_code', $shareCode)->firstOrFail()->configurable;
            return $m && $m->is_shared ? $m : null;
        });

        return $memmo ? view('show-public', ['memmo' => $memmo]) : abort(404);
    }
}
