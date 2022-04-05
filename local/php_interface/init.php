<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

$eventManager = \Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler('', 'UserAddressOnAfterAdd', 'UserAddress');
$eventManager->addEventHandler('', 'UserAddressOnAfterUpdate', 'UserAddress');
$eventManager->addEventHandler('', 'UserAddressOnAfterDelete', 'UserAddress');
function UserAddress() {
    CBitrixComponent::clearComponentCache('user:useraddress');
}
