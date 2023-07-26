@extends('template.nav_bar')
@section('content_landing')
 <br>
    <style> 
    .none{
        display: none;
    }
    </style>
@if(!$isStepIdRequest)
 <div class="container">
    {{Form::open()}}
        <div class="flow">
            <ul>
                {{Form::hidden('flow_id', $Qflow->id)}} 
                <li>{{Form::label("FLow_id: $Qflow->id")}}</li>
                <li>{{Form::label("name:$Qflow->name ")}}</li>
                <li>{{Form::label(" message: $Qflow->message")}}</li>
            </ul>
        </div>
        @php
            //fare il sizeof di stepsArray
            
            $firstID = $stepsArray[0]['steps']->id;             
        @endphp
            <a href="/landing?flow={{$Qflow->id}}&step={{$firstID}}"> Comincia </a>     
    {{Form::close()}}  
 </div>    
@endif  

 @if($isStepIdRequest)
    <div class="container">  
                           
        @foreach($stepsArray as $key => $stepArray)    
            @php
                
                $nextStepKey = $key + 1;
                $nextStep = "";
                $isVisible = $stepArray['isVisible'];
                $display = $isVisible ? "" : "none";  
                $maxIndex = sizeof($stepsArray) - 1;
                $sizeArray = sizeof($stepsArray);
                
                // $nextStep = $stepsArray[$nextStepKey]['steps']->id;
                if($nextStepKey <= $maxIndex){
                    $nextStep = $stepsArray[$nextStepKey]['steps']->id;
                    
                } else {
                    
                }
               
            //    if ($nextStepKey == $max){
            //     echo "fine flusso";
            //    }
            // echo "$nextStep";                   
            @endphp
            <div class="{{$display}}">
                {{Form::open(array('route' => 'landing.manage'))}}
                @method('GET')
                @php
                    $steps = $stepArray['steps'];
                    $elements = $stepArray['elements']; 
                    // $idStep = $steps->id;;
                    // $idStep++;
                    // $ultimo = $steps->id;  
                    $url = "/landing?flow=$Qflow->id&step=$nextStep";                
                @endphp
               
                <div class="card step" >
                    <h6 class="card-header">Step_id:{{Form::label("step_id", "$steps->id")}}</h6>
                    <h6> {{Form::label("message: $steps->message")}}</h6>
                        
                    @foreach ($elements as $element )
                        <div class="card-body">
                            <div class="elements">
                                @switch($element)
                                    @case($element->type === "text")
                                        <div>
                                            <ul>
                                                <li> 
                                                    {{Form::label("Type: $element->label")}}
                                                    {{Form::text('text', " ", ['class' => 'form-control'])}}
                                                </li>
                                            </ul>
                                        </div>    
                                        <br>
                                    @break
                                    @case($element->type === "select")
                                        <div>
                                            <ul>
                                                <li> 
                                                    {{Form::label("Type: $element->label")}}
                                                    {{Form::select('select', array('text', 'select','boolean') , ['class' => 'form-control'])}}
                                                </li>
                                            </ul>
                                        </div>
                                        <br>
                                    @break
                                    @case($element->type === "boolean")
                                        <div>
                                            <ul>
                                                <li> 
                                                    {{Form::label("Type: $element->label")}}
                                                    {{Form::checkbox('boolean', 'value', false)}}
                                                </li>
                                            </ul>
                                        </div>
                                        <br>
                                    @break
                                @endswitch
                            </div>
                        </div>                       
                    @endforeach                    
                    <a href={{$url}}> avanti </a>  
                    
                </div>
                {{ Form::submit("Salva")}} 
                {{Form::close() }} 
            </div>           
        @endforeach
    </div>
 @endif 
@endsection 




