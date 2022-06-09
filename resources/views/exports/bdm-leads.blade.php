<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Export Excel</title>
    </head>
    <body>
        <table>
            <thead>
                <tr role="row">
                    <th >Created At</th>
                    <th >Company Name</th>
                    <th >Job Title</th>
                    <th >Job Source</th>
                    <th >Assign To</th>
                    <th >Profile</th>
                    <th >Status</th>
                    <th >Phase</th>
                    <th >Agent (BD) </th>
                    <th >Tech Stack </th>
                    <th >Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                <tr>
                    <td>
                        <span class="small text-muted">
                            {{ $lead->created_at }}
                        </span>
                    </td>
                    <td>
                        {{ $lead->company_name }}
                    </td>
                    <td>{{ $lead->job_title }} </td>
                    <td>{{ $lead->jobSource->name ?? '' }} </td>
                    <td>{{ $lead->developer->developer->name ?? '' }} </td>
                    <td>{{ $lead->profile->name ?? '' }} </td>
                    <td>
                        @if ($lead->status == 0)
                        Prospect
                        @elseif ($lead->status == 1)
                        Warm Lead
                        @elseif ($lead->status == 2)
                        Cold Lead
                        @elseif ($lead->status == 3)
                        Hired
                        @elseif ($lead->status == 4)
                        Rejected
                        @endif
                    </td>
                    <td>
                        @if ($lead->phase == 0)
                        Prospect
                        @elseif ($lead->phase == 1)
                        Initial Correspondence
                        @elseif ($lead->phase == 2)
                        Follow-up
                        @elseif ($lead->phase == 3)
                        Pre-call Test
                        @elseif ($lead->phase == 4)
                        Post-call Test
                        @elseif ($lead->phase == 5)
                        1st Interview
                        @elseif ($lead->phase == 6)
                        2nd Interview
                        @elseif ($lead->phase == 7)
                        3rd Interview
                        @elseif ($lead->phase == 8)
                        4th Interview
                        @elseif ($lead->phase == 9)
                        Final Interview
                        @elseif ($lead->phase == 10)
                        Reference Check
                        @elseif ($lead->phase == 11)
                        Contract Awaited
                        @elseif ($lead->phase == 12)
                        Contract Recieved
                        @elseif ($lead->phase == 13)
                        Contract Signed & Sent
                        @elseif ($lead->phase == 14)
                        Hired
                        @elseif ($lead->phase == 15)
                        Rejected
                        @elseif ($lead->phase == 16)
                        Dormant
                        @endif
                    </td>
                    <td>{{ $lead->bdm->name ??'' }} </td>
                    <td>
                        @foreach ($lead->techs as $technology)
                        <span class="badge badge-pill badge-primary">
                            {{ $technology->name ?? '' }}
                        </span>
                        @endforeach
                    </td>
                    <td>
                        {{ $lead->notes }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
