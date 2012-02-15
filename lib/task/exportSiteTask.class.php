<?php

class exportSiteTask extends sfBaseTask
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
    $this->name             = 'exportSite';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [exportSite|INFO] task does things.
Call it with:

  [php symfony exportSite|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();
    
    $sites_file = 'data/sites.txt';
    $output = '';
	  echo 'export sites';
    
    $sites = Doctrine_Core::getTable('Site')->createQuery('c')->execute();
    foreach ($sites as $site) 
    {
    	$output .= $site->url." \r\n";
    	echo '.';
    }
    $file = fopen($sites_file, 'w+');
    fwrite($file, $output);
    fclose($file);
	  echo "\n";
  }
}
