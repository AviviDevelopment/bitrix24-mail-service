<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Custom mail services");

$APPLICATION->IncludeComponent(
    "avivi:mail.service.configuration",
    "",
    array(),
    false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");