<?php

use App\UdsuServices\DataService\DataServiceFactory;

return [
    DataServiceFactory::class => [
        'auth' => [
            'request_url'       => 'https://io.udsu.ru/uio/portal_iias.auth?p_login=%&p_password=%&p_who=moodle',
            'exchange_format'   => 'xml',
            'data_type'         => 'object',
            'encoding'          => 'Windows-1251'
        ],
        'user_data' => [
            'request_url'       => 'http://as11g.udsu.ru/libgate/l_serv.slct?p_qkod=UDSUMOD01&p_pars=p_pers_id=',
            'exchange_format'   => 'xml',
            'data_type'         => 'object',
        ],
    ],
];
