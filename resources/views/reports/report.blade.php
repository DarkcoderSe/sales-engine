@extends('layouts.master')

@section('title', 'Add new Lead')

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
</style>
<div class="row justify-content-center">
    <div class="col-10 col-md-10 pb-4 mb-4">

        <form action="{{ URL::to('lead/submit') }}" method="post">
            @csrf

            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Reports Section:</h4>
                    <p class="card-title-desc">Fill all information below</p>
                <div class="row">
                        <div class="col-md-6">   
                            <label>Serach</label>
                            <div class="form-group has-search">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control searchfield" placeholder="Type here....">
                        </div>    
                        </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Date From </label>
                        <input type="date" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Date to </label>
                        <input type="date" class="form-control" >
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Profile </label>
                        <select  class="form-control" >
                            <option value="1" >Imran Ahmad</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Phase </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Status </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Technology </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>BD </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Job Source </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <label>Assigned to </label>
                        <select  class="form-control" >
                            <option value="1" >None</option>
                            <option value="2">Kamboh</option>
                            <option value="3">Darkcoder</option>
                        </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                        <div class="custom-control custom-switch mb-3" dir="ltr">
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked="">
                        <label class="custom-control-label" for="customSwitch1">Filter leads based on historical data</label>
                        </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                        <div class="custom-control custom-switch mb-3" dir="ltr">
                        <input type="checkbox" class="custom-control-input" id="customSwitch2" checked="">
                        <label class="custom-control-label" for="customSwitch2">Filter leads based on over due dates</label>
                        </div>
                        </div>
                    </div>
                </div>
        </div>
            
            
            </div>


            <div class="text-right mt-4 mb-4">
                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Lead</button>
            </div>
        </form>


    </div>
</div

@endsection
