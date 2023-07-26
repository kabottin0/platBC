<?php

namespace App\Http\Controllers;

use App\Models\Archivio;
use App\Models\Steps;
use App\Models\Elements;
use App\Models\User;
use App\Models\Flow;
use App\Models\Users_has_flows;
use Illuminate\Http\Request;
use App\Http\Controllers\ArchivioController;
use App\Http\Controllers\StepController;
use App\Http\Controllers\ElementsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\FlowController;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $Flows = Flow::orderby('id', 'ASC')->get();
        $countFlows = sizeof($Flows);

        $archivio = Archivio::orderby('id', 'ASC')->get();
        $countArchivio = sizeof($archivio);

        $Users = User::orderby('id', 'ASC')->get();
        $countUser = sizeof($Users);

        $userFlow = Users_has_flows::orderby('id', 'ASC')->get();
        $countUserFlow = sizeof($userFlow);



        return view('dashboard.home', compact('countFlows', 'countArchivio', 'countUser','countUserFlow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}



// SELECT * FROM flows f, steps s, elements e WHERE s.flow_id = f.id AND e.steps_id = s.id AND f.id=1;