<?php

namespace App\Console\Commands;

use App\Models\Launch;
use App\Models\LaunchServiceProvider;
use App\Models\Location;
use App\Models\Mission;
use App\Models\Orbit;
use App\Models\Pad;
use App\Models\Rocket;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TheSpaceDevsLaunchImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'the-space-devs:launch-import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $total = Launch::count('uuid');
        $maxItems = 2000;
        $limit = 100;
        $limit = ($total < $maxItems - $limit) ? 100 :  $maxItems - $total;

        if($total === $maxItems) {
            return $this->info('All launches imported');
        }

        $request = Http::get('https://ll.thespacedevs.com/2.0.0/launch', ['limit' => $limit, 'offset' => $total]);
        $body = $request->json();

        if(array_key_exists('detail', $body)) {
            return $this->error($body['detail']);
        }

        $this->info(sprintf('Importing %s launches, have already imported %s', count($body['results']), $total));

        foreach ($body['results'] as $item) {
            $mission = null;

            unset($item['status']);

            $provider = LaunchServiceProvider::firstOrNew(['id' => $item['launch_service_provider']['id']]);
            if(!$provider->exists) {
                $provider->fill($item['launch_service_provider']);
                $provider->save();
            }
            unset($item['launch_service_provider']);

            $rocket = Rocket::firstOrNew(['id' => $item['rocket']['id']]);
            if(!$rocket->exists) {
                $rocket->fill($item['rocket']);
                $configuration = $item['rocket']['configuration'];
                $rocket->name = $configuration['name'];
                $rocket->family = $configuration['family'];
                $rocket->variant = $configuration['variant'];
                $rocket->save();
            }
            unset($item['rocket']);

            if(!blank($item['mission'])) {
                $orbit = Orbit::firstOrNew(['id' => $item['mission']['orbit']['id']]);
                if(!$orbit->exists) {
                    $orbit->fill($item['mission']['orbit']);
                    $orbit->save();
                }
                unset($item['mission']['orbit']);

                $mission = Mission::firstOrNew(['id' => $item['mission']['id']]);
                if(!$mission->exists) {
                    $mission->fill($item['mission']);
                    $mission->orbit_id = $orbit->getKey();
                    $mission->save();
                }
                unset($item['mission']);
            }

            $location = Location::firstOrNew(['id' => $item['pad']['location']['id']]);
            if(!$location->exists) {
                $location->fill($item['pad']['location']);
                $location->save();
            }
            unset($item['pad']['location']);

            $pad = Pad::firstOrNew(['id' => $item['pad']['id']]);
            if(!$pad->exists) {
                $pad->fill($item['pad']);
                $pad->location_id = $location->getKey();
                $pad->save();
            }
            unset($item['pad']);

            $launch = Launch::firstOrNew(['uuid' => $item['id']]);
            $launch->launch_provider_id = $provider->getKey();
            $launch->pad_id = $pad->getKey();
            $launch->mission_id = $mission?->getKey();
            $launch->rocket_id = $rocket->getKey() ?: null;
            $launch->name = $item['name'];
            $launch->slug = $item['slug'];
            $launch->net = Carbon::parse($item['net']);
            $launch->window_start = Carbon::parse($item['window_start']);
            $launch->window_end = Carbon::parse($item['window_end']);
            $launch->url = $item['url'];
            $launch->imported_t = Carbon::now();
            $launch->inhold = $item['inhold'];
            $launch->webcast_live = $item['webcast_live'];
            $launch->image = $item['image'];
            $launch->infographic = $item['infographic'];
            $launch->program = $item['program'];
            $launch->save();
        }
    }
}
