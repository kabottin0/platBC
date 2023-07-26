<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users_has_flows;
use App\Models\User_has_elements;
use Illuminate\Support\Facades\DB;
class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $queryjoin = DB::table('user_has_elements')
                   ->join('users_has_flows', 'user_has_elements.users_has_flow_id', '=', 'users_has_flows.id')
                   ->select('users_has_flows.id', 'users_has_flows.created_at', 'user_has_elements.label','user_has_elements.type','user_has_elements.value','user_has_elements.users_has_flow_id')
                   ->orderBy('id', 'DESC')
                   ->paginate(20);
    
        // dd($queryjoin);
        // die;
        
    
        return view('dashboard.userRequest', compact('queryjoin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function destroy(int $id)
    {
        $query = User_has_elements::where('id', $id)->delete();
        return redirect()->back();
    }
}
