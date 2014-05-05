<?php
return array(
    'monolog' => array(

    ),
);
//
//keLog::config('logstash', array(
//    'engine' => 'Monolog.Monolog',
//    'channel' => 'app',
//    'handlers' => array(
//        'RotatingFile' => array(
//            LOGS . 'logstash.log',
//            30,
//            'formatters' => array(
//                'Logstash' => array('web', env('SERVER_ADDR'))
//            ),
//            'processors' => array('MemoryPeakUsage')
//        ),
//        'Stream' => array(
//            LOGS . 'logstash.log',
//            'formatters' => array(
//                'Line' => array("%datetime% %channel% %level_name%: %message% %context% %extra%\n")
//            ),
//            'processors' => array('MemoryUsage', 'Web')
//        ),
//        'CakeEmail' => array(
//            'admin@domain.com',
//            'ALERT: APPLICATION REQUIRES IMMEDIATE ATTENTION.',
//            'default'
//        )
//    )
//));