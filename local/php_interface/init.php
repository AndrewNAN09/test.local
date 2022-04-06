<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('', 'UserAddressOnAfterAdd', 'UserAddress');
$eventManager->addEventHandler('', 'UserAddressOnAfterUpdate', 'UserAddress');
$eventManager->addEventHandler('', 'UserAddressOnAfterDelete', 'UserAddress');
use \Bitrix\Main\Application;
function UserAddress() {
   $taggedCache = Application::getInstance()->getTaggedCache();
   $taggedCache->clearByTag('UserAddress');
}
?>