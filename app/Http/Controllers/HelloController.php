<?php

namespace App\Http\Controllers;

use App\Attribute\Loggable;
use App\Domain\Double\DoubleInterface;
use App\Http\Requests\GetHelloRequest;
use Illuminate\Database\DatabaseManager;
use Ray\Di\Di\Inject;
use Ray\Di\Di\PostConstruct;
use Ray\Di\Di\Set;
use Ray\Di\ProviderInterface;
use Ray\RayDiForLaravel\Attribute\Injectable;

#[Injectable]
class HelloController extends Controller
{
    private ProviderInterface $doubleProvider;

    public function __construct(
        // Inject dependency
        private readonly DoubleInterface $double,
        private readonly DatabaseManager $databaseManager
    ){}

    #[Inject]
    public function setFooProvider(
        #[Set(DoubleInterface::class)] ProviderInterface $provider
    ) {
        // Inject lazy dependency
        $this->doubleProvider = $provider;
    }

    #[PostConstruct]
    public function init()
    {
        // Initialize method after all dependencies injected
        $double1 = $this->doubleProvider->get();
        assert($double1 instanceof DoubleInterface);
    }

    #[Loggable] // AOP
    public function index(GetHelloRequest $request)
    {
        return view('hello', [
            'i' => $this->double->double(1),
            'dbname' => $this->databaseManager->getDatabaseName(),
        ]);
    }
}
