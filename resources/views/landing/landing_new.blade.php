@extends('landing.layout.landing_top')

@section('main')
    <style>
        .goback {
            width: 100%;
            background: white;
            color: blue;
            border-color: blue;
            --bs-btn-hover-border-color: blue;
        }
        
        @media (min-width:250px) and (max-width:1000px) {
            
            .col-md-6{
                margin: 2px;
                width: 100%;
            }
        }
    </style>
    
    @if (!$isStepIdRequest)
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                </div>
                @if(!$isEmpty)
                <div class="col-md-6">
                    <div class="card">
                        {{ Form::open() }}
                        {{ Form::hidden('flow_id', $Qflow->id) }}
                        <div class="card-body">
                            <h5 class="card-title text"> <?= $Qflow->name ?> </h5>
                            <p class="card-text text">
                                <?= $Qflow->message ?>
                            </p>

                            @php
                                //fare il sizeof di stepsArray                               
                                $firstID = $stepsArray[0]['steps']->id;
                            @endphp
                            
                            <div class="container">
                                <div class="row">
                                    <div class="col-4"> </div>
                                    <div class="col-4"> </div>
                                    <div class="col-4 text-center">
                                        <a href="/landing?flow={{ $Qflow->id }}&step={{ $firstID }}"
                                            class="btn btn-primary w-100">
                                            Inizia
                                        </a>
                                    </div>
                                </div>

                            </div>
                            


                        </div>

                        {{ Form::close() }}
                    </div>
                </div>
                @else 
                    <div class="alert alert-warning margin" role="alert">
                        Nessun step esistente, prego inserire nuovo step
                    </div>
                @endif

                <div class="col-md-3">

                </div>

            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6"><hr></div>
                <div class="col-md-3"></div>
            </div>
            

            <div class="d-none">
                debug:
                FLow_id: <?= $Qflow->id ?> <br>
                name: <?= $Qflow->name ?>
            </div>
        </div>
    @endif
    @if ($isStepIdRequest)
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 ">

                </div>
                <div class="col-md-6">
                    <div class="card">

                        @foreach ($stepsArray as $key => $stepArray)
                            @php
                                
                                $nextStepKey = $key + 1;
                                $nextStep = '';
                                $isVisible = $stepArray['isVisible'];
                                $display = $isVisible ? '' : 'none';
                                $maxIndex = sizeof($stepsArray) - 1;
                                $sizeArray = sizeof($stepsArray);
                                
                                // $nextStep = $stepsArray[$nextStepKey]['steps']->id;
                                $isLastStep = $key == $maxIndex;
                                if ($isLastStep) {
                                    $buttonLabel = 'Salva';
                                    
                                } else {
                                    $nextStep = $stepsArray[$nextStepKey]['steps']->id;
                                    $buttonLabel = 'Avanti';
                                }
                                
                                //    if ($nextStepKey == $max){
                                //     echo "fine flusso";
                                //    }
                                // echo "$nextStep";
                                
                                
                            @endphp
                            @if ($isVisible)
                            <div class="{{ $display }}">
                                {{ Form::open(['route' => 'landing.manage']) }}
                                @method('GET')
                                @php
                                    $steps = $stepArray['steps'];
                                    $elements = $stepArray['elements'];
                                    // $idStep = $steps->id;;
                                    // $idStep++;
                                    // $ultimo = $steps->id;
                                    $url = "/landing?flow=$Qflow->id&step=$nextStep";
                                    // dd($elements);
                                    // die;
                                @endphp
                                {{ Form::hidden('step_id', "$steps->id") }}
                                {{ Form::hidden('next', $url) }}
                                {{ Form::hidden('isLastStep', $isLastStep) }}
                                {{ Form::hidden('flow_id', $Qflow->id) }}
                                
                                
                                <div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
                                    {{-- <h6 class="card-title text">Step_id:{{ Form::label('step_id', "$steps->id") }}</h6> --}}
                                    <h6 class="card-text text"> {{ Form::label("$steps->message") }}</h6>
                                    
                                    {{ Form::hidden("message", $steps->message) }}
                                    <br>
                                    
                                    
                                        
                                        
                                    
                                    @foreach ($elements as $element)
                                    @php
                                       
                                            $elementValue = " ";
                                                                                
                                    @endphp
                                        <div class="">
                                            <div class="elements">
                                                @switch($element)
                                                    @case($element->type === 'text')
                                                        <div>
                                                            <h6 class="text">{{ Form::label($element->label) }} </h6>
                                                            {{ Form::hidden('label', $element->label) }}
                                                            {{ Form::hidden('id', $element->id) }}
                                                            
                                                            {{ Form::text('text', $value = $element->value, array('class' => 'form-control', 'text')) }}
                                                            
                                                        </div>
                                                    @break

                                                    @case($element->type === 'select')
                                                        @php
                                                            $explode = $element->value;
                                                            $array = explode(';', $explode);
                                                            // $arrimplode = implode(';', $array);
                                                            $label = $element->label;

                                                            
                                                        @endphp

                                                        <div>
                                                            <h5 class="text"> {{ Form::label("$label") }}</h5>
                                                            @foreach ($array as $arr)
                                                                @php
                                                                    $idCheck = 'Checked';
                                                                    $chek = $idCheck . '-' . uniqid();
                                                                    // $elementByValue = $this->findByValue($arr, $array);
                                                                    // dd($arr);
                                                                    // die;
                                                                @endphp
                                                                
                                                                <div class="form-check">
                                                                    
                                                                    <input class="form-check-input" type="radio" name="select[]"
                                                                        value="{{$arr}}" id="{{ $chek }}" required>
                                                                    <label class="form-check-label text" for="{{ $chek }}">
                                                                        {{ $arr }}
                                                                    </label>
                                                                </div>
                                                            @endforeach

                                                            {{-- explode.... ed inserisci gli elementi --}}
                                                            {{-- {{ Form::select('select', ['text', 'select', 'boolean'], ['class' => 'form-control']) }} --}}
                                                        </div>
                                                    @break

                                                    @case($element->type === 'boolean')
                                                        @php
                                                            $explode = $element->value;
                                                            $array = explode(';', $explode);
                                                            // $arrimplode = implode(';', $array);
                                                            $label = $element->label;
                                                        @endphp
                                                        <div>
                                                            @foreach ($array as $arr)
                                                            @php
                                                                $idCheck = 'Check';
                                                                $chek = $idCheck . '-' . uniqid();
                                                            @endphp
                                                            
                                                            <div class="form-check">
                                                                
                                                                <input class="form-check-input" type="radio" name="boolean[]"
                                                                    value="{{$arr}}" id="{{ $chek }}" required>
                                                                <label class="form-check-label text" for="{{ $chek }}">
                                                                    {{ $arr }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                            {{-- {{ Form::label($element->label, ['class' => 'form-control', 'text']) }}
                                                            {{ Form::checkbox('boolean', 'value', false) }} --}}
                                                        </div>
                                                    @break
                                                @endswitch
                                            </div>

                                        </div>
                                    @endforeach
                                    
                                </div>
                                <div class="row mx-auto mb-2">
                                    <div class="col-md-6">
                                        <button type="button" class="btn goback">
                                            <a href="javascript:history.back()">Indietro</a>
                                        </button>
                                         
                                    </div>
                                    <div class="col-md-6">                                           
                                    {{ Form::submit($buttonLabel, ['class' => 'btn btn-primary', 'style' => 'width:100%']) }}
                                        

                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                          
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-3 "></div>
            </div>
        </div>
    @endif
   

@endsection
