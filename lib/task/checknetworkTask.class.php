<?php

class checknetworkTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'checknetwork';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [checknetwork|INFO] task does things.
Call it with:

  [php symfony checknetwork|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    $file_logger = new sfFileLogger($this->dispatcher, array(
    	'file' => $this->configuration->getRootDir().'/log/checknetwork.log'
    ));
    $this->dispatcher->connect('command.log', array($file_logger, 'listenToLogEvent'));
    
    require_once('lib/vendor/Zend/Dom/Query.php');
    
    $sites = Doctrine_Core::getTable('Site')->createQuery('c')->orderBy('updated_at ASC')->limit(50)->execute();
    foreach ($sites as $site)
    {
      $message_body = $site->retrieveNetworkInfo(sfConfig::get('app_alert_email_format_change'));
      sfTask::log($site->getUrl().' ['.$site->ip.'] '.$site->host);
      
      if ($message_body != '') {
	      $message = $this->getMailer()->compose(
	      	sfConfig::get('app_alert_email_from'), 
	      	sfConfig::get('app_alert_email_to'), 
	      	sfConfig::get('app_alert_email_subject').' '.$site->getUrl(), 
	      	sprintf(sfConfig::get('app_alert_email_format'), $site->getUrl(), $message_body)
	      );
	      $message->setContentType('text/html');
      	$this->getMailer()->send($message);
      	sfTask::log('['.$site->getUrl().'] error: '.json_encode($message_body));
      }
    }
  }
}
