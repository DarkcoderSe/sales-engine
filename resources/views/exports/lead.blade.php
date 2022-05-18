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
                    <th>Company URL</th>
                    <th>Source</th>
                    <th>Contact Name</th>
                    <th>LinkedIn Profile</th>
                    <th>Job Title</th>
                    <th>Email</th>
                    <th>Headquater Address</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leads as $lead)
                <tr>
                    <td>{{ $lead->company_name }} </td>
                    <td>{{ $lead->company_url }} </td>
                    <td>{{ $lead->job_source_url }} </td>
                    <td>{{ $lead->contact_name }} </td>
                    <td>{{ $lead->linkedin_profile }} </td>
                    <td>{{ $lead->job_title }} </td>
                    <td>{{ $lead->email }} </td>
                    <td>{{ $lead->headquater_address }} </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>
