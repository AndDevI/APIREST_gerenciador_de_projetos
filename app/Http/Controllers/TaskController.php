<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use App\Http\Requests\TaskRequest;
use App\Models\Project;

/**
 * @OA\Tag(name="Tasks", description="Endpoints relacionados às tarefas")
 */
class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService) {
        $this->taskService = $taskService;
    }

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     tags={"Tasks"},
     *     summary="Listar todas as tarefas",
     *     @OA\Response(response="200", description="Lista de tarefas retornada com sucesso"),
     * )
     */
    public function index() {
        return response()->json($this->taskService->getAllTasks());
    }

    /**
     * @OA\Post(
     *     path="/api/projects/{project}/tasks",
     *     tags={"Tasks"},
     *     summary="Criar uma nova tarefa para um projeto específico",
     *     @OA\Parameter(
     *         name="project",
     *         in="path",
     *         required=true,
     *         description="ID do projeto ao qual a tarefa pertence",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Nova Tarefa"),
     *             @OA\Property(property="description", type="string", example="Descrição da nova tarefa")
     *         )
     *     ),
     *     @OA\Response(response="201", description="Tarefa criada com sucesso"),
     *     @OA\Response(response="422", description="Erro de validação"),
     * )
     */
    public function store(Project $project, TaskRequest $request) {
        $taskData = $request->validated();
        $taskData['project_id'] = $project->id;

        $task = $this->taskService->createTask($taskData);
        return response()->json($task, 201);
    }

    /**
     * @OA\Get(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Mostrar uma tarefa específica",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Tarefa retornada com sucesso"),
     *     @OA\Response(response="404", description="Tarefa não encontrada"),
     * )
     */
    public function show($id) {
        return response()->json($this->taskService->getTaskById($id));
    }

    /**
     * @OA\Put(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Atualizar uma tarefa existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "description"},
     *             @OA\Property(property="title", type="string", example="Tarefa Atualizada"),
     *             @OA\Property(property="description", type="string", example="Descrição atualizada da tarefa")
     *         )
     *     ),
     *     @OA\Response(response="200", description="Tarefa atualizada com sucesso"),
     *     @OA\Response(response="404", description="Tarefa não encontrada"),
     *     @OA\Response(response="422", description="Erro de validação"),
     * )
     */
    public function update(TaskRequest $request, $id) {
        $task = $this->taskService->updateTask($id, $request->validated());
        return response()->json($task);
    }

    /**
     * @OA\Delete(
     *     path="/api/tasks/{id}",
     *     tags={"Tasks"},
     *     summary="Deletar uma tarefa existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID da tarefa",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Tarefa deletada com sucesso"),
     *     @OA\Response(response="404", description="Tarefa não encontrada"),
     * )
     */
    public function destroy($id) {
        $this->taskService->deleteTask($id);
        return response()->json(null, 204);
    }
}
