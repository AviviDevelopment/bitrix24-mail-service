<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Localization\Loc as Loc;

Loc::loadMessages(__FILE__);

$arComponentDescription = array(
	"NAME" => Loc::getMessage("CRM_SUPPLIER_EDIT_DESCRIPTION_NAME"),
	"DESCRIPTION" => Loc::getMessage("CRM_SUPPLIER_EDIT_DESCRIPTION"),
	"SORT" => 20,
	"PATH" => array(
		"ID" => "avivi",
		"NAME" => Loc::getMessage("CRM_REPORT_COMMISSIONS_EXPORT_GROUP"),
		"SORT" => 10
	),
);

?>