<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Report - {{ config('settings.appTitle','') }}</title>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
        @yield('stylesheet')
    </head>
    <body>
    <div class="container px-5 py-2">
    	@include('admin.layouts.report_header')
        <h3 class="text-center">@yield('title')</h3>
        <table class="from-to" style="width: 100%">
            <tr>
                <td>From: {{date_format(date_create(Session::get('startDate')),'d-M-Y') }}</td>
                <td>To: {{date_format(date_create(Session::get('endDate')),'d-M-Y') }}</td>

                <td class="no-print">
                    <button type="button" onclick="window.print()" class="btn btn-default"><span class="glyphicon glyphicon-print"> Print</button>
                </td>
                <td class="text-right">Print Date Time: @php echo date('d-M-Y h:i:s A') @endphp</td>
            </tr>
        </table>
		@yield('report')
    </div>
    @yield('scripts')
    </body>
</html>
