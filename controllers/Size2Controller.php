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

class Size2Controller extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/size2list[/{SizeID}]", [PermissionMiddleware::class], "list.size2")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size2List");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/size2add[/{SizeID}]", [PermissionMiddleware::class], "add.size2")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size2Add");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/size2view[/{SizeID}]", [PermissionMiddleware::class], "view.size2")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size2View");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/size2edit[/{SizeID}]", [PermissionMiddleware::class], "edit.size2")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size2Edit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/size2delete[/{SizeID}]", [PermissionMiddleware::class], "delete.size2")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "Size2Delete");
    }
}
