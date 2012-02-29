<?php

/**
 * test actions.
 *
 * @package    checkup
 * @subpackage test
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class testActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sites = Doctrine_Core::getTable('Site')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new SiteForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new SiteForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($site = Doctrine_Core::getTable('Site')->find(array($request->getParameter('id'))), sprintf('Object site does not exist (%s).', $request->getParameter('id')));
    $this->form = new SiteForm($site);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($site = Doctrine_Core::getTable('Site')->find(array($request->getParameter('id'))), sprintf('Object site does not exist (%s).', $request->getParameter('id')));
    $this->form = new SiteForm($site);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($site = Doctrine_Core::getTable('Site')->find(array($request->getParameter('id'))), sprintf('Object site does not exist (%s).', $request->getParameter('id')));
    $site->delete();

    $this->redirect('test/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $site = $form->save();

      $this->redirect('test/edit?id='.$site->getId());
    }
  }
}
