<?php
use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

class UserUserAddress extends CBitrixComponent {
    private $_request;

    private function _checkModules() {
        if (   !Loader::includeModule('iblock')
            || !Loader::includeModule('sale')
        ) {
            throw new \Exception('Не загружены модули необходимые для работы модуля');
        }

        return true;
    }


    private function _app() {
        global $APPLICATION;
        return $APPLICATION;
    }


    private function _user() {
        global $USER;
        return $USER;
    }

    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams) {
        return $arParams;
    }

    public function executeComponent() {
        $this->_checkModules();

        $this->_request = Application::getInstance()->getContext()->getRequest();

        CModule::IncludeModule('highloadblock');
        if(\Bitrix\Main\Engine\CurrentUser::get()->getId()) {
            $tableName = "useraddress";
            $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getList(
                array("filter" => array(
                    'TABLE_NAME' => $tableName
                ))
            )->fetch();
            if (isset($hlblock['ID'])) {
                $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
                $entity_data_class = $entity->getDataClass();
                $res = $entity_data_class::getList(array('filter' => array()));
                while ($item = $res->fetch()) {
                    if ($item['UF_ACTIV'] == 0) {
                        continue;
                    } else {
                        $this->arResult['USER'][]['data'] = $item;
                    }
                }
            }
        }

        $this->includeComponentTemplate();
    }
}