@extends('voyager::master')

@section('content')
    @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('developer') || auth()->user()->hasRole('bdm-admin'))
    <div class="page-content">
        <div class="container-fluid">

            <h4>Filters</h4>
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="card mini-stats-wid">
                        <div class="card-body"> --}}
                        <form action="{{ URL::to('admin') }}" method="get">
                            <div class="col-md-2">
                                <label>BD</label>
                                <select name="bdm" class="form-control">
                                    <option value="-1">Any</option>
                                    @foreach ($bdms as $bdm)
                                    <option value="{{ $bdm->id }}" {{ request()->get('bdm') == $bdm->id ? 'selected' : '' }}>
                                        {{ $bdm->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Lead Type</label>
                                <select name="lead_type" class="form-control">
                                    <option value="-1">Any</option>
                                    <option value="corporate" {{ request()->get('lead_type') == 'corporate' ? 'selected' : '' }}>Corporate</option>
                                    <option value="individual" {{ request()->get('lead_type') == 'individual' ? 'selected' : '' }}>Individual</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>Job Source</label>
                                <select name="job_source" class="form-control">
                                    <option value="-1">Any</option>
                                    @foreach ($jobSources as $jobSource)
                                    <option value="{{ $jobSource->id }}" {{ request()->get('job_source') == $jobSource->id ? 'selected' : '' }}>
                                        {{ $jobSource->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label>From</label>
                                <input type="date" class="form-control" name="from" placeholder="From" value="{{ request()->get('from') }}">
                            </div>
                            <div class="col-md-2">
                                <label>To</label>
                                <input type="date" name="to" placeholder="To" class="form-control" value="{{ request()->get('to') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 27px">Filter</button>
                            </div>
                        </form>
                        {{-- </div>
                    </div> --}}
                </div>
            </div>

            @php
                $baseUrl = URL::to('/');
                $from = request()->get('from');
                $to = request()->get('to');
                $bdm = request()->get('bdm') ?? '-1';
                $lead_type = request()->get('lead_type') ?? '-1';

                $urlPattern = "{$baseUrl}/sales-engine/reports?query=&from={$from}&to={$to}&profile=-1&phase=-1&technology=-1&bdm={$bdm}&job_source=-1&developer=-1&lead_type={$lead_type}";
            @endphp
            <h4>BDM Leads</h4>
            <div class="row">

                <div class="col-md-2">
                    <a target="_blank" href="{{ "{$urlPattern}&status=-1" }}">
                        <div class="card mini-stats-wid">
                            <div class="card-body" style="background-color: rgba(0,0,255, 0.1);">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Total</p>
                                        <h4 class="mb-0">{{ $_countBdmLeads['total'] }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-2">
                    <a target="_blank" href="{{ "{$urlPattern}&status=0" }}">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Prospects</p>
                                        <h4 class="mb-0">{{ $_countBdmLeads['prospect'] }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-2">
                    <a target="_blank" href="{{ "{$urlPattern}&status=1" }}">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Warm Leads</p>
                                        <h4 class="mb-0">{{ $_countBdmLeads['warmlead'] }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-2">
                    <a target="_blank" href="{{ "{$urlPattern}&status=2" }}">
                        <div class="card mini-stats-wid">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Cold Leads</p>
                                        <h4 class="mb-0">{{ $_countBdmLeads['coldlead'] }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-2">
                    <a target="_blank" href="{{ "{$urlPattern}&status=3" }}">
                        <div class="card mini-stats-wid">
                            <div class="card-body" style="background-color: rgba(0,255,0, 0.1);">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Hired</p>
                                        <h4 class="mb-0">{{ $_countBdmLeads['hired'] }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


                <div class="col-md-2">
                    <a target="_blank" href="{{ "{$urlPattern}&status=4" }}">
                        <div class="card mini-stats-wid">
                            <div class="card-body" style="background-color: rgba(255,0,0, 0.1);">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted font-weight-medium">Rejected</p>
                                        <h4 class="mb-0">{{ $_countBdmLeads['rejected'] }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>


            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title mb-4 float-sm-left">Leads</h4>
                            <div class="float-sm-right">

                            </div>
                            <div class="clearfix"></div>
                            <div id="stacked-column-chart" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title mb-4">Column with Data Labels</h4> --}}

                            <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title mb-4">Dashed Line</h4> --}}

                            <div id="line_chart_dashed" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
            </div>


        </div>
    </div>
    @else
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h4>Welcome to LGS | BDS</h4>
                </div>
            </div>
        </div>
    </div>
    @endif
@stop


@push('javascript')
<script>
    options_dash = {
        chart: {
            height: 380,
            type: "line",
            zoom: {
                enabled: !1
            },
            toolbar: {
                show: !1
            }
        },
        colors: ["#556ee6", "#f46a6a", "#34c38f", "#bf40bf"],
        dataLabels: {
            enabled: !1
        },
        stroke: {
            width: [3, 4, 3, 3],
            curve: "straight",
            dashArray: [0, 8, 5, 5]
        },
        series: [{
            name: "Prospect",
            data: @json($ct_total)
        }, {
            name: "Rejected",
            data: @json($ct_rejected)
        }, {
            name: "Hired",
            data: @json($ct_hired)
        }, {
            name: "Warm Lead",
            data: @json($ct_warmlead)
        }],
        title: {
            text: "Lead Statistics",
            align: "left"
        },
        markers: {
            size: 0,
            hover: {
                sizeOffset: 6
            }
        },
        xaxis: {
            categories: @json($period)
        },
        tooltip: {
            y: [{
                title: {
                    formatter: function(e) {
                        return e
                    }
                }
            }, {
                title: {
                    formatter: function(e) {
                        return e
                    }
                }
            }, {
                title: {
                    formatter: function(e) {
                        return e
                    }
                }
            }, {
                title: {
                    formatter: function(e) {
                        return e
                    }
                }
            }]
        },
        grid: {
            borderColor: "#f1f1f1"
        }
    };
    (chart_dash = new ApexCharts(document.querySelector("#line_chart_dashed"), options_dash)).render();

    options_bar = {
        chart: {
            height: 350,
            type: "bar",
            toolbar: {
                show: !1
            }
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    position: "top"
                }
            }
        },
        dataLabels: {
            enabled: !0,
            formatter: function(e) {
                return e
            },
            offsetY: -20,
            style: {
                fontSize: "12px",
                colors: ["#304758"]
            }
        },
        series: [{
            name: "Prospect",
            data: @json($ct_total)
        }],
        colors: ["#556ee6"],
        grid: {
            borderColor: "#f1f1f1"
        },
        xaxis: {
            categories: @json($period),
            position: "bottom",
            labels: {
                offsetY: 2
            },
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            crosshairs: {
                fill: {
                    type: "gradient",
                    gradient: {
                        colorFrom: "#D8E3F0",
                        colorTo: "#BED1E6",
                        stops: [0, 100],
                        opacityFrom: .4,
                        opacityTo: .5
                    }
                }
            },
            tooltip: {
                enabled: !0,
                offsetY: -35
            }
        },
        fill: {
            gradient: {
                shade: "light",
                type: "horizontal",
                shadeIntensity: .25,
                gradientToColors: void 0,
                inverseColors: !0,
                opacityFrom: 1,
                opacityTo: 1,
                stops: [50, 0, 100, 100]
            }
        },
        yaxis: {
            axisBorder: {
                show: !1
            },
            axisTicks: {
                show: !1
            },
            labels: {
                show: !1,
                formatter: function(e) {
                    return e
                }
            }
        },
        title: {
            text: "Prospect (Leads)",
            floating: !0,
            offsetY: 0,
            align: "center",
            style: {
                color: "#444"
            }
        }
    };
    (chart_bar = new ApexCharts(document.querySelector("#column_chart_datalabel"), options_bar)).render();


    // main chart
    var main_options = {
        chart: {
            height: 359,
            type: "bar",
            stacked: !0,
            toolbar: {
                show: !1
            },
            zoom: {
                enabled: !0
            }
        },
        // plotOptions: {
        //     bar: {
        //         horizontal: !1,
        //         columnWidth: "15%",
        //         endingShape: "rounded"
        //     }
        // },
        dataLabels: {
            enabled: !1,
            formatter: function(e) {
                return e
            },
            offsetY: 0,
            style: {
                fontSize: "12px"
            }
        },
        series: [{
            name: "Prospect",
            data: @json($bdms->pluck('prospect_bdm_leads_count'))
        }, {
            name: "Warm Leads",
            data: @json($bdms->pluck('warm_lead_bdm_leads_count'))
        }, {
            name: "Rejected",
            data: @json($bdms->pluck('rejected_bdm_leads_count'))
        }],
        xaxis: {
            categories: @json($bdms->pluck('name'))
        },
        colors: ["#556ee6", "#f1b44c", "#ff0000"],
        legend: {
            position: "bottom"
        },
        fill: {
            opacity: 1
        }
    },
    main_chart = new ApexCharts(document.querySelector("#stacked-column-chart"), main_options);
    main_chart.render();

</script>
@endpush
