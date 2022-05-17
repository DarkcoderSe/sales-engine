@extends('layouts.master')

@section('title', 'Real state - Find your property!')


@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('slick/slick.css') }}"/>
<link rel="stylesheet" href="{{ asset('slick/slick-theme.css') }}">
<link rel="stylesheet" href="{{asset('/css/search.css')}}">
<style>
    body {
        overflow-x: hidden !important;
    }
    .center {
        display: block;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        border: 1px solid #eee;
        padding: 6px;
        border-radius: 3px;
    }

    .slick-prev {
        z-index: 9999;
    }

    .responsive-person{
        opacity: 0;
        visibility: hidden;
        transition: opacity 1s ease;
        -webkit-transition: opacity 1s ease;
    }

    .responsive-person.slick-initialized {
        visibility: visible;
        opacity: 1;
    }

    .responsive-party{
        opacity: 0;
        visibility: hidden;
        transition: opacity 1s ease;
        -webkit-transition: opacity 1s ease;
    }

    .responsive-party.slick-initialized {
        visibility: visible;
        opacity: 1;
    }

    .responsive-event{
        opacity: 0;
        visibility: hidden;
        transition: opacity 1s ease;
        -webkit-transition: opacity 1s ease;
    }

    .responsive-event.slick-initialized {
        visibility: visible;
        opacity: 1;
    }

    .twitter-typeahead {
        display: block !important;
    }

    .tt-menu {
        width: 100%;
    }

    .tt-dataset {
        width: 100% !important;
        padding: 5px;
        background-color: beige;
    }

    .tt-suggestion.tt-selectable {
        padding: 5px;
        border: 1px solid #eee;
        margin-bottom: 2px;
    }

    .tt-suggestion.tt-selectable:hover {
        background-color: #eee;

    }

    .overlay-cities {
        top: 38% !important;
        right: 7% !important;
        position: absolute !important;
    }

    .city-table td {
        padding: 8px 40px;
    }

    .bg-grey1 {
        background-color: #e6e6e6;
    }

    .s009 {
        margin-top: 0px !important;
        padding-top: 100px !important;
        padding-bottom: 100px !important;
        background: url("/storage/{{ setting('site.index_bg') }}");
        align-items: start !important;
    }

    body {
        background-color: #fff;
    }

    /* .responsive-ad .slick-slide {
        width: 250px !important;
    } */

    .responsive-ad .slick-slide img {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .responsive-ad .slick-prev {
        z-index: 1 !important;
    }

    .responsive-ad .slick-next {
        right: 0px !important;
    }


    .responsive-new-project .slick-next {
        right: -25px !important;
    }

    .responsive-new-project .slick-prev {
        left: -25px !important;
        z-index: 1 !important;
    }

    .responsive-agency .slick-next {
        right: -25px !important;
    }

    .responsive-agency .slick-prev {
        left: -25px !important;
        z-index: 1 !important;
    }

    .responsive-agency {
        width: 60% !important;
        margin: auto !important;
    }

    @media (max-width: 1450px) {
        .overlay-cities {
            display: none;
        }
    }

    /* .s009 form {
        margin-left: -1000px !important;
    } */

</style>
@endpush

@section('content')
<div class="s009" style="height: 700px;">
    <div class="container-fluid row">
        <div class="col-md-9">
            <form method="GET" action="{{ URL::to('search') }}" id="searchForm">
                <div class="inner-form">


                    <div class="basic-search">
                        <div class="input-field first-wrap">
                            <div class="input-select" style="height: 100%;">
                                <select data-trigger="" class="custom-select bs-select" name="available_for" required>
                                    <option value="-1">Rent or Buy</option>
                                    <option value="0">Rent</option>
                                    <option value="1">Buy</option>
                                </select>
                            </div>
                        </div>
                        <div class="input-field second-wrap" id="searchQuery">

                            <input id="query" name="query" class="typeahead" type="text" placeholder="Search any Location" style="height: 50px; border-top-left-radius: 0px; border-bottom-left-radius: 0px; " />
                            <div class="icon-wrap" id="searchBtn">
                                <svg class="svg-inline--fa fa-search fa-w-16" fill="#ccc" aria-hidden="true" data-prefix="fas" data-icon="search" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="margin-right: 40px;">
                                    <path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0)" data-toggle="collapse" id="advancedSearchBtn" data-target="#advancedSearch" class="p-2 ml-1" style="
                        position: absolute;
                        color: #000;">
                        Show Advanced Search
                    </a>


                    <div class="advance-search collapse hide" id="advancedSearch" style="background: rgba(250, 250, 250, 0) !important; padding-top: 20px; padding-bottom: 10px;">
                        {{-- <span class="desc">ADVANCED SEARCH</span> --}}
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <label>City</label>
                                <select class="custom-select" name="city" style="width: 100%;" id="city">
                                    <option value="-1" value="">Any</option>
                                    @foreach ($cities as $city)
                                    <option value="{{ $city->tid }}" data-name="{{ $city->name }}">{{ $city->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Scheme/Colony Name</label>
                                <select class="custom-select" name="scheme_colony_name" style="width: 100%;" id="scheme_colony_name">
                                    <option value="-1" value="">Any</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Type</label>
                                <select class="custom-select" name="type" style="width: 100%;">
                                    <option value="-1" value="">Any</option>
                                    @foreach ($propertyTypes as $propertyType)
                                    <optgroup label="{{ $propertyType->type }}">
                                        @forelse ($propertyType->childs as $child)
                                        <option value="{{ $child->tid }}" {{ old('property_type') == $child->tid ? 'selected' : '' }}>
                                            {{ $child->type }}
                                        </option>
                                        @empty
                                        @endforelse
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Bedrooms</label>
                                <select class="custom-select" name="bedrooms" style="width: 100%;">
                                    <option value="-1">Any</option>
                                    @for ($i = 1; $i < 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                    <option value="{{ $i }}">{{ $i }}+</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Bathrooms</label>
                                <select class="custom-select" name="bathrooms" style="width: 100%;">
                                    <option value="-1">Any</option>
                                    @for ($i = 1; $i < 10; $i++)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                    <option value="{{ $i }}">{{ $i }}+</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Area</label>
                                <select class="custom-select" name="area" style="width: 100%;">
                                    <option value="-1">Any</option>
                                    @for ($i = 5; $i < 50; $i+=5)
                                    <option value="{{ $i }}"> > {{ $i }} Marla</option>
                                    @endfor
                                    <option value="{{ $i }}">{{ $i }} Marla < </option>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div style="display: flex;">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text no-tr-radius no-br-radius">Min Price</label>
                                    </div>
                                    <input type="number" min="0" value="0" name="min_price" class="form-control no-radius">
                                    <div class="input-group-append">
                                        <label class="input-group-text no-tl-radius no-bl-radius">PKR</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div style="display: flex;">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text no-tr-radius no-br-radius">Max Price</label>
                                    </div>
                                    <input type="text" value="Any" name="max_price" class="form-control no-radius">
                                    <div class="input-group-append">
                                        <label class="input-group-text no-tl-radius no-bl-radius">PKR</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-md-4 text-right">
                                <div class="group-btn">
                                    <button class="btn btn-danger" id="delete">RESET</button>
                                    <button type="submit" class="btn btn-primary">SEARCH</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3">

            <div class="card" style="width: 70%; background: rgba(255, 255, 255, 0.2);">
                <div class="card-body p-0">
                    <div class="text-center pt-2 pb-2">
                        <b>Popular Cities</b>
                    </div>
                    <table class="m-0 mb-2 city-table">
                        <tbody>
                            @php
                                $cities = $cities->sortByDesc('total_properties')->take(5);
                            @endphp
                            @foreach ($cities as $city)
                            <tr>
                                <td>
                                    <a class="text-dark" href="{{ URL::to("search?available_for=-1&query=&city={$city->tid}&scheme_colony_name=-1&type=-1&bedrooms=-1&bathrooms=-1&area=-1&min_price=0&max_price=Any") }}">
                                        {{ $city->name }}
                                    </a>
                                </td>
                                <td>({{ $city->total_properties }}) </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center pt-2 pb-2">
                        <a href="{{ URL::to('all-cities') }}">
                            View All Cities
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-4 pt-4">
    <div class="row">
        <div class="col-md-12">
            <div id="slidersResultads"></div>
            <div id="slidersResultnew-projects"></div>
            <div id="slidersResultagencies"></div>
        </div>
    </div>
</div>
@endsection

@php
    $colonySchemes = $colonySchemes->pluck('name');
@endphp

@push('script')
<script src="{{ URL::to('/js/typeahead.js') }}"></script>
<script type="text/javascript" src="{{ URL::to('slick/slick.min.js') }}"></script>

<script>

    var p = {
        'agency' : 1,
        'ad' : 1,
        'new-project' : 1
    };

    let sliders = (type, page = 1) => {
        let pageTitle = "";
        if (type == 'agencies')
            pageTitle = 'agencies';
        else if (type == 'ads')
            pageTitle = 'ads';
        else if (type == 'new-projects')
            pageTitle = 'new-projects';


        // $(`#slidersResult${type}`).addClass('div-loader');
        let url = `{{ URL::to('sliders/search') }}/${type}?${pageTitle}-page=${page}`;
        let _token = `{{ csrf_token() }}`;
        let q = $('#query').val();

        let data = {
            q: q,
            _token: _token
        };

        $.post(url, data, function(response) {
            // console.log(response);

            $(`#slidersResult${type}`).html(response);
            // $(`#slidersResult${type}`).removeClass('div-loader');
        });
    }

    let backToPrev = (type) => {
        let pageTitle = "";
        if (type == 'agencies')
            pageTitle = 'agencies';
        else if (type == 'ads')
            pageTitle = 'ads';
        else if (type == 'new-projects')
            pageTitle = 'new-projects';

        p[pageTitle]--;
        sliders(type, p[pageTitle]);
    }


    sliders('agencies');
    sliders('ads');
    sliders('new-projects');

    $(document).ready(function() {

        $('#advancedSearchBtn').on('click', function() {
            var $this = $(this);
            // console.log($this.text().trim());
            if ($this.text().trim() == 'Show Advanced Search') {
                $('#advancedSearchBtn').text('Hide Advanced Search');
            }
            else {
                $('#advancedSearchBtn').text('Show Advanced Search');
            }
        })

        $('#query').keypress(function (e) {
            if (e.which == 13) {
                sliders('agencies');
                sliders('ads');
                sliders('new-projects');

                return false;
            }
        });
    });


    $(document).ready(function() {
        $('#searchBtn').on('click', function () {
            $('form').submit();
        })
    });

    var colonySchemes = @json($colonySchemes);


    var substringMatcher = function(strs) {
        return function findMatches(q, cb) {
            var matches, substringRegex;

            // an array that will be populated with substring matches
            matches = [];

            // regex used to determine if a string contains the substring `q`
            substrRegex = new RegExp(q, 'i');

            // iterate through the pool of strings and for any string that
            // contains the substring `q`, add it to the `matches` array
            $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    matches.push(str);
                }
            });

            cb(matches);
        };
    };


    $('#searchQuery .typeahead').typeahead({
        hint: true,
        highlight: true,
        minLength: 1
    },
    {
        name: 'colonySchemes',
        source: substringMatcher(colonySchemes)
    });


    $('#city').on('change', function() {
        let $this = $(this);
        var city = $('option:selected', $this).attr('data-name');

        $.get(`{{ URL::to('property/city') }}?name=${city}&tid=true`, function(res) {

            let options = "<option value='-1'>Any</option>";
            res.colonySchemes.forEach(option => {
                // console.log(option);
                options += `<option value="${option.tid}" data-name="${option.name}">${option.name}</option>`;
            });
            $('#scheme_colony_name').html(options);

        });
    });

</script>
@endpush

