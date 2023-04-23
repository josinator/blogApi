<?php

declare(strict_types=1);

namespace Common\Infrastructure\Application;


use Common\Application\Query;
use Common\Application\QueryBus;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class SymfonyMessengerQueryBus implements QueryBus
{
    use HandleTrait { handle as private handleQuery; }

    public function __construct(
        MessageBusInterface $queryBus
    ) {
        $this->messageBus = $queryBus;
    }

    public function handle(Query $query)
    {
        return $this->handleQuery($query);
    }
}
