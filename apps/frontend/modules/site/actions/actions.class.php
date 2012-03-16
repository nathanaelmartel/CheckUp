<?php

/**
 * site actions.
 *
 * @package    checkup
 * @subpackage site
 * @author     Nathanaël Martel <nathanael@fam-martel.eu>
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class siteActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->sites = Doctrine_Core::getTable('Site')->createQuery('c')->orderBy('url ASC')->execute();
  }
}
