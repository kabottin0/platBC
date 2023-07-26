<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ArchivioController;
use App\Models\Elements;
use App\Models\Archivio;
use App\Models\Flow;
use App\Models\Steps;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Element;

class StepController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Steps $steps)
    {
        $query = Steps::where('flow_id', '=', $request->id);

        $steps = $query->get();
        $flow = Flow::findOrFail($request->id);
        
        return view('dashboard.steps.steps', ['steps' => $steps], compact('steps', 'flow'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req, Archivio $archivio)
    {
        $arch = Archivio::orderBy('id', 'ASC')->get();
        $flow = Flow::findOrFail($req->id);
        $step = new Steps();
        $flows = $this->getFlows();

        return view('dashboard.steps.new_step', compact('flow', 'step', 'flows', 'arch'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Archivio $archivio)
    {

        $stepsNew = new Steps();
        $stepsNew->message = $request->input('message');
        $stepsNew->flow_id = $request->input('flow_id');
        $stepsNew->save();

        $elements = $request->input('elements');
        //select * from archivio where id = "[1,2,3,4,]
        $data = Archivio::whereIn('id', $elements)->get();


        //per inserire un array di valori nel DB serve il foreach in laravel.

        foreach ($data as $value) {
            $element = new Elements();
            // $element->id = $value->id;
            $element->label = $value->label;
            $element->type = $value->type;
            $element->value = $value->value;
            $element->steps_id = $stepsNew->id;
            $element->elements_id = $value->id;
            $element->save();
        }

        $message = 'Step è stato aggiunto';
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



    function findById($id, $array)
    {
        foreach ($array as $item) {
            $elementId = $item->elements_id;
            if ($id === $elementId) {
                return true;
            }
        };
        return false;
    }

    function formatData($array1, $array2)
    {
        $results = [];

        foreach ($array1 as $item) {
            $idArch = $item->id;
            $checked = $this->findById($idArch, $array2);
            $results[] = [
                'id' => $idArch,
                'label' => $item->label,
                'checked' => $checked,
            ];
        }

        return $results;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Steps $step, Request $req, Archivio $archivio)
    {

        $elements = Elements::where('steps_id', $step->id)->get();
        // dd($elements);
        // die;
        $arch = Archivio::orderBy('id', 'ASC')->get();
        // dd($arch);
        // die;

        $newData = $this->formatData($arch, $elements);
        // dd($newData);
        // die;



        return view('dashboard.steps.edit_step', compact('arch', 'newData', 'elements'))->withStep($step);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


        /**
         * 1) hai l'archivio che ti permette di effettuare il match di quelli che vogliamo aggiornare tutto lo step
         * 2) abbiamo i dati che effettivamente arrivano dal form elements
         * 3) ho preso id step che l'utente sta modificando
         * 4) il messaggio dello step
         */

        $step_id = $request->input("step_id");
        $mess = $request->input('message');
        $elements = $request->input('elements');

        // ^ array:2 [▼
        // 0 => "1"
        // 1 => "2"
        // ]

        $step = Steps::find($step_id);
        $step->id = $step_id;
        $step->message = $mess;
        $step->update();


        //elementi che l'utente ha selezionato
        //SELECT * FROM `archivios` WHERE id IN (1,2,3);

        //elementi che non esistono
        // SELECT * FROM `archivios` WHERE id NOT IN  (1,2,3,4);
        if (is_array($elements) && sizeof($elements) > 0) {
            $currentElementArchivio = Archivio::whereIn('id', $elements)->get();

            $elementNotExist = Archivio::whereNotIn('id', $elements)->get();


            //1) rimuovere quelli che non esistono più
            foreach ($elementNotExist as $item) {

                // echo "elimino::::" . $item->id;
                //SELECT * FROM `elements` where steps_id = 9 and elements_id = 2;

                $deleteElements = Elements::where(
                    [
                        ['steps_id', '=', $step_id],
                        ['elements_id', '=', $item->id],
                    ]
                )->get();

                foreach ($deleteElements as $item2) {
                    $item2->delete();
                }
                // if(isset($deleteElement)){
                //     // echo "esiste:::$item->id";
                //     $deleteElement->delete();
                //     // echo "<br>";
                // }
            }




            // echo "0......SaveOrUpdate::<br>";
            foreach ($currentElementArchivio as $item) {


                // SELECT * FROM `elements`WHERE steps_id = 7 AND elements_id = 4;
                $existElementInStep = Elements::where([

                    ['steps_id', '=', $step_id,],
                    ['elements_id', '=', $item->id],
                ])->get();

                // echo "0......SaveOrUpdate::foreach::step_id:". $step_id . " elements_id:" . $item->id."<br>";
                // print_r($existElementInStep);
                // echo "<br>";
                // echo "<br>";

                // isset è sempre vera anche per un array vuoto
                if (sizeof($existElementInStep) > 0) {
                    //echo "0......SaveOrUpdate::foreach::step_id:UPDATE::". $step_id . " elements_id:" . $item->id."<br>";
                } else {
                    //echo "0......item:::". $item->label ."br";
                    $element = new Elements();
                    $element->label = $item->label;
                    $element->type = $item->type;
                    $element->value = $item->value;
                    $element->steps_id = $step_id;
                    $element->elements_id = $item->id;
                    $element->save();
                    //echo "0......SaveOrUpdate::foreach::step_id:SAVE::". $step_id . " elements_id:" . $item->id."<br>";
                    //prenderti da archivio quello che vuoi salvare creare un nuovo oggetto elements e salvare.
                }
            }
        }



        $message = 'Step è stato aggiornato';
        session()->flash('message', $message);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $query = Steps::where('id', $id)->delete();

        return redirect()->back();
    }


    public function getFlows()
    {
        return Flow::whereId(Auth::id())->orderBy('name')->get();
    }
}
