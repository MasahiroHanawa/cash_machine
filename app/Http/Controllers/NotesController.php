<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\NotesService;

class NotesController extends Controller
{
    /**
     * Create a new service instance.
     *
     * @return void
     */
    public function __construct(NotesService $notesService)
    {
        $this->notesService = $notesService;
    }

    public function withdrawNotes (Request $request)
    {
        $result = $this->notesService->calculateNotes($request->input('notes'));
        return response()->json($result);
    }
}