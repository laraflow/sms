@extends('sms::layout')

@section('content')
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $current['date']->format('D, d M Y') }}</h1>
        <div class="btn-toolbar mb-2 mb-md-0 gap-3">
            <button type="button" class="btn btn-sm btn-outline-primary">
                <span data-feather="file"></span>
                Download
            </button>
            <button type="button" class="btn btn-sm btn-outline-danger">
                <span data-feather="file"></span>
                Delete
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover" id="logs">
            <thead>
            <tr class="text-center">
                <th scope="col">Timestamp</th>
                <th scope="col">Vendor</th>
                <th scope="col">Mode</th>
                <th scope="col">Code</th>
                <th scope="col">Response</th>
            </tr>
            </thead>
            <tbody>
            @foreach($current['logs'] as $response)
                <tr>
                    <td>{{ $response['timestamp']->format('D, d M Y h:m:s A') }}</td>
                    <td>{{ $response['vendor'] ?? 'N/A' }}</td>
                    <td>{{ $response['mode'] ?? 'N/A' }}</td>
                    <td>{{ $response['code'] ?? 'N/A' }}</td>
                    <td><code><pre>{{ $response['response'] ?? '{}' }}</pre></code></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
