<?php

namespace App\Http\Controllers;
use App\Models\Flow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FlowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Flow $flow)

    {
        $query = Flow::orderby('id', 'DESC');
        $flow = $query->get();
        


        return view('dashboard.flows.flow', ['flow' => $flow]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.flows.new_flow');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Flow $flow)
    {
        $data = $request->only('name', 'message');
        $query = Flow::insert($data);

        $message = 'Flusso ' . $data['name'];
        $message .= $query ? ' è stato creato' : 'non è stato creato';
        session()->flash('message', $message);
        return redirect()->route('flow.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Flow $flow)
    {
        // se non sei autorizzato in base al id di Auth
        // if($flow->id !== Auth::id()){
        //     abort(401);
        // }
        return view('dashboard.flows.edit_flow')->withFlow($flow);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flow $flow)
    {
        $data = $request->only('name', 'message');
        $query = $flow->update($data);

        $message = $query ? 'Flusso = ' . $flow->name . ' è stato aggiornato' : 'Flusso = ' . $flow->name . ' non è stato aggiornato';
        session()->flash('message', $message);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $flow)
    {
        $query = Flow::where('id', $flow)->delete();
        return redirect()->route('flow.index');
    }
}
