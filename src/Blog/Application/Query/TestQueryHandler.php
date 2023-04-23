<?php

namespace Blog\Application\Query;

use Common\Application\Query;

class TestQueryHandler
{

    public function __invoke(TestQuery $query)
    {
        dd("HOLa");
    }

}