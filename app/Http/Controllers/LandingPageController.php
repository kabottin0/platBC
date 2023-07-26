<?php

namespace App\Http\Controllers;

use App\Models\Elements;
use App\Models\Flow;
use App\Models\Steps;
use App\Models\User;
use App\Models\User_has_elements;
use App\Models\Archivio;
use App\Models\Users_has_flows;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Utility;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $data=$request->session()->all();
        $query = Archivio::select('label');
        $archivio = $query->get();

        $idFlowSession = "";
        $currentFlowSession = $request->session()->get('currentFlow');

        //se non esiste aggiungiamo l'id session univoco nuovo in sessione.
        if ($request->session()->has('flowIdSession')) {
            $idFlowSession = $request->session()->get('flowIdSession');
            // echo "esiste un flusso già iniziato::$idFlowSession";
        } else {
            $uniqid = Str::random(20);
            $request->session()->put('flowIdSession', $uniqid);
            // echo "non esiste un flusso ne creo uno:::$uniqid";
        }

        $flowIdRequest = $request->flow;
        $stepIdRequest = $request->step;

        $isStepIdRequest = isset($stepIdRequest);
        //QueryJoin a 3 tabelle
        //SELECT * FROM flows f, steps s, elements e WHERE s.flow_id = f.id AND e.steps_id = s.id AND f.id=1;
        // $queryjoin = DB::table('flows')
        // ->join('steps', 'flow_id', '=', 'flows.id')
        // ->join('elements', 'steps_id', '=', 'steps.flow_id')
        // ->select('flows.*', 'steps.message as s_message', 'elements.*')
        // ->where('flow_id', $flow_id)
        // ->get();
        // dd($queryjoin);

        $Qflow = Flow::findOrFail($flowIdRequest);

        $stepsDb = DB::table('steps')
            ->where('flow_id', $flowIdRequest)
            ->get()->toArray();

        $stepsArray = [];

        foreach ($stepsDb as $key => $stepDb) {

            $step_id = $stepDb->id;
            $flow_id = $stepDb->flow_id;
            $isVisible = $step_id == $stepIdRequest;
            // echo "0:::::: valore step_id $step_id & valore step_request $stepIdRequest" . "<br>";
            if (!$isStepIdRequest) {
                $isVisible = true;
            }
            ///prende tutti gli elementi in base allo step_id and flow_id
            $elementsStepDB = DB::table('steps')
                ->join('elements', 'steps_id', '=', 'steps.id')
                ->select('steps.*', 'steps.id as s_id', 'elements.*', 'elements.id as e_id',)
                ->where('flow_id', $flow_id)
                ->where('steps_id', $step_id)
                ->get()->toArray();


                
                
            if (is_array($currentFlowSession) && array_key_exists($idFlowSession, $currentFlowSession) && array_key_exists($step_id, $currentFlowSession[$idFlowSession])) {
                
                $arrT = $currentFlowSession[$idFlowSession][$step_id];
               
                ///verifica dalla sessione se dentro elemenrsStepDb ha un valore nel caso settiamo
                ///find...
                //!isNull() .... $element->value = ....$bjectfind->value
                
                foreach ($elementsStepDB as $item) {
                    
                    $explode = $item->value;
                    $array = explode(';', $explode);
                    $elementDbId = $item->id;
                    // echo "id:::" . $item['id'] . "<br>";
                   
                    $elementSessionFindById = $this->findElementById($elementDbId, $arrT);
                    if (!is_null($elementSessionFindById)){
                        $item->value = $elementSessionFindById['value'];
                    } 
                    foreach ($array as $arr){
                        $elementByValue = $this->findByValue($arr, $array);
                        if (!is_null($elementByValue)){
                            $arr = $elementByValue;
                        }

                    }
                }
            }


            

            $stepsArray[$key] = [
                "isVisible" => $isVisible,
                "steps" => $stepDb,
                "elements" => $elementsStepDB

            ];
        }
        $isEmpty = sizeof($stepsArray) == 0;




        return view('landing.landing_new', compact('Qflow', 'stepsArray', 'isStepIdRequest', 'stepIdRequest', 'isEmpty', 'archivio'));
    }
    function findByValue($value, $array)
    {
        foreach ($array as $item) {
            $elementvalue = $item;
            if ($value === $elementvalue) {
                return true;
            }
        };
        return false;
    }

    public function findElementById($id, $array)
    {
        foreach ($array as $item) {
            $elementSessionId = $item['id'];
            if ($id == $elementSessionId) {
                return $item;
            }
        };
        return null;
    }

    /**
     * Manage flow session
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function manageStepFlowSession(Request $request)
    {

        //save to session
        if (!$request->session()->has('flowIdSession')) die("error flow....");
        $stepIdRequest = $request->input('step_id');
        $idFlowSession = $request->session()->get('flowIdSession');
        $flowIdRequest = $request->input('flow_id');
        $label = $request->input('label');
        $labelNull = $request->input('message');
        $elementId = $request->input('id');
        $currentFlow = [];

        if ($request->session()->has('currentFlow')) {
            $currentFlow = $request->session()->get('currentFlow');
        }

        foreach ($request->all() as $key => $value) {
            if ($key != "_token" && $key != "_method") {
                $currentFlow[$idFlowSession][$stepIdRequest]['elements'] = [
                    'id' => $elementId,
                    'labelNull' => $labelNull,
                    'label' => $label,
                    'key' => $key,
                    'value' => $value,
                ];
            }
        }

        $request->session()->put('currentFlow', $currentFlow);
        //./save to session

        $url = $request->input('next');

        // $flowSession = $request->session()->get('currentFlow');
        // dd($flowSession);
        // die;



        //save to storage
        $isLastStep = $request->input('isLastStep');


        if ($isLastStep) {
            //sulla base dei dati effetuare:::
            //1) creazione nuovo flusso user impostando per il momento user id 1
            $user_id = 1;
            $userHasFlow = new Users_has_flows();
            $userHasFlow->users_id = $user_id;
            $userHasFlow->flow_id = $request->input('flow_id');
            $userHasFlow->save();

            //2) su quel flusso appena creato salvare tutti gli elenenti.

            foreach ($currentFlow as $key => $steps) {

                foreach ($steps as $key => $step) {
                    $value = $step['elements']['value'];
                    $key = $step['elements']['key'];
                    $label = $step['elements']['label'];
                    $labelNull = $step['elements']['labelNull'];

                    if (!empty($key)) {
                        if ($key == "select") {
                            $arr = implode(';', $value);
                            $sessionElement = new User_has_elements();
                            $sessionElement->users_has_flow_id = $userHasFlow->id;
                            $sessionElement->label = $labelNull;
                            $sessionElement->type = $key;
                            $sessionElement->value = $arr;
                            $sessionElement->save();
                        } else if ($key == "boolean") {
                            $arr = implode(';', $value);
                            $sessionElement = new User_has_elements();
                            $sessionElement->users_has_flow_id = $userHasFlow->id;
                            $sessionElement->label = $labelNull;
                            $sessionElement->type = $key;
                            $sessionElement->value = $arr;
                            $sessionElement->save();
                        } else {
                            $sessionElement = new User_has_elements();
                            $sessionElement->users_has_flow_id = $userHasFlow->id;
                            $sessionElement->label = $label;
                            $sessionElement->type = $key;
                            $sessionElement->value = $value;
                            $sessionElement->save();
                        }
                    }
                }
            }
            $request->session()->forget('currentFlow');
            return view('dashboard.endLanding');
        }


        // Session::flush();
        return redirect()->to($url);
    }




    //prendi i dati del form X e lo salvi nella sessione con il suo 
    //relativo idflowsession generato precetentemente


    // $text = $request->input('text');
    // $select = $request->input('select');
    // $bool = $request->input('boolean');
    // $step_id = $request->input('step_id');

    // $request->session()->put('text', $text);
    // $request->session()->put('boolean', $bool);
    // $request->session()->put('step_id', $step_id);

    // session()->keep(['text', 'select', 'boolean', 'step_id']);

    // $array = [
    //     "awjdiojwdawnawdodawdwa" => [
    //         "12" => [
    //             1,2,3,4,5,6,7
    //         ],
    //         "13" => .....
    //     ]
    // ]

    /// è l'ultimo step? se è l'ultimo allora inserisci tutto nel database 

    ///redirect al step successivo 7 -> 14




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

        // $nome = $request->input('text');
        // $nome_value = $request->session()->put('text', $nome);

        // $userHasFlow = new Users_has_flows();
        // $user->users_id = $request->input('users_id');
        // $user->flow_id = $request->input('flow_id');
        // $user->save();

        // userHasFlow->id


        // foreach
        // $FormElements = new User_has_elements();
        // $FormElements->users_has_flow_id = $user->id;
        // $FormElements->u_steps_id = $request->input('step_id');
        // $FormElements->label = $request->input('text');
        // $FormElements->value = ' ';
        // $FormElements->save();


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Flow $flow)
    {
        return view('landing.landing_new');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
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
