<?php

class checkupTask extends sfBaseTask
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
    $this->name             = 'checkup';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [checkup|INFO] task does things.
Call it with:

  [php symfony checkup|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    require_once('lib/vendor/Zend/Dom/Query.php');
    
    $sites = Doctrine_Core::getTable('Site')->createQuery('c')->orderBy('updated_at ASC')->limit(100)->execute();
    foreach ($sites as $site)
    {
      echo $site->getUrl()."\t\t\t";
      $message_body = $site->retrieveInfo(sfConfig::get('app_alert_email_format_change'));
      
      if ($message_body != '') {
	      $message = $this->getMailer()->compose(
	      	sfConfig::get('app_alert_email_from'), 
	      	sfConfig::get('app_alert_email_to'), 
	      	sfConfig::get('app_alert_email_subject').' '.$site->getUrl(), 
	      	sprintf(sfConfig::get('app_alert_email_format'), $site->getUrl(), $message_body)
	      );
	      $message->setContentType('text/html');
      	$this->getMailer()->send($message);
      }
      
      echo "\n";
    }
    
  }
}
