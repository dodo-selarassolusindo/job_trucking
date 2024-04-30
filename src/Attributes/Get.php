<?php

namespace PHPMaker2024\prj_job_trucking\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_METHOD | Attribute::IS_REPEATABLE)]
class Get extends Map
{
    /**
     * Constructor
     *
     * @param mixed $args
     */
    public function __construct(...$args)
    {
        parent::__construct("GET", ...$args);
    }
}