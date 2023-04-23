<?php

namespace Common\Application;

interface QueryBus
{
    public function handle(Query $query);

}