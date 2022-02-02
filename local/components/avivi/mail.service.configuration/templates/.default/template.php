<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
use Bitrix\Main\Localization\Loc as Loc;
use Bitrix\Main\Page\Asset;
Loc::loadMessages(__FILE__);
\Bitrix\Main\UI\Extension::load("ui.forms");
\Bitrix\Main\UI\Extension::load("ui.buttons");
\Bitrix\Main\UI\Extension::load("ui.alerts");
\Bitrix\Main\UI\Extension::load("ui.dialogs.messagebox");
\CJSCore::init(array("ui", "jquery"));
global $APPLICATION;

Asset::getInstance()->addJs($templateFolder."/js/bootstrap.min.js");
Asset::getInstance()->addJs($templateFolder."/js/bootstrap-editable.min.js");
Asset::getInstance()->addCss($templateFolder."/css/bootstrap.min.css");
Asset::getInstance()->addCss($templateFolder."/css/bootstrap-editable.css");
$request = \Bitrix\Main\Context::getCurrent()->getRequest();
$isPost = $request->isPost();
$postData = ($isPost && $request->getPostList()) ? $request->getPostList()->toArray() : array();
?>
<div class="ui-alert ui-alert-danger">
    <span class="ui-alert-message"><?=Loc::getMessage('MAIL_SERVICE_ALERT_MESSAGE')?></span>
</div>
<div class="btn-place">
    <button id="add-new-item" class="ui-btn ui-btn-primary"><?=Loc::getMessage('MAIL_SERVICE_ADD_NEW')?></button>
</div>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_ID')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_NAME')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_IMAP_SERVER')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_IMAP_PORT')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_IMAP_ENC')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_LINK')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_SMTP_SERVER')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_SMTP_PORT')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_SMTP_ENC')?></td>
        <td><?=Loc::getMessage('MAIL_SERVICE_UPLOAD')?></td>
        <td></td>
    </tr>
    </thead>
    <tbody id="xeditable">
    <?if($postData['action'] == 'new' || $postData['action'] == 'delete')
        $APPLICATION->RestartBuffer(); ?>
    <?foreach ($arResult['ITEMS'] as $items){?>
        <tr>
            <td>
                <?=$items['ID']?>
            </td>
            <td>
                <a href="#" data-type="text" data-pk="<?=$items['ID']?>" data-name="NAME" class="name"><?=$items['NAME']?></a>
            </td>
            <td>
                <a href="#" data-type="text" data-pk="<?=$items['ID']?>" data-name="SERVER" class="standart-field"><?=$items['SERVER']?></a>
            </td>
            <td>
                <a href="#" data-type="text" data-pk="<?=$items['ID']?>" data-name="PORT" class="standart-field"><?=$items['PORT']?></a>
            </td>
            <td>
                <a href="#" data-type="select" data-pk="<?=$items['ID']?>" data-name="ENCRYPTION" class="checkbox–editable"><?=$items['ENCRYPTION']?></a>
            </td>
            <td>
                <a href="#" data-type="text" data-pk="<?=$items['ID']?>" data-name="LINK"  class="standart-field"><?=$items['LINK']?></a>
            </td>
            <td>
                <a href="#" data-type="text" data-pk="<?=$items['ID']?>" data-name="SMTP_SERVER" class="standart-field"><?=$items['SMTP_SERVER']?></a>
            </td>
            <td>
                <a href="#" data-type="text" data-pk="<?=$items['ID']?>" data-name="SMTP_PORT" class="standart-field"><?=$items['SMTP_PORT']?></a>
            </td>
            <td>
                <a href="#" data-type="select" data-pk="<?=$items['ID']?>" data-name="SMTP_ENCRYPTION" class="checkbox–editable"><?=$items['SMTP_ENCRYPTION']?></a>
            </td>
            <td>
                <a href="#" data-type="select" data-pk="<?=$items['ID']?>" data-name="UPLOAD_OUTGOING" class="checkbox–editable"><?=$items['UPLOAD_OUTGOING']?></a>
            </td>
            <td>
                <span class="remove-item" data-pk="<?=$items['ID']?>"></span>
            </td>
        </tr>
    <?}?>
    </tbody>
    <?if($postData['action'] == 'new' || $postData['action'] == 'delete')
        die(); ?>
</table>
<script type="text/javascript">
    AV.MailSetting.create({
        addButton: 'add-new-item',
        removeButton: 'remove-item',
        contentUrl: '<?=$templateFolder."/add.php"?>',
        cancelButtonText: '<?=Loc::getMessage("MAIL_SERVICE_POPUP_CANCEL_BUTTON")?>',
        addButtonText: '<?=Loc::getMessage("MAIL_SERVICE_POPUP_ADD_BUTTON")?>',
        fieldRequired: '<?=Loc::getMessage("MAIL_SERVICE_REQUIRED_FIELD")?>',
        emptyWord: '<?=Loc::getMessage("MAIL_SERVICE_EMPTY_WORD")?>',
        ajaxUrl: '<?=$APPLICATION->GetCurDir();?>',
        emptyName: '<?=Loc::getMessage("MAIL_SERVICE_NAME_EMPTY_ERROR")?>',
        confirmTitle: '<?=Loc::getMessage("MAIL_SERVICE_CONFIRM_TITLE")?>',
        confirmMessage: '<?=Loc::getMessage("MAIL_SERVICE_CONFIRM_MESSAGE")?>'
    });
</script>
