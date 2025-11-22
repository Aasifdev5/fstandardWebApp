<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ChambeadorProfile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodeChambeadorProfiles extends Command
{
    protected $signature = 'chambeador:geocode';
    protected $description = 'Geocode chambeador profile addresses to lat/lng';

    public function handle()
    {
        $apiKey = env('GOOGLE_MAPS_API_KEY'); // Add to .env
        $profiles = ChambeadorProfile::whereNull('lat')->orWhereNull('lng')->get();

        foreach ($profiles as $profile) {
            if (empty($profile->address)) {
                Log::warning('No address for profile', ['uid' => $profile->uid]);
                continue;
            }

            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $profile->address,
                'key' => $apiKey,
            ]);

            if ($response->successful() && $response->json()['status'] === 'OK') {
                $location = $response->json()['results'][0]['geometry']['location'];
                $profile->update([
                    'lat' => $location['lat'],
                    'lng' => $location['lng'],
                ]);
                Log::info('Geocoded profile', [
                    'uid' => $profile->uid,
                    'address' => $profile->address,
                    'lat' => $location['lat'],
                    'lng' => $location['lng'],
                ]);
            } else {
                Log::error('Geocoding failed', [
                    'uid' => $profile->uid,
                    'address' => $profile->address,
                    'response' => $response->json(),
                ]);
            }
        }

        $this->info('Geocoding complete.');
    }
}
