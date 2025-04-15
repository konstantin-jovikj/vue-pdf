<?php

namespace App\Http\Controllers;

use App\Models\DocType;
use App\Models\Document;
use App\Models\Fuel;
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
    public function create(Document $document)
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
            'komercijalna_oznaka' => $data['komercijalna_oznaka'],
            'godina_na_proizvodstvo' => $data['godina_na_proizvodstvo'],
            'najgolema_konstruktivna_vkupna_masa' => $data['najgolema_konstruktivna_vkupna_masa'],
            'najgolema_legalna_vkupna_masa' => $data['najgolema_legalna_vkupna_masa'],
            'najgolema_legalna_vkupna_masa_na_grupa_vozila' => $data['najgolema_legalna_vkupna_masa_na_grupa_vozila'],
            'masa_na_voziloto' => $data['masa_na_voziloto'],
            'kategorija_i_vid' => $data['kategorija_i_vid'],
            'oblik_i_namena' => $data['oblik_i_namena'],
            'broj_na_coc' => $data['broj_na_coc'],
            'broj_na_oski' => $data['broj_na_oski'],
            'dolzina' => $data['dolzina'],
            'sirina' => $data['sirina'],
            'visina' => $data['visina'],
            'dozvoleni_pnevmatici_i_naplatki_1' => $data['dozvoleni_pnevmatici_i_naplatki_1'],
            'dozvoleni_pnevmatici_i_naplatki_2' => $data['dozvoleni_pnevmatici_i_naplatki_2'],
            'broj_na_vrtezi' => $data['broj_na_vrtezi'],
            'vin' => $data['vin'],
            'odnos_silina_masa' => $data['odnos_silina_masa'],
            'boja_na_voziloto' => $data['boja_na_voziloto'],
            'datum_na_dokument' => $data['datum_na_dokument'],
        ]);

        return redirect()->route('documents.index')->with('success', 'Записот е успешно креиран');
    }

    /**
     * Display the specified resource.
     */
    public function show(Document $document)
    {
        $document->load('user', 'docType', 'fuel');
        return inertia('documents/DocumentShow', [
            'document' => $document->toArray(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Document $document)
    {
        $document->load('user', 'docType', 'fuel');
        $docTypes = DocType::all();
        $fuels = Fuel::all();
        return inertia('documents/DocumentEdit', [
            'document' => $document,
            'docTypes' => $docTypes,
            'fuels' => $fuels,
        ]);
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
