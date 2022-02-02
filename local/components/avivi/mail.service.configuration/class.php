<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Mail\MailServicesTable;
use Bitrix\Main\Localization\Loc as Loc;


class MailServicesConfigComponent extends CBitrixComponent
{
    /**
     * including lang files
     */
    public function onIncludeComponentLang()
    {
        $this->includeComponentLang(basename(__FILE__));
        Loc::loadMessages(__FILE__);
    }

    public function getMailConfigs(){
        $standartConfigs = array(
            'gmail',
            'outlook.com',
            'icloud',
            'office365',
            'exchange',
            'yahoo',
            'aol',
            'yandex',
            'mail.ru',
            'other',
            'bitrix24'
        );
        Main\Loader::includeModule("mail");
        $dbMailRes = MailServicesTable::getList(array(
            'filter' => array('!=NAME' => $standartConfigs)
        ));
        while($arMailRes = $dbMailRes->Fetch()){
            $this->arResult['ITEMS'][] = $arMailRes;
        }
    }

    public function addNewConfig(){
        global $APPLICATION;
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $isPost = $request->isPost();
        $postData = ($isPost && $request->getPostList()) ? $request->getPostList()->toArray() : array();
        if($postData['action'] == 'new'){
            if(!empty($postData['data']['name'])){
                $arFields = array(
                    'SITE_ID' => 's1',
                    'ACTIVE' => true,
                    'SERVICE_TYPE' => 'imap',
                    'NAME' => $postData['data']['name'],
                    'SERVER' => $postData['data']['imap_server'],
                    'PORT' => $postData['data']['imap_port'],
                    'ENCRYPTION' => $postData['data']['imap_enc'],
                    'LINK' => $postData['data']['link'],
                    'ICON' => "",
                    'TOKEN' => "",
                    'FLAGS' => 0,
                    'SORT' => 100,
                    'SMTP_SERVER' => $postData['data']['smtp_server'],
                    'SMTP_PORT' => $postData['data']['smtp_port'],
                    'SMTP_LOGIN_AS_IMAP' => true,
                    'SMTP_PASSWORD_AS_IMAP' => true,
                    'SMTP_ENCRYPTION' => $postData['data']['smtp_enc'],
                    'UPLOAD_OUTGOING' => $postData['data']['upload']
                );
                Main\Loader::includeModule("mail");
                $res = MailServicesTable::add($arFields);
            }
        }
    }

    public function updateConfig(){
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $isPost = $request->isPost();
        $postData = ($isPost && $request->getPostList()) ? $request->getPostList()->toArray() : array();
        if(!empty($postData['pk'])){
            $arFields = array(
                $postData['name'] => $postData['value']
            );
            Main\Loader::includeModule("mail");
            $res = MailServicesTable::update($postData['pk'],$arFields);
        }
    }

    public function deleteConfig(){
        $request = \Bitrix\Main\Context::getCurrent()->getRequest();
        $isPost = $request->isPost();
        $postData = ($isPost && $request->getPostList()) ? $request->getPostList()->toArray() : array();
        if($postData['action'] == 'delete'){
            Main\Loader::includeModule("mail");
            MailServicesTable::delete($postData['id']);
        }
    }

    /**
     * component logic
     */
    public function executeComponent()
    {
        try
        {
            $this->addNewConfig();
            $this->updateConfig();
            $this->deleteConfig();
            $this->getMailConfigs();
            $this->includeComponentTemplate();
        }
        catch (Exception $e)
        {
            ShowError($e->getMessage());
        }
    }
}
