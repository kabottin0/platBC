<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Archivio;
use Illuminate\Support\Facades\DB;

class ArchivioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Archivio $archivio)
    {


        $query = Archivio::orderBy('id', 'DESC');
        $archivio = $query->get();

        return view('dashboard.archivi.archivi', ['archivios' => $archivio]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.archivi.new_archivio');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Archivio $archivio)
    {
        $data = $request->only('label', 'type', 'value');
        $query = Archivio::insert($data);

        $message = 'Archivio ' . $data['label'];
        $message .= $query ? ' è stato creato' : 'non è stato creato';
        session()->flash('message', $message);
        return redirect()->route('archivio.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Archivio $archivio)
    {
        return $archivio;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Archivio $archivio)
    {
        return view('dashboard.archivi.edit_archivio')->withArchivio($archivio);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archivio $archivio)
    {
        $data = $request->only('label', 'type', 'value');
        $query = $archivio->update($data);

        $message = $query ? 'Elemento ' . $archivio->label . ' è stato aggiornato' : 'Elemento ' . $archivio->label . ' non è stato aggiornato';
        session()->flash('message', $message);
        return redirect()->route('archivio.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $archivio)
    {
        $query = Archivio::where('id', $archivio)->delete();
        return redirect()->route('archivio.index');
    }
}
