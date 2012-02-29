<?php

/**
 * sites actions.
 *
 * @package    checkup
 * @subpackage sites
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sitesActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeHttpcode(sfWebRequest $request)
  {
    $domaine = $request->getParameter('domaine');
    
    $site = Doctrine_Core::getTable('Site')->findOneByUrl($domaine);
    if (!$site) {
    	$site = new Site;
    	$site->url = $domaine;
    	$site->save();
    }
    
    $value = array('url' => $domaine, 'http_code' => $site->retrieveHttpCode());
    $this->json = json_encode($value);
  }
}
