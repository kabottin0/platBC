@extends('layouts.app')
@section('main')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center  mb-5">
            <a href="{{ route('flow.index')}}" class="m-4">
                <span class="icon text-gray-600">
                    <i class="fas fa-arrow-left"></i>
                </span>
            </a>
            <h1 class="h3 mb-0 text-gray-800">Aggiorna Step</h1>
        </div>
        <form method="POST" action="{{ route('steps.update', ['step' => $step->id]) }}">
            @method('PATCH')
            @csrf
            <div class="modal-body py-0">
                <label for="label" class="form-label-controll">Step: <strong>{{ $step->id }}</strong> </label>
                <br>
                <input type="hidden" class="form-controll" name="step_id" value="{{ $step->id }}">

                <label for="label" class="form-label-controll"> Message </label>
                <input class="form-control" name="message" id="value" value="{{ $step->message }}">
                <label for="archivi" class="form-label-controll"> Scegli tra gli elementi: </label>
                @foreach ($newData as $archivio)
                    {{-- @php
                                  $attrChecked = $archivio['checked'] ? "checked" : "";
                              @endphp --}}
                    <div class="form-check">
                        @php
                            $idCheck = 'Check';
                            $chek = $idCheck . '-' . uniqid();
                        @endphp
                        <input class="form-check-input" type="checkbox" name="elements[]" id="{{ $chek }}"
                            value="{{ $archivio['id'] }}" @checked($archivio['checked'])>
                        <label class="form-check-label" for="{{ $chek }}">
                            {{ $archivio['label'] }}
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="modal-footer flex-column border-top-0">
                <button class="btn btn-primary">Aggiorna Step</button>
                
                
            </div>
        </form>
    </div>
@endsection
