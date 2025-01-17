
<form action="<?php echo erLhcoreClassDesign::baseurl('elasticsearch/listmail')?>" autocomplete="off" method="get" name="SearchFormRight" ng-non-bindable>
    <input type="hidden" name="ds" value="1">
    <div class="row">

        <div class="col-md-1">
            <div class="form-group">
                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Conversation ID');?></label>
                <input type="text" class="form-control form-control-sm" name="conversation_id" value="<?php echo htmlspecialchars($input->conversation_id)?>" />
            </div>
        </div>

        <div class="col-md-2">
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Keyword messages');?></label>
            <div class="input-group input-group-sm">
                <input type="text" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Search in Subject or Body or selected fields');?>" class="form-control form-control-sm" name="keyword" value="<?php echo htmlspecialchars($input->keyword)?>" />
                <div class="input-group-append ">
                    <button class="btn dropdown-toggle btn-outline-secondary border-secondary-control" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="material-icons">settings</span></button>
                    <div class="dropdown-menu">
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(1,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="1" /> Subject</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(2,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="2" /> Body</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(3,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="3" /> From name</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(4,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="4" /> Sender name</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(5,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="5" /> Delivery status</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(6,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="6" /> Undelivered mail body</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(7,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="7" /> In Reply to data</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(8,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="8" /> In To data</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(9,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="9" /> In CC data</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(10,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="10" /> In BCC data</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(11,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="11" /> In mailbox path</label>
                        <div role="separator" class="dropdown-divider"></div>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if ($input->exact_match == true) : ?>checked="checked"<?php endif;?> name="exact_match" value="on" /> Exact match phrase</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <label><?php include(erLhcoreClassDesign::designtpl('elasticsearch/parts/nick_title.tpl.php')); ?></label>
                <input type="text" class="form-control form-control-sm" name="from_name" value="<?php echo htmlspecialchars($input->from_name)?>" />
            </div>
        </div>

        <div class="col-md-1">
            <div class="form-group">
                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','E-mail');?></label>
                <input type="text" class="form-control form-control-sm" name="email" value="<?php echo htmlspecialchars($input->email)?>" />
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <?php include(erLhcoreClassDesign::designtpl('elasticsearch/parts/user_title.tpl.php')); ?>
                <label><?php echo $userTitle['user'];?></label>
                <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                    'input_name'     => 'user_ids[]',
                    'optional_field' => $userTitle['user_select'],
                    'selected_id'    => $input->user_ids,
                    'css_class'      => 'form-control',
                    'display_name'   => 'name_official',
                    'ajax'           => 'users',
                    'list_function'  => 'erLhcoreClassModelUser::getUserList',
                    'list_function_params'  => array('limit' => 50)
                )); ?>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Department');?></label>
                        <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                            'input_name'     => 'department_ids[]',
                            'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Choose department'),
                            'selected_id'    => $input->department_ids,
                            'css_class'      => 'form-control',
                            'display_name'   => 'name',
                            'list_function'  => 'erLhcoreClassModelDepartament::getList',
                            'list_function_params'  => array('limit' => false)
                        )); ?>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Department group');?></label>
                        <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                            'input_name'     => 'department_group_ids[]',
                            'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Choose department group'),
                            'selected_id'    => $input->department_group_ids,
                            'css_class'      => 'form-control',
                            'display_name'   => 'name',
                            'list_function'  => 'erLhcoreClassModelDepartamentGroup::getList',
                            'list_function_params'  => array('limit' => false)
                        )); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Subject')?></label>
                <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                    'input_name'     => 'subject_id[]',
                    'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Select subject'),
                    'selected_id'    => $input->subject_id,
                    'css_class'      => 'form-control',
                    'display_name'   => 'name',
                    'list_function'  => 'erLhAbstractModelSubject::getList',
                    'list_function_params'  => array('limit' => false)
                )); ?>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-12 pb-2">
            <a href="#" onclick="$('#advanced-search').toggle()"><span class="material-icons">search</span>&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Advanced search');?></a>
        </div>

        <div class="col-12" id="advanced-search" style="display: none">

            <hr class="mt-0">

            <div class="row">

                <div class="col-md-2">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Date range from');?></label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-sm" name="timefrom" id="id_timefrom" placeholder="E.g <?php echo date('Y-m-d',time()-3*31*24*3600)?>" value="<?php echo $input->ds === null ? date('Y-m-d',time()-(3*31*24*3600)) : htmlspecialchars($input->timefrom)?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Hour and minute from');?></label>
                        <div class="row">
                            <div class="col-md-6">
                                <select name="timefrom_hours" class="form-control form-control-sm">
                                    <option value="">Select hour</option>
                                    <?php for ($i = 0; $i <= 23; $i++) : ?>
                                        <option value="<?php echo $i?>" <?php if (isset($input->timefrom_hours) && $input->timefrom_hours === $i) : ?>selected="selected"<?php endif;?>><?php echo str_pad($i,2, '0', STR_PAD_LEFT);?> h.</option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="timefrom_minutes" class="form-control form-control-sm">
                                    <option value="">Select minute</option>
                                    <?php for ($i = 0; $i <= 59; $i++) : ?>
                                        <option value="<?php echo $i?>" <?php if (isset($input->timefrom_minutes) && $input->timefrom_minutes === $i) : ?>selected="selected"<?php endif;?>><?php echo str_pad($i,2, '0', STR_PAD_LEFT);?> m.</option>
                                    <?php endfor;?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Date range to');?></label>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" class="form-control form-control-sm" name="timeto" id="id_timeto" placeholder="E.g <?php echo date('Y-m-d')?>" value="<?php echo htmlspecialchars($input->timeto)?>" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Hour and minute to');?></label>
                        <div class="row">
                            <div class="col-md-6">
                                <select name="timeto_hours" class="form-control form-control-sm">
                                    <option value="">Select hour</option>
                                    <?php for ($i = 0; $i <= 23; $i++) : ?>
                                        <option value="<?php echo $i?>" <?php if (isset($input->timeto_hours) && $input->timeto_hours === $i) : ?>selected="selected"<?php endif;?>><?php echo str_pad($i,2, '0', STR_PAD_LEFT);?> h.</option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select name="timeto_minutes" class="form-control form-control-sm">
                                    <option value="">Select minute</option>
                                    <?php for ($i = 0; $i <= 59; $i++) : ?>
                                        <option value="<?php echo $i?>" <?php if (isset($input->timeto_minutes) && $input->timeto_minutes === $i) : ?>selected="selected"<?php endif;?>><?php echo str_pad($i,2, '0', STR_PAD_LEFT);?> m.</option>
                                    <?php endfor;?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','User group');?></label>
                        <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                            'input_name'     => 'group_ids[]',
                            'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Select group'),
                            'selected_id'    => $input->group_ids,
                            'css_class'      => 'form-control',
                            'display_name'   => 'name',
                            'list_function'  => 'erLhcoreClassModelGroup::getList',
                            'list_function_params'  => array('limit' => false)
                        )); ?>

                    </div>
                </div>

                <div class="col-12">
                    <div class="row">

                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Sort');?></label>
                                <select name="sort_chat" class="form-control form-control-sm">
                                    <option value="desc" <?php ($input->sort_chat == 'desc' || $input->sort_chat == '') ? print 'selected="selected"' : null?> >From new to old</option>
                                    <option value="asc" <?php $input->sort_chat == 'asc' ? print 'selected="selected"' : null?> >From old to new</option>
                                    <option value="relevance" <?php ($input->sort_chat == 'relevance') ? print 'selected="selected"' : null?> >Relevance</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Conversation status');?></label>
                                <select name="status_conv" class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <option value="0" <?php ($input->status_conv === erLhcoreClassModelMailconvConversation::STATUS_PENDING) ? print 'selected="selected"' : null?> >New</option>
                                    <option value="1" <?php ($input->status_conv === erLhcoreClassModelMailconvConversation::STATUS_ACTIVE) ? print 'selected="selected"' : null?> >Active</option>
                                    <option value="2" <?php ($input->status_conv === erLhcoreClassModelMailconvConversation::STATUS_CLOSED) ? print 'selected="selected"' : null?> >Closed</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Message status');?></label>
                                <select name="status" class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <option value="0" <?php ($input->status === erLhcoreClassModelMailconvMessage::STATUS_PENDING) ? print 'selected="selected"' : null?> >New</option>
                                    <option value="1" <?php ($input->status === erLhcoreClassModelMailconvMessage::STATUS_ACTIVE) ? print 'selected="selected"' : null?> >Active</option>
                                    <option value="2" <?php ($input->status === erLhcoreClassModelMailconvMessage::STATUS_RESPONDED) ? print 'selected="selected"' : null?> >Responded</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Message response status');?></label>
                                <select name="response_type" class="form-control form-control-sm">
                                    <option value="">Select</option>
                                    <option value="0" <?php ($input->response_type === erLhcoreClassModelMailconvMessage::RESPONSE_UNRESPONDED) ? print 'selected="selected"' : null?> >Un-Responded</option>
                                    <option value="1" <?php ($input->response_type === erLhcoreClassModelMailconvMessage::RESPONSE_NOT_REQUIRED) ? print 'selected="selected"' : null?> >Response not required</option>
                                    <option value="2" <?php ($input->response_type === erLhcoreClassModelMailconvMessage::RESPONSE_INTERNAL) ? print 'selected="selected"' : null?> >Our reply message</option>
                                    <option value="3" <?php ($input->response_type === erLhcoreClassModelMailconvMessage::RESPONSE_NORMAL) ? print 'selected="selected"' : null?> >Responded by us</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Sender host E.g gmail.com</label>
                                <input type="text" class="form-control form-control-sm" name="sender_host" value="<?php echo htmlspecialchars($input->sender_host)?>" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Sender e-mail</label>
                                <input type="text" class="form-control form-control-sm" name="sender_address" value="<?php echo htmlspecialchars($input->sender_address)?>" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>From host E.g gmail.com</label>
                                <input type="text" class="form-control form-control-sm" name="from_host" value="<?php echo htmlspecialchars($input->from_host)?>" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Message ID');?></label>
                                <input type="text" class="form-control form-control-sm" name="message_id" value="<?php echo htmlspecialchars($input->message_id)?>" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><input type="checkbox" <?php if ($input->no_user == true) : ?>checked="checked"<?php endif;?> name="no_user" value="on" />&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Has not operator assigned')?></label><br/>
                                <label><input type="checkbox" <?php if ($input->hvf == true) : ?>checked="checked"<?php endif;?> name="hvf" value="on" />&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Message has an attachment')?></label>
                                <label><input type="checkbox" name="has_operator" value="1" <?php $input->has_operator == true ? print 'checked="checked"' : ''?> >&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Has operator assigned')?></label>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label><input type="checkbox" <?php if ($input->is_followup == true) : ?>checked="checked"<?php endif;?> name="is_followup" value="on" />&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Is followup')?></label><br/>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include(erLhcoreClassDesign::designtpl('elasticsearch/parts/mail_custom_filter_attr_multiinclude.tpl.php')); ?>
            </div>

            <hr class="mt-0">

        </div>
    </div>

    <?php if (isset($total_literal)) : ?>
        <div class="float-right">
            <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Records in total');?> - <?php echo $total_literal;?>
        </div>
    <?php endif; ?>

    <div class="btn-group" role="group" aria-label="...">
        <input type="submit" name="doSearchSubmit" class="btn btn-primary btn-sm" value="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Search');?>" />

        <?php if (isset($pages) && erLhcoreClassUser::instance()->hasAccessTo('lhviews','use')) : ?>
            <?php if ($input->view > 0) : ?>
                <input type="hidden" name="view" value="<?php echo $input->view?>" />
            <?php endif; ?>
            <button type="button" onclick="return lhc.revealModal({'title' : 'Export', 'height':350, backdrop:true, 'url':'<?php echo $pages->serverURL?>/(export)/2'})" class="btn btn-outline-secondary btn-sm">
                <span class="material-icons">saved_search</span>
                <?php if ($input->view > 0) : ?>
                    <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Update view')?>
                <?php else : ?>
                    <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Save as view')?>
                <?php endif; ?>
            </button>
        <?php endif; ?>
        
        <a class="btn btn-outline-secondary btn-sm" href="<?php echo erLhcoreClassDesign::baseurl('elasticsearch/listmail')?>"><span class="material-icons">refresh</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Reset');?></a>

    </div>


</form>
<script>
    $(function() {
        $('#id_timefrom,#id_timeto').fdatepicker({
            format: 'yyyy-mm-dd'
        });
        $('.btn-block-department').makeDropdown();
    });
</script>