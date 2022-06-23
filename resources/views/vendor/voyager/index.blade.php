@extends('voyager::master')

@section('content')
    @if (auth()->user()->hasRole('super-admin') || auth()->user()->hasRole('developer'))
    <div class="page-content">
        <div class="container-fluid">

            <h4>Filters</h4>
            <div class="row">
                <div class="col-md-12">
                    {{-- <div class="card mini-stats-wid">
                        <div class="card-body"> --}}
                        <form action="{{ URL::to('admin') }}" method="get">
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <label>From</label>
                                <input type="date" class="form-control" name="from" placeholder="From" value="{{ request()->get('from') }}">
                            </div>
                            <div class="col-md-3">
                                <label>To</label>
                                <input type="date" name="to" placeholder="To" class="form-control" value="{{ request()->get('to') }}">
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top: 27px">Filter</button>
                            </div>
                        </form>
                        {{-- </div>
                    </div> --}}
                </div>
            </div>

            <h4>BDM Leads</h4>
            <div class="row">

                <div class="col-md-2">
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
                </div>

                <div class="col-md-2">
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
                </div>

                <div class="col-md-2">
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
                </div>

                <div class="col-md-2">
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
                </div>

                <div class="col-md-2">
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
                </div>


                <div class="col-md-2">
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
                </div>


            </div>
            <!-- end row -->


            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h4 class="card-title mb-4">Column with Data Labels</h4> --}}

                            <div id="column_chart_datalabel" class="apex-charts" dir="ltr"></div>
                        </div>
                    </div><!--end card-->
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
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
    options = {
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
    (chart = new ApexCharts(document.querySelector("#line_chart_dashed"), options)).render();

    options = {
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
            position: "top",
            labels: {
                offsetY: -18
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
            offsetY: 320,
            align: "center",
            style: {
                color: "#444"
            }
        }
    };
    (chart = new ApexCharts(document.querySelector("#column_chart_datalabel"), options)).render();
</script>
@endpush
