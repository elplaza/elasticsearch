<?php

$esOptions = erLhcoreClassModelChatConfig::fetch('elasticsearch_options');
$dataOptions = (array)$esOptions->data;

if (isset($dataOptions['disable_es']) && $dataOptions['disable_es'] == 1) {
    echo json_encode(array('result' => ''));
    exit;
}

$chat = erLhcoreClassModelChat::fetch($Params['user_parameters']['chat_id']);

$tpl = erLhcoreClassTemplate::getInstance('elasticsearch/getpreviouschats.tpl.php');

if ($chat->nick != '' && $chat->nick != 'Visitor' && $chat->nick != 'undefined') {

    $sparams['body']['query']['bool']['must'][]['term']['nick_keyword'] = $chat->nick;

    erLhcoreClassChatEventDispatcher::getInstance()->dispatch('elasticsearch.getpreviouschats', array(
        'chat' => $chat,
        'sparams' => & $sparams
    ));

    try {
        $previousChats = erLhcoreClassModelESChat::getList(array(
            'offset' => 0,
            'limit' => 50,
            'body' => array_merge(array(
                'sort' => array(
                    'time' => array(
                        'order' => 'desc'
                    )
                )
            ), $sparams['body'])
        ));
    } catch (Exception $e) {
        error_log($e->getMessage() . "\n" . $e->getTraceAsString());
        $previousChats = array();
    }

    $chatIds = array();

    foreach ($previousChats as $prevChat) {
        $chatIds[$prevChat->chat_id] = array();
    }

    erLhcoreClassChatArcive::setArchiveAttribute($chatIds);
    
    $tpl->set('chatsPrevArchives', $chatIds);

    $tpl->set('chatsPrev', $previousChats);
} else {
    $tpl->set('chatsPrev', array());
}

$tpl->set('chat', $chat);

echo json_encode(array('result' => $tpl->fetch()));
exit;

?>