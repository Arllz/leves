<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ESInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'nit laravel es for post';

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
     * @return int
     */
    public function handle()
    {
        try{
            //创建template
            $client = new \GuzzleHttp\Client(); //这里的Clinet()是你vendor下的GuzzleHttp下的Client文件
            $this->createTemplate($client);
            echo '<br>============create template success============<br>';
            $this->createIndex($client);
            echo '<br>============create index success============<br>';
        }catch (\Exception $e){
            var_dump($e->getMessage());
        }

    }

    private function createTemplate($client)
    {
        $url = config('scout.elasticsearch.hosts')[0] . 'template/template_1';
        // $client->delete($url);
        echo $url;
        $client->post($url, [
            'json' => [
                'index_patterns' => [config('scout.elasticsearch.index') . '*','20*'],
                #'index_patterns' => [ 'qifeng*'],
                'settings' => [
                    'number_of_shards' => 1,
                ],
                'mappings' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'mapping' => [ // 字段的处理方式
                            'type' => 'keyword', // 字段类型限定为 string
                            'fields' => [
                                'raw' => [
                                    'type' => 'keyword',
                                    'ignore_above' => 256, // 字段是索引时忽略长度超过定义值的字段。
                                ]
                            ],
                        ],
                    ],

                ],
            ],
        ]);
    }

    /**
     * 创建索引
     * @param Client $client
     */
    private function createIndex($client)
    {
        $url = config('scout.elasticsearch.hosts')[0] . config('scout.elasticsearch.index');
        echo 33;
        // $client->delete($url);
        $client->put($url, [
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 1, // 分片为
                    'number_of_replicas' => 0, // 副本数
                ],
            ],
        ]);
    }
}
