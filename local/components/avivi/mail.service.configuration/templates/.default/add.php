<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
use Bitrix\Main\Localization\Loc as Loc;
Loc::loadLanguageFile(__DIR__."/template.php");
?>
<form id="new-config">
<table class="mg-top-25 table table-bordered table-striped">
    <tbody>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_NAME')?> <span class="error-text">*</span></td>
        <td id="nameinput">
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <input type="text" name="name" class="ui-ctl-element">
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_IMAP_SERVER')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <input type="text" name="imap_server" class="ui-ctl-element">
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_IMAP_PORT')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <input type="text" name="imap_port" class="ui-ctl-element">
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_IMAP_ENC')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <select class="ui-ctl-element" name="imap_enc">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_LINK')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <input type="text" name="link" class="ui-ctl-element">
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_SMTP_SERVER')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <input type="text" name="smtp_server" class="ui-ctl-element">
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_SMTP_PORT')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <input type="text" name="smtp_port" class="ui-ctl-element">
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_SMTP_ENC')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <select class="ui-ctl-element" name="smtp_enc">
                    <option value="Y">Y</option>
                    <option value="N">N</option>
                </select>
            </div>
        </td>
    </tr>
    <tr>
        <td><?=Loc::getMessage('MAIL_SERVICE_UPLOAD')?></td>
        <td>
            <div class="ui-ctl ui-ctl-textbox ui-ctl-w75">
                <select class="ui-ctl-element" name="upload">
                    <option selected value="N">N</option>
                    <option value="Y">Y</option>
                </select>
            </div>
        </td>
    </tr>
    </tbody>
</table>
</form>
