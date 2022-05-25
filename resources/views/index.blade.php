@extends('layouts.master')

@section('title', 'Management System - TransData')

@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #ced4da;
            /* width: 100% !important; */
            border-radius: 4px;
        }
        .has-search .searchfield {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
        .addToListField {
            border-radius: 0px !important;
        }

        .addToListBtn {
            border-radius: 0px !important;
            /* margin-top:2px; */
        }

        .cstmSpaceBtn {
            margin-top: 12px;
        }
        .searchWraper{
            margin:auto;
            width:90%;
            padding-left:120px;
        }
    </style>


            @if (auth()->check())

            @if (auth()->user()->hasRole('agent'))
                <div class="container">
                    <div class="row justify-content-center mt-4 pt-4">
                        <div class="col-md-5 text-center pt-4 mt-4">
            <h3>Lead Generation System</h3>
                        </div></div></div>
            @elseif (auth()->user()->hasRole('bdm'))

                <div class="row justify-content-center">
                    <div class="col-12 col-md-12 pb-4 mb-4">
                        <div class="card">
                            <div class="card-body searchWraper">
                                <form action="{{ route('sales-engine.search') }}" method="post">
                                    @csrf
                                    <div class="row no-gutters">
                                        <div class="col-md-10 align-self-center">
                                            <div class="form-group">
                                                <label>Company Name: </label>
                                                <input type="text" name="query" class="form-control addToListField" placeholder="i.e: TransData"> </div>
                                            @if ($errors->any('query'))
                                                <span class="small text-danger">
                                    {{ $erorrs->first('query') }}
                                </span>
                                            @endif


                                        </div>
                                        <div class="col-md-2 align-self-center cstmSpaceBtn">
                                            <button type="submit" class="btn btn-primary addToListBtn">Search</button>
                                        </div>
                                    </div>
                                    <div class="row no-gutters">
                                        <div class="col-md-10 align-self-center">
                                            <a href="{{ route('sales-engine.create') }}">Click here</a>
                                            to add new Organization
                                        </div>
                                    </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                </div>
            @else
                <div class="container">
                    <div class="row justify-content-center mt-4 pt-4">
                        <div class="col-md-5 text-center pt-4 mt-4">
            <h3>Management System</h3>

            </div>
            </div>
            </div>
            @endif

            @endif

@endsection
