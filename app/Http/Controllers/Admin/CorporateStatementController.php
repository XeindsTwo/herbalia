<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CorporateStatement;
use Exception;

class CorporateStatementController extends Controller
{
  public function index()
  {
    $statements = CorporateStatement::all();
    return response()->json($statements);
  }

  public function destroy($id)
  {
    try {
      $statement = CorporateStatement::findOrFail($id);
      $statement->delete();
      return response()->json(['message' => 'Заявление успешно удалено']);
    } catch (Exception) {
      return response()->json(['error' => 'Произошла ошибка при удалении заявления'], 500);
    }
  }
}