<?php
    $isEnabledElasticUsername = (int)erLhcoreClassModelChatConfig::fetch('elasticsearch_options')->data['use_es_prev_chats'];
    $isElasticDisabled = (int)erLhcoreClassModelChatConfig::fetch('elasticsearch_options')->data['disable_es'];
?>
<?php if ($isEnabledElasticUsername == true && $isElasticDisabled == false) : ?>
<li role="presentation"><a href="#online-user-info-eschats-tab-<?php echo $chat->id?>" aria-controls="online-user-info-eschats-tab-<?php echo $chat->id?>" role="tab" data-toggle="tab" title="Chats" aria-expanded="true"><i class="material-icons mr-0">chat</i></a></li>
<?php endif; ?>