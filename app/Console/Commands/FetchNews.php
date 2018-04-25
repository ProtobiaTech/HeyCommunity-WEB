<?php

namespace App\Console\Commands;

use App\News;
use Illuminate\Console\Command;

class FetchNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $api = 'http://jisunews.market.alicloudapi.com/news/search?keyword=中国';
        $api = env('FETCH_NEWS_API', $api);
        $headers = ['Authorization' => 'APPCODE ' . env('FETCH_NEWS_APPCODE', 'null')];

        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('GET', $api, [
                'headers'   =>  $headers,
            ]);
        } catch (\GuzzleHttp\Exception\RequestException $exception) {
            echo $exception;
            report($exception);
            return false;
        }


        if ($response->getStatusCode() == 200) {
            $content = $response->getBody()->getContents();
            $data = json_decode($content)->result->list;

            foreach ($data as $index => $news) {
                $newsData = [
                    'origin'        =>  $news->src,
                    'category'      =>  $news->category,
                    'title'         =>  $news->title,
                    'content'       =>  $news->content,
                    'avatar'        =>  $news->pic,
                    'gallery'       =>  $news->gallery,
                    'url'           =>  $news->url,
                    'weburl'        =>  $news->weburl,
                    'time'          =>  $news->time,
                ];

                News::updateOrCreate($newsData);
            }
        }
    }
}
