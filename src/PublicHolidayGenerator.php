<?php

namespace PublicHolidays;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use PublicHolidays\Entities\PublicHoliday;

class PublicHolidayGenerator
{
    public function update()
    {
        $years = $this->loadYearsData();

        // gather this years public holidays
        $this->query(
            $years->firstWhere('name', 'Australian Public Holidays '.now()->format('Y'))
        );

        // try to gather next years holidays
        $this->query(
            $years->firstWhere('name', 'Australian Public Holidays '.now()->addYear()->format('Y'))
        );
    }

    protected function loadYearsData()
    {
        $response = Http::acceptJson()->get(config('public-holidays.data_url'))->json();

        return collect($response['aspects']['dataset-distributions']['distributions'] ?? [])->map(function ($dataSet) {
            return (object) [
                'id' => $dataSet['aspects']['ckan-resource']['id'] ?? null,
                'name' => $dataSet['aspects']['ckan-resource']['name'] ?? null,
            ];
        });
    }

    protected function query($year)
    {
        if (! $year) {
            return;
        }

        $response = Http::acceptJson()->get(config('public-holidays.query_url').$year->id)->json();

        collect($response['result']['records'] ?? [])->transform(function ($record) {
            PublicHoliday::updateOrCreate([
                'date' => Carbon::createFromFormat('Ymd', $record['Date']),
                'name' => $record['Holiday Name'],
                'state' => Str::upper($record['Jurisdiction']),
            ], [
                'description' => $record['Information'],
            ]);
        });
    }
}
