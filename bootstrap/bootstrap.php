<?php

class erLhcoreClassExtensionElasticsearch
{
    public function __construct()
    {}

    public function run()
    {
        $this->registerAutoload();
    }
    
    public function registerAutoload()
    {
    	include 'extension/elasticsearch/vendor/autoload.php';
	
    	$dispatcher = erLhcoreClassChatEventDispatcher::getInstance();

        if (!(isset($this->settings_personal['disable_es']) && $this->settings_personal['disable_es'] == 1)) {
            $dispatcher->listen('chat.close', 'erLhcoreClassElasticSearchIndex::indexChatDelay');
            $dispatcher->listen('chat.delete', 'erLhcoreClassElasticSearchIndex::indexChatDelete');
            $dispatcher->listen('chat.modified', 'erLhcoreClassElasticSearchIndex::indexChatModify');

            $dispatcher->listen('chat.workflow.has_previous_messages', 'erLhcoreClassElasticSearchIndex::hasPreviousMessages');
            $dispatcher->listen('chat.workflow.get_chat_history', 'erLhcoreClassElasticSearchIndex::getChatHistory');

            $dispatcher->listen('statistic.valid_tabs', 'erLhcoreClassElasticSearchStatistic::appendStatisticTab');
            $dispatcher->listen('statistic.process_tab', 'erLhcoreClassElasticSearchStatistic::processTab');

            if (isset($this->settings_personal['use_es_statistic']) && $this->settings_personal['use_es_statistic'] == true)
            {
                $dispatcher->listen('statistic.gettopchatsbycountry', 'erLhcoreClassElasticSearchStatistic::statisticGettopchatsbycountry');
                $dispatcher->listen('statistic.numberofchatsdialogsbyuser', 'erLhcoreClassElasticSearchStatistic::statisticNumberofchatsdialogsbyuser');
                $dispatcher->listen('statistic.numberofchatsdialogsbydepartment', 'erLhcoreClassElasticSearchStatistic::statisticNumberofchatsdialogsbydepartment');
                $dispatcher->listen('statistic.avgwaittimeuser', 'erLhcoreClassElasticSearchStatistic::statisticAvgwaittimeuser');
                $dispatcher->listen('statistic.averageofchatsdialogsbyuser', 'erLhcoreClassElasticSearchStatistic::statisticAverageofchatsdialogsbyuser');
                $dispatcher->listen('statistic.getnumberofchatspermonth', 'erLhcoreClassElasticSearchStatistic::statisticGetnumberofchatspermonth');
                $dispatcher->listen('statistic.getnumberofchatswaittime', 'erLhcoreClassElasticSearchStatistic::statisticGetnumberofchatswaittime');
                $dispatcher->listen('statistic.getworkloadstatistic', 'erLhcoreClassElasticSearchStatistic::statisticGetworkloadstatistic');
                $dispatcher->listen('statistic.getaveragechatduration', 'erLhcoreClassElasticSearchStatistic::statisticGetaveragechatduration');
                $dispatcher->listen('statistic.numberofmessagesbyuser', 'erLhcoreClassElasticSearchStatistic::statisticNumberofmessagesbyuser');
                $dispatcher->listen('statistic.getnumberofchatsperday', 'erLhcoreClassElasticSearchStatistic::statisticGetnumberofchatsperday');
                $dispatcher->listen('statistic.getnumberofchatswaittimeperday', 'erLhcoreClassElasticSearchStatistic::statisticGetnumberofchatswaittimeperday');
                $dispatcher->listen('statistic.getlast24hstatistic', 'erLhcoreClassElasticSearchStatistic::statisticGetlast24hstatistic');
                $dispatcher->listen('statistic.gettoptodaysoperators', 'erLhcoreClassElasticSearchStatistic::statisticGettoptodaysoperators');
                $dispatcher->listen('statistic.getagentstatistic', 'erLhcoreClassElasticSearchStatistic::statisticGetagentstatistic');
                $dispatcher->listen('statistic.getperformancestatistic', 'erLhcoreClassElasticSearchStatistic::statisticGetperformancestatistic');
            }

            spl_autoload_register(array(
                $this,
                'autoload'
            ), true, false);
        }
    }
    
    public function autoload($className)
    {
        $classesArray = array(
            'erLhcoreClassElasticSearchUpdate'   => 'extension/elasticsearch/classes/lhelasticsearchupdate.php',
            'erLhcoreClassElasticClient'         => 'extension/elasticsearch/classes/lhelasticsearchclient.php',
            'erLhcoreClassElasticTrait'          => 'extension/elasticsearch/classes/lhelastictrait.php',
            'erLhcoreClassElasticSearchStatistic'=> 'extension/elasticsearch/classes/lhelasticsearchstatistic.php',
            'erLhcoreClassModelESChat'           => 'extension/elasticsearch/classes/erlhcoreclassmodeleschat.php',
            'erLhcoreClassModelESMsg'            => 'extension/elasticsearch/classes/erlhcoreclassmodelesmsg.php',
            'erLhcoreClassModelESOnlineSession'  => 'extension/elasticsearch/classes/erlhcoreclassmodelesonlinesession.php',
            'erLhcoreClassModelESPendingChat'    => 'extension/elasticsearch/classes/erlhcoreclassmodelespendingchat.php',
            'erLhcoreClassModelESOnlineOperator' => 'extension/elasticsearch/classes/erlhcoreclassmodelesonlineoperator.php',
            'erLhcoreClassElasticSearchIndex'    => 'extension/elasticsearch/classes/lhelasticsearchindex.php',
            'erLhcoreClassElasticSearchWorker'   => 'extension/elasticsearch/classes/lhqueueelasticsearchworker.php'
        );

        if (key_exists($className, $classesArray)) {
            include_once $classesArray[$className];
        }
    }
   
    public function __get($var)
    {
        switch ($var) {

            case 'settings':
                    $this->settings = include ('extension/elasticsearch/settings/settings.ini.php');
                    return $this->settings;
                break;

            case 'settings_personal':
                    $esOptions = erLhcoreClassModelChatConfig::fetch('elasticsearch_options');
                    $this->settings_personal = (array)$esOptions->data;
                return $this->settings_personal;
                break;

            default:
                ;
                break;
        }
    }
}


