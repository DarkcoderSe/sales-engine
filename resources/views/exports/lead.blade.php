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
                <tr>
                    <th>Company Name</th>
                    <th>Company LinkedIn Profile</th>
                    {{-- <th>Company Website URL</th> --}}
                    <th>Platform</th>
                    <th>Job Source</th>
                    <th>Job Description</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>LinkedIn Profile</th>
                    <th>Job Title</th>
                    <th>Email Address</th>
                    <th>Email Status</th>
                    <th>HQ City</th>
                    <th>State</th>
                    <th>Timezone</th>
                    <th>Attractions</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead['company_name'] }} </td>
                    <td>{{ $lead['company_linkedin_url'] }} </td>
                    <td>{{ $lead['job_type'] }} </td>
                    <td>{{ $lead['job_source_url'] }} </td>
                    <td>{{ $lead['job_description'] }} </td>
                    <td>
                        {{ $lead['first_name'] }}
                    </td>
                    <td>
                        {{ $lead['last_name'] }}
                    </td>
                    <td>{{ $lead['linkedin_profile'] }} </td>
                    <td>{{ $lead['job_title'] }} </td>
                    <td>{{ $lead['email'] }} </td>
                    <td>{{ $lead['email_status'] }} </td>
                    <td>{{ $lead['city'] }} </td>
                    <td>{{ $lead['state'] }} </td>
                    <td>{{ $lead['timezone'] }}</td>
                    <td>{{ $lead['attractions'] }} </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
