

<form action="<?php echo erLhcoreClassDesign::baseurl('elasticsearch/list')?>/(tab)/chats#/chats" autocomplete="off" method="get" name="SearchFormRight" ng-non-bindable>
	<input type="hidden" name="ds" value="1">
	<div class="row">

        <div class="col-md-1">
		  <div class="form-group">
			<label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Chat ID');?></label>
			<input type="text" class="form-control form-control-sm" name="chat_id" value="<?php echo htmlspecialchars($input->chat_id)?>" />
		  </div>
		</div>

        <div class="col-md-2">
            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Keyword messages');?></label>
            <div class="input-group input-group-sm">
                <input type="text" placeholder="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Keyword messages');?>" class="form-control form-control-sm" name="keyword" value="<?php echo htmlspecialchars($input->keyword)?>" />
                <div class="input-group-append ">
                    <button class="btn dropdown-toggle btn-outline-secondary border-secondary-control" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="material-icons">settings</span></button>
                    <div class="dropdown-menu">
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(2,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="2" /> Visitor messages</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(3,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="3" /> Operator messages</label>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if (is_array($input->search_in) && in_array(4,$input->search_in)) : ?>checked="checked"<?php endif;?> name="search_in[]" value="4" /> System messages</label>
                        <div role="separator" class="dropdown-divider"></div>
                        <label class="dropdown-item mb-0 pl-2"><input type="checkbox" <?php if ($input->exact_match == true) : ?>checked="checked"<?php endif;?> name="exact_match" value="on" /> Exact match phrase</label>
                    </div>
                </div>
            </div>
        </div>

		<div class="col-md-1">
		  <div class="form-group">
			<label><?php include(erLhcoreClassDesign::designtpl('elasticsearch/parts/nick_title.tpl.php')); ?></label>
			<input type="text" class="form-control form-control-sm" name="nick" value="<?php echo htmlspecialchars($input->nick)?>" />
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
                            <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Invitation');?></label>
                            <?php echo erLhcoreClassRenderHelper::renderCombobox( array (
                                'input_name'     => 'invitation_id',
                                'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Choose proactive invitation'),
                                'selected_id'    => $input->invitation_id,
                                'css_class'      => 'form-control form-control-sm',
                                'list_function'  => 'erLhAbstractModelProactiveChatInvitation::getList',
                                'list_function_params'  => array('limit' => false)
                            )); ?>
                        </div>
                    </div>

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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Chat duration');?></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <select class="form-control form-control-sm" name="chat_duration_from" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Chat duration from');?>">
                                                <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','From');?></option>
                                                <?php for ($i = 1; $i < 10; $i++) : ?>
                                                    <option value="<?php echo $i*60?>" <?php $i*60 === $input->chat_duration_from ? print 'selected="selected"' : ''?> ><?php echo $i?> m.</option>
                                                <?php endfor; ?>

                                                <?php for ($i = 2; $i < 19; $i++) : ?>
                                                    <option value="<?php echo $i*60*5?>" <?php $i*60*5 === $input->chat_duration_from ? print 'selected="selected"' : ''?> ><?php echo $i*5?> m.</option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-control form-control-sm" name="chat_duration_till" title="<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Chat duration till');?>">
                                                <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Till');?></option>
                                                <?php for ($i = 1; $i < 10; $i++) : ?>
                                                    <option value="<?php echo $i*60?>" <?php $i*60 === $input->chat_duration_till ? print 'selected="selected"' : ''?> ><?php echo $i?> m.</option>
                                                <?php endfor; ?>

                                                <?php for ($i = 2; $i < 19; $i++) : ?>
                                                    <option value="<?php echo $i*60*5?>" <?php $i*60*5 === $input->chat_duration_till ? print 'selected="selected"' : ''?> ><?php echo $i*5?> m.</option>
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Wait time');?></label>
                                    <div class="row">
                                        <div class="col-6">
                                            <select class="form-control form-control-sm" name="wait_time_from">
                                                <option>More than</option>
                                                <option value="0" <?php $input->wait_time_from === 0 ? print 'selected="selected"' : ''?>>0 seconds</option>
                                                <option value="5" <?php $input->wait_time_from === 5 ? print 'selected="selected"' : ''?>>5 seconds</option>
                                                <option value="10" <?php $input->wait_time_from === 10 ? print 'selected="selected"' : ''?>>10 seconds</option>
                                                <option value="20" <?php $input->wait_time_from === 20 ? print 'selected="selected"' : ''?>>20 seconds</option>
                                                <option value="30" <?php $input->wait_time_from === 30 ? print 'selected="selected"' : ''?>>30 seconds</option>
                                                <option value="40" <?php $input->wait_time_from === 40 ? print 'selected="selected"' : ''?>>40 seconds</option>
                                                <option value="50" <?php $input->wait_time_from === 50 ? print 'selected="selected"' : ''?>>50 seconds</option>
                                                <option value="60" <?php $input->wait_time_from === 60 ? print 'selected="selected"' : ''?>>60 seconds</option>
                                                <option value="90" <?php $input->wait_time_from === 90 ? print 'selected="selected"' : ''?>>90 seconds</option>

                                                <?php for ($i = 2; $i < 5; $i++) : ?>
                                                    <option value="<?php echo $i*60?>" <?php $input->wait_time_from === $i*60 ? print 'selected="selected"' : ''?>><?php echo  $i?> m.</option>
                                                <?php endfor ?>

                                                <?php for ($i = 2; $i < 13; $i++) : ?>
                                                    <option value="<?php echo $i*5*60?>" <?php $i*60*5 === $input->wait_time_from ? print 'selected="selected"' : ''?>><?php echo $i*5?> m.</option>
                                                <?php endfor ?>
                                            </select>
                                        </div>
                                        <div class="col-6">
                                            <select class="form-control form-control-sm" name="wait_time_till">
                                                <option>Less than</option>
                                                <option value="0" <?php $input->wait_time_till === 0 ? print 'selected="selected"' : ''?>>0 seconds</option>
                                                <option value="5" <?php $input->wait_time_till === 5 ? print 'selected="selected"' : ''?>>5 seconds</option>
                                                <option value="10" <?php $input->wait_time_till === 10 ? print 'selected="selected"' : ''?>>10 seconds</option>
                                                <option value="20" <?php $input->wait_time_till === 20 ? print 'selected="selected"' : ''?>>20 seconds</option>
                                                <option value="30" <?php $input->wait_time_till === 30 ? print 'selected="selected"' : ''?>>30 seconds</option>
                                                <option value="40" <?php $input->wait_time_till === 40 ? print 'selected="selected"' : ''?>>40 seconds</option>
                                                <option value="50" <?php $input->wait_time_till === 50 ? print 'selected="selected"' : ''?>>50 seconds</option>
                                                <option value="60" <?php $input->wait_time_till === 60 ? print 'selected="selected"' : ''?>>60 seconds</option>
                                                <option value="90" <?php $input->wait_time_till === 90 ? print 'selected="selected"' : ''?>>90 seconds</option>

                                                <?php for ($i = 2; $i < 5; $i++) : ?>
                                                    <option value="<?php echo $i*60?>" <?php $input->wait_time_till === $i*60 ? print 'selected="selected"' : ''?>><?php echo  $i?> m.</option>
                                                <?php endfor ?>

                                                <?php for ($i = 2; $i < 13; $i++) : ?>
                                                    <option value="<?php echo $i*60*5?>" <?php $i*60*5 === $input->wait_time_till ? print 'selected="selected"' : ''?> ><?php echo $i*5?> m.</option>
                                                <?php endfor ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','User agent');?></label>
                                    <input type="text" class="form-control form-control-sm" name="uagent" value="<?php echo htmlspecialchars($input->uagent)?>" />
                                </div>

                                <div class="form-group">
                                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','User Country');?></label>
                                    <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                                        'input_name'     => 'country_ids[]',
                                        'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Choose country'),
                                        'selected_id'    => $input->country_ids,
                                        'css_class'      => 'form-control',
                                        'display_name'   => 'name',
                                        'list_function'  => 'lhCountries::getCountries'
                                    )); ?>
                                </div>
                            </div>

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
                                    <label><input type="checkbox" <?php if ($input->no_user == true) : ?>checked="checked"<?php endif;?> name="no_user" value="on" /> No user assigned</label><br/>
                                    <label><input type="checkbox" <?php if ($input->hof == true) : ?>checked="checked"<?php endif;?> name="hof" value="on" /> Has operator file</label><br/>
                                    <label><input type="checkbox" <?php if ($input->hvf == true) : ?>checked="checked"<?php endif;?> name="hvf" value="on" /> Has visitor file</label>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <?php echo erLhcoreClassRenderHelper::renderMultiDropdown( array (
                                        'input_name'     => 'bot_ids[]',
                                        'optional_field' => erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Select bot'),
                                        'selected_id'    => $input->bot_ids,
                                        'css_class'      => 'form-control',
                                        'display_name'   => 'name',
                                        'list_function'  => 'erLhcoreClassModelGenericBotBot::getList',
                                        'list_function_params'  => array('limit' => false)
                                    )); ?>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label><input type="checkbox" name="has_operator" value="1" <?php $input->has_operator == true ? print 'checked="checked"' : ''?> >&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Chats with an operator')?></label>
                            </div>

                            <div class="col-md-2">
                                <label><input type="checkbox" name="with_bot" value="1" <?php $input->with_bot == true ? print 'checked="checked"' : ''?> >&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Chats which had a bot')?></label>
                            </div>

                            <div class="col-md-2">
                                <label><input type="checkbox" name="without_bot" value="1" <?php $input->without_bot == true ? print 'checked="checked"' : ''?> >&nbsp;<?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Chats which did not had a bot')?></label>
                            </div>



                            <div class="col-md-2">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Visitor status on chat close');?></label>
                                <div class="form-group">
                                    <select name="cls_us" class="form-control form-control-sm">
                                        <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Any');?></option>
                                        <option value="1" <?php $input->cls_us === 1 ? print 'selected="selected"' : '' ?> ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Online');?></option>
                                        <option value="2" <?php $input->cls_us === 2 ? print 'selected="selected"' : '' ?> ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Offline');?></option>
                                        <option value="0" <?php $input->cls_us === 0 ? print 'selected="selected"' : '' ?> ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Undetermined');?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Has unread operator messages');?></label>
                                <div class="form-group">
                                    <select name="has_unread_op_messages" class="form-control form-control-sm">
                                        <option value=""><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Any');?></option>
                                        <option value="1" <?php $input->has_unread_op_messages === 1 ? print 'selected="selected"' : '' ?> ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Yes');?></option>
                                        <option value="0" <?php $input->has_unread_op_messages === 0 ? print 'selected="selected"' : '' ?> ><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','No');?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-2"><label class="col-form-label"><input type="checkbox" name="abandoned_chat" value="1" <?php $input->abandoned_chat == true ? print 'checked="checked"' : ''?> > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Abandoned chats')?></label></div>
                            <div class="col-2"><label class="col-form-label"><input type="checkbox" name="dropped_chat" value="1" <?php $input->dropped_chat == true ? print 'checked="checked"' : ''?> > <?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Dropped chat')?></label></div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Referrer website');?></label>
                                    <input type="text" class="form-control form-control-sm" name="session_referrer" value="<?php echo htmlspecialchars($input->session_referrer)?>" />
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-group">
                                    <label><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('bracket/lists/filter','Chat start page');?></label>
                                    <input type="text" class="form-control form-control-sm" name="referrer" value="<?php echo htmlspecialchars($input->referrer)?>" />
                                </div>
                            </div>


                        </div>
                    </div>

                    <?php include(erLhcoreClassDesign::designtpl('elasticsearch/parts/custom_filter_attr_multiinclude.tpl.php')); ?>
                </div>

                <hr class="mt-0">

            </div>
	</div>
	
	<?php if ($tab == 'chats' && isset($total_literal)) : ?>
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

        <a class="btn btn-outline-secondary btn-sm" href="<?php echo erLhcoreClassDesign::baseurl('elasticsearch/list')?>"><span class="material-icons">refresh</span><?php echo erTranslationClassLhTranslation::getInstance()->getTranslation('chat/lists/search_panel','Reset');?></a>

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