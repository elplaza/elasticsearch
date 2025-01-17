<div id="tabs" role="tabpanel">
    <?php if (isset($Result['path'])) :
        $pathElementCount = count($Result['path'])-1;
        if ($pathElementCount >= 0): ?>
            <div id="path-container" style="margin-left: -8px;margin-right: -7px" ng-non-bindable>
                <ul class="breadcrumb rounded-0 border-bottom p-2 mb-0" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
                    <li class="breadcrumb-item"><a rel="home" itemprop="url" href="<?php echo erLhcoreClassDesign::baseurl()?>"><span itemprop="title"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('pagelayout/pagelayout','Home')?></span></a></li>
                    <?php foreach ($Result['path'] as $key => $pathItem) : if (isset($pathItem['url']) && $pathElementCount != $key) { ?><li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo $pathItem['url']?>" itemprop="url"><span itemprop="title"><?php echo htmlspecialchars(htmlspecialchars_decode($pathItem['title'],ENT_QUOTES))?></span></a></li><?php } else { ?><li class="breadcrumb-item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo htmlspecialchars(htmlspecialchars_decode($pathItem['title'], ENT_QUOTES))?></span></li><?php }; ?><?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    <?php endif;?>

    <div class="tab-content pl-2">
        <div role="tabpanel" class="tab-pane active" id="chats">
            <?php include(erLhcoreClassDesign::designtpl('elasticsearch/parts/filter_mail.tpl.php')); ?>

                <?php if (isset($pages) && $pages->items_total > 0): ?>
                    <table class="table table-sm mt-1">
                        <thead>
                        <tr>
                            <th width="40%"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Conversation ID')?></th>
                            <th width="20%"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Sender')?></th>
                            <th width="20%"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Highlight')?></th>
                            <th width="1%" nowrap><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Priority')?></th>
                            <th width="1%" nowrap><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Operator')?></th>
                            <th width="1%"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Department')?></th>
                            <th width="1%"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Status')?></th>
                            <th width="1%"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','Time')?></th>
                            <th width="1%"></th>
                        </tr>
                        </thead>
                        <?php $previousConversationId = 0; foreach ($items as $item) : ?>
                            <tr class="<?php if ($previousConversationId == $item->conversation_id) : ?>bg-light conversation-id-<?php echo $item->conversation_id?><?php endif;?>" <?php if ($previousConversationId == $item->conversation_id) : ?>style="display: none" <?php endif;?>>
                                <td title="<?php echo $item->id?>" class="<?php if ($previousConversationId == $item->conversation_id) : ?>pl-4<?php endif;?>">

                                    <?php if ($item->has_many_messages && ($previousConversationId == 0 || $previousConversationId != $item->conversation_id)) : ?>
                                    <a class="material-icons text-primary mr-0" onclick="$('.conversation-id-<?php echo $item->conversation_id?>').toggle()">expand_more</a>
                                    <?php endif;?>

                                    <?php if ($item->undelivered == 1) : ?>
                                        <span title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','Undelivered e-mail');?>" class="text-danger material-icons">sms_failed</span>
                                    <?php endif; ?>
                                    
                                    <?php if ($item->follow_up_id > 0) : ?>
                                        <span class="material-icons" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','Follow up e-mail');?>">follow_the_signs</span>
                                    <?php endif; ?>

                                    <?php if ($item->start_type == erLhcoreClassModelMailconvConversation::START_OUT) : ?>
                                        <i class="material-icons">call_made</i>
                                    <?php else : ?>
                                        <i class="material-icons">call_received</i>
                                    <?php endif; ?>

                                    <?php if ($item->has_attachment == erLhcoreClassModelMailconvConversation::ATTACHMENT_MIX) : ?>
                                        <span class="material-icons">attach_file</span><span class="material-icons">image</span>
                                    <?php elseif ($item->has_attachment == erLhcoreClassModelMailconvConversation::ATTACHMENT_FILE) : ?>
                                        <span class="material-icons">attach_file</span>
                                    <?php elseif ($item->has_attachment == erLhcoreClassModelMailconvConversation::ATTACHMENT_INLINE) : ?>
                                        <span class="material-icons">image</span>
                                    <?php endif; ?>

                                    <a onclick="lhc.previewMail(<?php echo $item->conversation_id?>);" class="material-icons">info_outline</a>

                                    <a class="action-image material-icons" data-title="<?php echo htmlspecialchars($item->subject)?>" onclick="lhinst.startMailNewWindow(<?php echo $item->conversation_id?>,$(this).attr('data-title'))" >open_in_new</a>

                                    <span class="mr-2">
                                    <?php echo $item->conversation_id?>
                                    </span>

                                    <a class="user-select-none" href="<?php echo erLhcoreClassDesign::baseurl('mailconv/view')?>/<?php echo $item->conversation_id?>"><?php echo htmlspecialchars(erLhcoreClassDesign::shrt($item->subject,50))?></a>

                                    <?php if (erLhcoreClassUser::instance()->hasAccessTo('lhelasticsearch','configure')) : ?>
                                        <a title="Raw information" href="<?php echo erLhcoreClassDesign::baseurl('elasticsearch/rawmail')?>/<?php echo $item->meta_data['index']?>/<?php echo $item->id?>"><i class="material-icons">&#xE86F;</i></a>
                                    <?php endif; ?>

                                </td>
                                <td ng-non-bindable>
                                    <?php echo htmlspecialchars(erLhcoreClassDesign::shrt($item->from_name.' <'.$item->from_address.'>',30))?>
                                </td>
                                <td ng-non-bindable>
                                    <?php if (isset($item->meta_data['highlight'])) : ?>
                                        <div class="abbr-list-general">
                                            <?php foreach ($item->meta_data['highlight'] as $field => $fields) : $highlightText = erLhcoreClassBBCode::make_clickable(htmlspecialchars(str_replace(array('<em>','</em>'),array('[mark]','[/mark]'),implode($fields,"\n")))); ?>
                                                <div>
                                                    <?php if ($field == 'subject') : ?>
                                                        <i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','Subject');?>:</i>
                                                    <?php else : ?>
                                                        <i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','Body');?>:</i>
                                                    <?php endif; ?>
                                                    <?php echo $highlightText;?></div>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td ng-non-bindable>
                                    <?php echo $item->priority?>
                                </td>
                                <td ng-non-bindable nowrap="">
                                    <?php echo htmlspecialchars($item->conv_user instanceof erLhcoreClassModelUser ? (string)$item->conv_user : ($item->conv_user_id > 0 ? $item->conv_user_id : ''))?>
                                </td>
                                <td nowrap="" ng-non-bindable>
                                    <?php echo htmlspecialchars($item->department),', ',htmlspecialchars($item->mailbox_front['mail'])?>
                                </td>
                                <td nowrap="nowrap">
                                    <?php if ($item->status_conv == erLhcoreClassModelMailconvConversation::STATUS_PENDING) : ?>
                                        <i class="material-icons chat-pending">mail_outline</i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','New');?>
                                    <?php elseif ($item->status_conv == erLhcoreClassModelMailconvConversation::STATUS_ACTIVE) : ?>
                                        <i class="material-icons chat-active">mail_outline</i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','Active');?>
                                    <?php elseif ($item->status_conv == erLhcoreClassModelMailconvConversation::STATUS_CLOSED) : ?>
                                        <i class="material-icons chat-closed">mail_outline</i><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('module/mailconvconv','Closed');?>
                                    <?php endif; ?>
                                </td>
                                <td nowrap="nowrap"><?php echo date(erLhcoreClassModule::$dateDateHourFormat, $item->time/1000)?></td>
                                <?php if (erLhcoreClassUser::instance()->hasAccessTo('lhelasticsearch','configure')) : ?>
                                    <td title="<?php echo htmlspecialchars($item->meta_data['index'])?>">
                                        <a class="btn btn-danger btn-xs csfr-required" onclick="return confirm('<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('kernel/messages','Are you sure?');?>')" href="<?php echo erLhcoreClassDesign::baseurl('elasticsearch/deletemail')?>/<?php echo $item->meta_data['index']?>/<?php echo $item->id?>"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('user/userlist','Delete');?></a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php $previousConversationId = $item->conversation_id; endforeach; ?>
                    </table>

                    <?php include(erLhcoreClassDesign::designtpl('lhkernel/secure_links.tpl.php')); ?>

                    <?php include(erLhcoreClassDesign::designtpl('lhkernel/paginator.tpl.php')); ?>

                <?php else: ?>

                    <br>
                    <div class="alert alert-info"><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('elasticsearch/admin','No records were found or search was not executed yet!')?></div>

                <?php endif; ?>

        </div>
    </div>

</div>