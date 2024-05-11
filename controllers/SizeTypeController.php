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

class SizeTypeController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/sizetypelist[/{Size_Type_ID}]", [PermissionMiddleware::class], "list.size_type")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeTypeList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/sizetypeadd[/{Size_Type_ID}]", [PermissionMiddleware::class], "add.size_type")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeTypeAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/sizetypeview[/{Size_Type_ID}]", [PermissionMiddleware::class], "view.size_type")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeTypeView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/sizetypeedit[/{Size_Type_ID}]", [PermissionMiddleware::class], "edit.size_type")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeTypeEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/sizetypedelete[/{Size_Type_ID}]", [PermissionMiddleware::class], "delete.size_type")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "SizeTypeDelete");
    }
}
