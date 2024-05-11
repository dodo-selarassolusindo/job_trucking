<?php

namespace PHPMaker2024\prj_job_trucking;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use PHPMaker2024\prj_job_trucking\Attributes\Delete;
use PHPMaker2024\prj_job_trucking\Attributes\Get;
use PHPMaker2024\prj_job_trucking\Attributes\Map;
use PHPMaker2024\prj_job_trucking\Attributes\Options;
use PHPMaker2024\prj_job_trucking\Attributes\Patch;
use PHPMaker2024\prj_job_trucking\Attributes\Post;
use PHPMaker2024\prj_job_trucking\Attributes\Put;

class TypeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/typelist[/{TypeID}]", [PermissionMiddleware::class], "list.type")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TypeList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/typeadd[/{TypeID}]", [PermissionMiddleware::class], "add.type")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TypeAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/typeview[/{TypeID}]", [PermissionMiddleware::class], "view.type")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TypeView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/typeedit[/{TypeID}]", [PermissionMiddleware::class], "edit.type")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TypeEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/typedelete[/{TypeID}]", [PermissionMiddleware::class], "delete.type")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TypeDelete");
    }
}
