<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Http\Requests\ProjectRequest;

/**
 * @OA\Tag(name="Projects", description="Endpoints relacionados aos projetos")
 */
class ProjectController extends Controller
{
    protected $projectService;

    public function __construct(ProjectService $projectService) {
        $this->projectService = $projectService;
    }

    /**
     * @OA\Get(
     *     path="/api/projects",
     *     tags={"Projects"},
     *     summary="Listar todos os projetos",
     *     @OA\Response(response="200", description="Lista de projetos retornada com sucesso"),
     * )
     */
    public function index() {
        return response()->json($this->projectService->getAllProjects());
    }

    /**
     * @OA\Post(
     *     path="/api/projects",
     *     tags={"Projects"},
     *     summary="Criar um novo projeto",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description"},
     *             @OA\Property(property="name", type="string", example="Novo Projeto"),
     *             @OA\Property(property="description", type="string", example="Descrição do novo projeto")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Projeto criado com sucesso"),
     *     @OA\Response(response="422", description="Erro de validação"),
     * )
     */
    public function store(ProjectRequest $request) {
        $project = $this->projectService->createProject($request->validated());
        return response()->json($project, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/projects/{id}",
     *     tags={"Projects"},
     *     summary="Mostrar um projeto específico",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do projeto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Projeto retornado com sucesso"),
     *     @OA\Response(response="404", description="Projeto não encontrado"),
     * )
     */
    public function show($id) {
        return response()->json($this->projectService->getProjectById($id));
    }

    /**
     * @OA\Put(
     *     path="/api/projects/{id}",
     *     tags={"Projects"},
     *     summary="Atualizar um projeto existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do projeto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description"},
     *             @OA\Property(property="name", type="string", example="Projeto Atualizado"),
     *             @OA\Property(property="description", type="string", example="Descrição atualizada do projeto")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Projeto atualizado com sucesso"),
     *     @OA\Response(response="404", description="Projeto não encontrado"),
     *     @OA\Response(response="422", description="Erro de validação"),
     * )
     */
    public function update(ProjectRequest $request, $id) {
        $project = $this->projectService->updateProject($id, $request->validated());
        return response()->json($project);
    }

    /**
     * @OA\Delete(
     *     path="/api/projects/{id}",
     *     tags={"Projects"},
     *     summary="Deletar um projeto existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID do projeto",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Projeto deletado com sucesso"),
     *     @OA\Response(response="404", description="Projeto não encontrado"),
     * )
     */
    public function destroy($id) {
        $this->projectService->deleteProject($id);
        return response()->json(null, 204);
    }
}
