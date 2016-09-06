<?php

namespace Nadeo\Live\ManiaDirect\Core\XmlrpcScriptCallbackDispatcher;

class XmlrpcScriptCallbackDispatcherEvents
{
    const BEGIN_MATCH = 'xmlrpc.begin_match';
    const BEGIN_ROUND = 'xmlrpc.begin_round';
    const BEGIN_TURN = 'xmlrpc.begin_turn';
    const BEGIN_MAP = 'xmlrpc.begin_map';

    const END_MATCH = 'xmlrpc.end_match';
    const END_ROUND = 'xmlrpc.end_round';
    const END_TURN = 'xmlrpc.end_turn';
    const END_MAP = 'xmlrpc.end_map';

    const ON_HIT = 'xmlrpc.on_hit';
}
