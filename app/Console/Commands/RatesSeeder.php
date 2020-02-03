<?php

namespace App\Console\Commands;

use App\Models\Rate;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class RatesSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rates:seeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var
     */
    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client   =   new Client();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(): void
    {
        $response   =   $this->client->request('GET', 'https://currate.ru/api/',
            [
                'query' =>  [
                    'get'       =>  'rates',
                    'pairs'     =>  'EURUSD,BTCUSD',
                    'key'       =>  '5450f7aee618a0368a7b095ac47aac65'
                ]
            ]
        );
        $responseData   =   json_decode($response->getBody()->getContents(), true);
        $pairs          =   $responseData['data'];
        foreach ($pairs as $key => $value) {
            Rate::query()->create(
                [
                    'pair'  =>  $key,
                    'value' =>  $value
                ]
            );
        }
    }
}
