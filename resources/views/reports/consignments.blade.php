<h2>Consignments Report</h2>

<table border="1" width="100%" cellspacing="0" cellpadding="5">
    <thead>
    <tr>
        <th>Code</th>
        <th>Date</th>
        <th>Route</th>
        <th>Horse</th>
        <th>Driver</th>
        <th>Total Cost</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $row)
        <tr>
            <td>{{ $row['code'] }}</td>
            <td>{{ $row['date'] }}</td>
            <td>{{ $row['route'] }}</td>
            <td>{{ $row['horse'] }}</td>
            <td>{{ $row['driver'] }}</td>
            <td>{{ number_format($row['total_cost']) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
