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

class TakenByController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/takenbylist[/{TakenByID}]", [PermissionMiddleware::class], "list.taken_by")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TakenByList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/takenbyadd[/{TakenByID}]", [PermissionMiddleware::class], "add.taken_by")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TakenByAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/takenbyview[/{TakenByID}]", [PermissionMiddleware::class], "view.taken_by")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TakenByView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/takenbyedit[/{TakenByID}]", [PermissionMiddleware::class], "edit.taken_by")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TakenByEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/takenbydelete[/{TakenByID}]", [PermissionMiddleware::class], "delete.taken_by")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "TakenByDelete");
    }
}
