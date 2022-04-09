<?php

namespace App\Http\Middleware;

use App\Domain\Double\DoubleInterface;
use Closure;
use Illuminate\Http\Request;
use Ray\RayDiForLaravel\Attribute\Injectable;
use Symfony\Component\HttpFoundation\Response;

#[Injectable]
class HiMiddleware
{

    public function __construct(private readonly DoubleInterface $double)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);

        $doubled = $this->double->double(2);
        $response->setContent($response->getContent() . "<br> Hi {$doubled} from a middleware");

        return $response;
    }
}
