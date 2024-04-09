<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use App\Models\Improvement;
use Illuminate\Http\JsonResponse;

class ImprovementController extends Controller
{
  public function index(): JsonResponse
  {
    $categories = Improvement::all();
    return response()->json($categories);
  }

  public function delete($id)
  {
    try {
      $improvement = Improvement::findOrFail($id);
      $improvement->delete();
      return response()->json(['message' => 'Предложение успешно удалено']);
    } catch (Exception) {
      return response()->json(['error' => 'Не удалось удалить предложение'], 500);
    }
  }
}