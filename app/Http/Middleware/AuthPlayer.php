<?php

namespace App\Http\Middleware;

use App\Contracts\GameContract;
use App\Contracts\PlayerRepositoryContract;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class AuthPlayer
{

    public function __construct(
        private readonly PlayerRepositoryContract $playerRepository,
        private readonly GameContract $gameContract
    )
    {

    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('authorization');
        $token = Str::replaceStart('Bearer ', '', $header);
        $player = $this->playerRepository->findByToken($token);

        if ($player === null) {
            abort(403);
        }

        $this->gameContract->setPlayer($player);

        return $next($request);
    }
}
