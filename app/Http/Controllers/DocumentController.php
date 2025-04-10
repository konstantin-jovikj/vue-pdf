<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $documents = Document::with('docType', 'fuel')->paginate(15);
    //     return inertia('documents/DocumentsIndex', [
    //         'documents' => $documents,
    //     ]);
    // }


    public function index(Request $request)
    {
        $query = Document::with('docType', 'fuel');

        if ($request->search_marka) {
            $query->where('marka', 'like', '%' . $request->search_marka . '%');
        }

        if ($request->search_tip) {
            $query->where('tip', 'like', '%' . $request->search_tip . '%');
        }

        if ($request->search_varijanta) {
            $query->where('varijanta', 'like', '%' . $request->search_varijanta . '%');
        }

        if ($request->search_izvedba) {
            $query->where('izvedba', 'like', '%' . $request->search_izvedba . '%');
        }

        if ($request->search_odobrenie) {
            $query->where('eu_odobrenie', 'like', '%' . $request->search_odobrenie . '%');
        }

        $documents = $query->paginate(15)->appends($request->all());

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

        // dd($data);
        $document = Document::create([
            'marka' => $data['marka'],
            'doc_type_id' => $data['doctype'],
            'fuel_id' => $data['fuel'],
            'tip' => $data['tip'],
            'varijanta' => $data['varijanta'],
            'filepdf' => $data['filepdf'] ?? null,
            'user_id' => $data['user_id'],
            'izvedba' => $data['izvedba'],
            'eu_odobrenie' => $data['eu_odobrenie'],
            'tip_motor' => $data['tip_motor'],
            'cm3' => $data['cm3'],
            'kw' => $data['kw'],
            'co2_nedc' => $data['co2_nedc'],
            'co2_wltp' => $data['co2_wltp'],
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
