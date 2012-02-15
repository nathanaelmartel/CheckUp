<?php

class importSiteTask extends sfBaseTask
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
    $this->name             = 'importSite';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [importSite|INFO] task does things.
Call it with:

  [php symfony importSite|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    $sites_file = 'data/sites.txt';
    if (file_exists($sites_file)) {
	    echo 'import sites';
	    $lines = file($sites_file);
	    foreach($lines as $line) {
	    	$line = rtrim($line, "\r\n");
				$line = trim($line);
		    if ($line != '') {
		    	$site = new Site;
		    	$site->url = $line;
		    	$site->save();
	    		echo '.';
		    }
	    }
	    echo "\n";
    }
  }
}
