<?php

namespace Laraflow\Sms\Controllers;

use Carbon\CarbonImmutable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SmsLogController extends Controller
{
    public Collection $entries;

    public function __construct()
    {
        $this->entries = collect();

        $this->loadEntries();
    }

    private function loadEntries(): void
    {
        foreach (Storage::disk('log')->files() as $file) {
            if (!str_contains($file, 'sms-')) {
                continue;
            }

            $date = CarbonImmutable::createFromFormat('Y-m-d', preg_replace('/sms-(\d{4}-\d{2}-\d{2})\.log/i', '$1', $file));

            $this->entries->put($date->format('Y-m-d'), [
                'position' => now()->diffInDays($date),
                'file' => $file,
                'date' => $date,
                'size' => Storage::disk('log')->size($file),
                'modified_at' => CarbonImmutable::parse(Storage::disk('log')->lastModified($file)),
            ]);
        }

        $this->entries = $this->entries->sortBy('position');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $current = $request->has('date') ? $this->entries->get($request->input('date')) : $this->entries->first();

        if (!$current) {
            throw (new ModelNotFoundException())->setModel('SmsLog', $request->input('date', now()->format('Y-m-d')));
        }

        $current['logs'] = $this->parseFileContent($current['file']);

        return view('sms::index', [
            'entries' => $this->entries,
            'current' => $current
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function download(string $date)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    private function parseFileContent(string $file): Collection
    {
        $file = Storage::disk('log')->readStream($file);

        $entries = collect();

        while (!feof($file)) {
            $item = $this->parseLine(fgets($file));

            if (!empty($item)) {
                $entries->push($item);
            }
        }

        return $entries->sortBy('position');
    }

    private function parseLine(string $line): array
    {
        $pattern = '/\[(\d{4}-\d{2}-\d{2}\s\d{2}:\d{2}:\d{2})\] .*\.INFO:\sResponse:\s+(.*)/';

        $matches = [];

        preg_match($pattern, $line, $matches);

        $data = [];

        if (!empty($matches)) {

            $timestamp = CarbonImmutable::parse($matches[1] ?? null, 'Asia/Dhaka');

            $data['position'] = now()->diffInSeconds($timestamp);
            $data['timestamp'] = $timestamp;

            $response = json_decode($matches[2] ?? '{}', true);
            $data['vendor'] = Str::studly($response['vendor'] ?? 'N/A');
            $data['mode'] = Str::studly($response['mode'] ?? 'N/A');
            $data['code'] = Str::studly($response['status_code'] ?? 'N/A');
            $data['response'] = json_encode($response['response'] ?? [], JSON_PRETTY_PRINT);
        }

        return $data;
    }
}
