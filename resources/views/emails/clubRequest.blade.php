<div>
    <h1>{{ config('app.name', 'Laravel') }}</h1>
    <p>New club registration requested</p>
    <table>
        <tbody>
        <tr>
            <td>Club Name</td>
            <td>{{ $clubReg->clubName  }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>{{ $clubReg->email  }}</td>
        </tr>
        <tr>
            <td>Phone</td>
            <td>{{ $clubReg->phone  }}</td>
        </tr>
        <tr>
            <td>Subject</td>
            <td>{{ $clubReg->subject  }}</td>
        </tr>
        <tr>
            <td>Contact Person</td>
            <td>{{ $clubReg->contactPerson  }}</td>
        </tr>
        <tr>
            <td>Message</td>
            <td>{{ $clubReg->message  }}</td>
        </tr>
        </tbody>
    </table>
</div>
