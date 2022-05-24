@extends('layouts.master')

@section('title', 'Management System - TransData')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-4 pt-4">
        <div class="col-md-5 text-center pt-4 mt-4">

            @if (auth()->check())

            @if (auth()->user()->hasRole('agent'))
            <h3>Lead Generation System</h3>
            @elseif (auth()->user()->hasRole('bdm'))
            <h3>Sales Engine</h3>
            @else
            <h3>Management System</h3>
            @endif

            @endif

        </div>
    </div>
</div>
@endsection
