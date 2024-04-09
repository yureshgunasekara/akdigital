<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\SavedDocument;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{
    // getting saved document list
    function index(Request $request)
    {
        try {
            $page = 10;
            $user = auth()->user();
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $documents = SavedDocument::orderBy('created_at', 'desc')
                    ->with('template')
                    ->paginate($page);
            } else {
                $documents = SavedDocument::orderBy('created_at', 'desc')
                    ->where('user_id', $user->id)
                    ->with('template')
                    ->paginate($page);
            }

            return Inertia::render('SavedDocuments/TemplateContents/Show', compact('documents'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // saved document update page
    function show($id)
    {
        try {
            $document = SavedDocument::where('id', $id)->first();
            return Inertia::render('SavedDocuments/TemplateContents/Update', compact('document'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // saved document update page
    function update(Request $request, $id): RedirectResponse
    {
        try {
            SavedDocument::where('id', $id)->update($request->all());
            return back()->with('success', 'Document successfully updated');
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    // saved document delete
    function delete($id): RedirectResponse
    {
        try {
            SavedDocument::where('id', $id)->delete();
            return back()->with('success', 'Document successfully deleted');
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }

    public function search(Request $request)
    {
        try {
            $page = 10;
            $user = auth()->user();
            $query = $request->value;
            if ($request->per_page) {
                $page = intval($request->per_page);
            }

            if ($user->role == 'admin') {
                $result = SavedDocument::where('document_name', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            } else {
                $result = SavedDocument::where('user_id', $user->id)
                    ->where('document_name', 'LIKE', '%' . $query . '%')
                    ->paginate($page);
            }

            return $result;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    // Export template list
    public function export()
    {
        $template = SavedDocument::join('templates', 'saved_documents.template_id', '=', 'templates.id')
            ->select('saved_documents.*', 'templates.title as template_title')
            ->get();

        $columns = Schema::getColumnListing((new SavedDocument())->getTable());
        array_push($columns, 'template_title');
        $headers = AppHelper::exportToCSV($template, $columns, 'template');

        return Response::make('', 200, $headers);
    }
}
