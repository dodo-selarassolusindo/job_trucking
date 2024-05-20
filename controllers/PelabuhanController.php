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

class PelabuhanController extends ControllerBase
{
    // list
    #[Map(["GET","POST","OPTIONS"], "/pelabuhanlist[/{PelabuhanID}]", [PermissionMiddleware::class], "list.pelabuhan")]
    public function list(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PelabuhanList");
    }

    // add
    #[Map(["GET","POST","OPTIONS"], "/pelabuhanadd[/{PelabuhanID}]", [PermissionMiddleware::class], "add.pelabuhan")]
    public function add(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PelabuhanAdd");
    }

    // view
    #[Map(["GET","POST","OPTIONS"], "/pelabuhanview[/{PelabuhanID}]", [PermissionMiddleware::class], "view.pelabuhan")]
    public function view(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PelabuhanView");
    }

    // edit
    #[Map(["GET","POST","OPTIONS"], "/pelabuhanedit[/{PelabuhanID}]", [PermissionMiddleware::class], "edit.pelabuhan")]
    public function edit(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PelabuhanEdit");
    }

    // delete
    #[Map(["GET","POST","OPTIONS"], "/pelabuhandelete[/{PelabuhanID}]", [PermissionMiddleware::class], "delete.pelabuhan")]
    public function delete(Request $request, Response $response, array $args): Response
    {
        return $this->runPage($request, $response, $args, "PelabuhanDelete");
    }
}
