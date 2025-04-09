<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document::with('docType')->paginate(20);
        return inertia('documents/DocumentsIndex', [
            'documents' => $documents,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDocumentRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('documents', 'public'); // Save in storage/app/public/documents
            $data['filepdf'] = $filePath;
        }

        $document = Document::create([
            'marka' => $data['marka'],
            'doc_type_id' => $data['doctype'],
            'tip' => $data['tip'],
            'varijanta' => $data['varijanta'],
            'filepdf' => $data['filepdf'] ?? null,
            'user_id' => $data['user_id']
        ]);

        return redirect()->route('documents.index')->with('success', 'Записот е успешно креиран');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Document $document)
    {
        //
    }
}
