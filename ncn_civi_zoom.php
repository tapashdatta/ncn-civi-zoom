<?php

require_once 'ncn_civi_zoom.civix.php';
require_once __DIR__.'/vendor/autoload.php';
define('ZOOM_SETTINGS', 'Zoom_Settings');
use CRM_NcnCiviZoom_ExtensionUtil as E;

// use Lcobucci\JWT\Configuration;
// use Lcobucci\JWT\Signer;
// use Lcobucci\JWT\Signer\Key;
// use Dotenv\Dotenv;

// Load .env file
// $dotenv = Dotenv::createImmutable(__DIR__);
// $dotenv->load();

function ncn_civi_zoom_civicrm_alterAPIPermissions($entity, $action, &$params, &$permissions)
{
  $permissions['event']['generatewebinarattendance'] = array('access CiviEvent');
}

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function ncn_civi_zoom_civicrm_config(&$config) {
  _ncn_civi_zoom_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function ncn_civi_zoom_civicrm_xmlMenu(&$files) {
  _ncn_civi_zoom_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function ncn_civi_zoom_civicrm_install() {
  _ncn_civi_zoom_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function ncn_civi_zoom_civicrm_postInstall() {
  $settings['base_url'] = "https://api.zoom.us/v2";
  CRM_Core_BAO_Setting::setItem($settings, ZOOM_SETTINGS, 'zoom_settings');
  _ncn_civi_zoom_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function ncn_civi_zoom_civicrm_uninstall() {
  _ncn_civi_zoom_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function ncn_civi_zoom_civicrm_enable() {
  _ncn_civi_zoom_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function ncn_civi_zoom_civicrm_disable() {
  _ncn_civi_zoom_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function ncn_civi_zoom_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  CRM_Civirules_Utils_Upgrader::insertActionsFromJson(__DIR__ . '/civirules_actions.json');

  return _ncn_civi_zoom_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function ncn_civi_zoom_civicrm_managed(&$entities) {
  _ncn_civi_zoom_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function ncn_civi_zoom_civicrm_caseTypes(&$caseTypes) {
  _ncn_civi_zoom_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function ncn_civi_zoom_civicrm_angularModules(&$angularModules) {
  _ncn_civi_zoom_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function ncn_civi_zoom_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _ncn_civi_zoom_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function ncn_civi_zoom_civicrm_entityTypes(&$entityTypes) {
  _ncn_civi_zoom_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function ncn_civi_zoom_civicrm_themes(&$themes) {
  _ncn_civi_zoom_civix_civicrm_themes($themes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
 */
function ncn_civi_zoom_civicrm_navigationMenu(&$menu) {
  $parentId             = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_Navigation', 'Events', 'id', 'name');
  $maxId                = max(array_keys($menu));
  $zoomSettingMaxId     = $maxId+1;

  $menu[$parentId]['child'][$zoomSettingMaxId] = array(
        'attributes' => array(
          'label'     => ts('Zoom Settings'),
          'name'      => 'Zoom_Settings',
          'url'       => CRM_Utils_System::url('civicrm/Zoom/settings', 'reset=1'),
          'active'    => 1,
          'parentID'  => $parentId,
          'operator'  => NULL,
          'navID'     => $zoomSettingMaxId,
          'permission'=> 'administer CiviCRM',
        ),
  );
}

function ncn_civi_zoom_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors) {

  if($formName == 'CRM_Event_Form_ManageEvent_EventInfo' && isset($form->_subType)){
    $customIds['Webinar'] = CRM_NcnCiviZoom_Utils::getWebinarCustomField();
    $customIds['Meeting'] = CRM_NcnCiviZoom_Utils::getMeetingCustomField();
    $customFieldZoomAccount = CRM_NcnCiviZoom_Utils::getAccountIdCustomField();
    $submitValues = array();
    foreach ($customIds as $key => $value) {
      foreach ($fields as $keys => $field) {
        $tempStr = substr($keys, 0, strlen($value));
        if($tempStr == $value){
          //Retriving the submitted value of custom fields
          $submitValues[$key] = $field;
        }
      }
    }
    //Checking whether more than one custom fields are entered
    $count = 0;
    $zoomEntity = NULL;
    foreach ($submitValues as $key => $value) {
      if(!empty($value)){
        $count = $count + 1;
        //Custom field id is being stored for validating the meeting/webinar id
        $zoomEntity = $key;
        if(isset($fields['zoom_account_list']) && $fields['zoom_account_list'] == 0){
          // Return error if the account id is empty
          $errors['_qf_default'] = ts('Please select a zoom account id');
        }
      }
      if($count>1){
        $errors['_qf_default'] = ts('Please enter either Webinar ID or Meeting ID, you cannot enter both');
      }
    }

    //If the zoom account is selected but the custom fields(Webinar id or Meeting id) are empty
    if(!empty($fields['zoom_account_list']) && $count == 0){
      $errors['_qf_default'] = ts('Please enter either Webinar ID or Meeting ID');
    }elseif (!empty($fields['zoom_account_list']) && $count == 1) {//Verifying the zoom event
      $checkParams['account_id'] = $fields['zoom_account_list'];
      $checkParams['entityID'] = $submitValues[$zoomEntity];
      $checkParams['entity'] = $zoomEntity;
      $result = CRM_CivirulesActions_Participant_AddToZoom::checkEventWithZoom($checkParams);
      if(!$result['status']){
        $errors['_qf_default'] = $result['message'];
      }
      //Validate the profile of the zoom event if it has online registration enabled
      if(!empty($form->_id) && empty($errors)){
        $isOnlineReg = CRM_Core_DAO::singleValueQuery("SELECT is_online_registration FROM civicrm_event WHERE id=".$form->_id);
        if($isOnlineReg == 1){
          $profileIds = $missingProfileFields = null;
          try {
            $apiResult = civicrm_api3('UFJoin', 'get', [
              'sequential' => 1,
              'return' => ["uf_group_id"],
              'entity_id' => $form->_id,
            ]);
          } catch (Exception $e) {
            CRM_Core_Error::debug_var('ncn_civi_zoom_civicrm_validateForm error', $e);
          }
          if(!empty($apiResult['values'])){
            foreach ($apiResult['values'] as $key => $value){
              $profileIds[] = $value['uf_group_id'];
            }
            if(!empty($profileIds)){
              $checkFields = ['first_name', 'last_name', 'email'];
              $missingProfileFields = CRM_NcnCiviZoom_Utils::checkRequiredProfilesForAnEvent($profileIds, $checkFields);

            }
          }
          if(empty($profileIds) || !empty($missingProfileFields)){
            // Error message if no profiles are selected or if the required fields are missing in the selected profiles
            $errors['_qf_default'] = ts('Please select a profile having the fields - first_name, last_name and email. As they are required for zoom registration');
          }
        }
      }
    }
  }

  //Validate the profile of the zoom event if it has online registration enabled
  if($formName == 'CRM_Event_Form_ManageEvent_Registration'){
    if($fields['is_online_registration'] == 1){
      if(!empty($form->_id)){
        $eventId = $form->_id;
        $accountId = CRM_NcnCiviZoom_Utils::getZoomAccountIdByEventId($eventId);
        if(!empty($accountId)){
          $profileIds = $missingProfileFields = [];
          $requiredFields = ['first_name', 'last_name', 'email'];
          $formProfileFields = ['custom_pre_id','custom_post_id','additional_custom_pre_id','additional_custom_post_id'];
          foreach ($formProfileFields as $formProfileField) {
            if(!empty($fields[$formProfileField])){
              $profileIds[] = $fields[$formProfileField];
            }
          }

          if(!empty($profileIds)){
            $missingProfileFields = CRM_NcnCiviZoom_Utils::checkRequiredProfilesForAnEvent($profileIds, $requiredFields);
          }
          if(empty($profileIds) || !empty($missingProfileFields)){
            // Error message if no profiles are selected or if the required fields are missing in the selected profiles
            if(!empty($missingProfileFields)){
              $errors['_qf_default'] = ts('Please select a profile having the fields - first_name, last_name and email. As they are required for zoom registration');
            }
          }
        }
      }
    }
  }
}

/**
 * Implements hook_civicrm_buildForm().
 *
 * Set a default value for an event price set field.
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function ncn_civi_zoom_civicrm_buildForm($formName, &$form) {

  //Add the zoom account list to the form once the custom datatype is loaded
  if($formName == 'CRM_Custom_Form_CustomDataByType'){
    if($form->_cdType == 'Event' && $form->_type == 'Event'){
      CRM_NcnCiviZoom_Utils::addZoomListToEventForm($form);
      $templatePath = realpath(dirname(__FILE__)."/templates");
      CRM_Core_Region::instance('page-body')->add(array(
        'template' => "{$templatePath}/CRM/NcnCiviZoom/Event/Form/ManageEvent/Extra.tpl"
      ));
    }
  }

  //Add the zoom account list to the form once the form is loaded
  if ($formName == 'CRM_Event_Form_ManageEvent_EventInfo') {
    if(($form->getAction() == CRM_Core_Action::ADD)
      || ($form->getAction() == CRM_Core_Action::UPDATE)) {

      if(($form->getAction() == CRM_Core_Action::UPDATE) && ($form->controller->_QFResponseType != "json")){
        return null;
      }

      CRM_NcnCiviZoom_Utils::addZoomListToEventForm($form);

    }
  }
}

/**
 * Implements hook_civicrm_postProcess().
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function ncn_civi_zoom_civicrm_postProcess($formName, $form) {
  if($formName == 'CRM_Event_Form_ManageEvent_EventInfo'){
    $values = $form->exportValues();
    $customFieldZoomAccount = CRM_NcnCiviZoom_Utils::getAccountIdCustomField();
    if(isset($values['zoom_account_list']) && !empty($form->_id) && !empty($customFieldZoomAccount)){
      try {
        civicrm_api3('CustomValue', 'create', [
          'entity_id' => $form->_id,
          $customFieldZoomAccount => $values['zoom_account_list'],
        ]);
      } catch (Exception $e) {
        CRM_Core_Error::debug_var('ncn_civi_zoom_civicrm_postProcess error', $e);
      }
    }
  }
}


function ncn_civi_zoom_civicrm_pageRun(&$page) {
  $pageName = $page->getVar('_name');
  if ($pageName == 'CRM_Event_Page_EventInfo') {
    $templatePath = realpath(dirname(__FILE__)."/templates");
    //Including the tpl file to hide the custom fields displayed for an event
    CRM_Core_Region::instance('page-body')->add(array(
      'template' => "{$templatePath}/CRM/NcnCiviZoom/Event/Page/Extra.tpl"
    ));
  }
}
