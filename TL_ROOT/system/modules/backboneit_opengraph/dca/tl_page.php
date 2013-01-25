<?php

$this->loadLanguageFile('bbit_og');

$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'bbit_og';
$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'bbit_og_type';

$strOGPalette = ',bbit_og_type'
	. ',bbit_og_title,bbit_og_site'
	. ',bbit_og_url'
	. ',bbit_og_image,bbit_og_imageSize'
	. ',bbit_og_description'
//	. ',bbit_og_curies,bbit_og_custom'
	;
$arrOGPalettes = array();
foreach($GLOBALS['TL_DCA']['tl_page']['palettes'] as $strKey => &$strPalette) if($strKey != '__selector__') {
	$strPalette = preg_replace('@(\{meta_legend\}[^;]*;)@', '$1{bbit_og_legend},bbit_og;', $strPalette);
	$arrOGPalettes[$strKey . 'bbit_og_page'] =
	$arrOGPalettes[$strKey . 'bbit_og_tree'] = preg_replace('@\}\,bbit_og@', '$0' . $strOGPalette, $strPalette);
}
$GLOBALS['TL_DCA']['tl_page']['palettes'] = array_merge(
	$GLOBALS['TL_DCA']['tl_page']['palettes'],
	$arrOGPalettes
);
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['bbit_og_type_custom'] = 'bbit_og_typeCustom';



$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'options'		=> array('bbit_og_page', 'bbit_og_tree', 'bbit_og_parent', 'bbit_og_root', 'bbit_og_disablePage', 'bbit_og_disableTree'),
	'reference'		=> &$GLOBALS['TL_LANG']['tl_page']['bbit_ogOptions'],
	'eval'			=> array(
		'chosen'		=> true,
		'submitOnChange'=> true,
		'includeBlankOption'=> true,
		'blankOptionLabel'=> &$GLOBALS['TL_LANG']['tl_page']['bbit_ogOptions'][''],
		'tl_class'		=> '',
	),
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_type'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_og']['type'],
	'exclude'		=> true,
	'inputType'		=> 'select',
	'default'		=> 'website',
	'options'		=> ContaoOpenGraphDCA::getInstance()->getTypeOptions(),
	'reference'		=> &$GLOBALS['TL_LANG']['bbit_og']['types'],
	'eval'			=> array(
		'mandatory'		=> true,
		'chosen'		=> true,
		'submitOnChange'=> true,
		'tl_class'		=> 'w50'
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_typeCustom'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['bbit_og']['typeCustom'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'mandatory'		=> true,
		'maxlength'		=> 255,
		'decodeEntities'=> true,
		'tl_class'		=> 'w50'
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_title'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og_title'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'maxlength'		=> 255,
		'decodeEntities'=> true,
		'tl_class'		=> 'clr w50'
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_site'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og_site'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'maxlength'		=> 255,
		'decodeEntities'=> true,
		'tl_class'		=> 'w50'
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_url'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og_url'],
	'exclude'		=> true,
	'inputType'		=> 'text',
	'eval'			=> array(
		'maxlength'		=> 1022,
		'decodeEntities'=> true,
		'rgxp'			=> 'url',
		'tl_class'		=> 'clr long'
	)
);
	
$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_image'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og_image'],
	'exclude'		=> true,
	'inputType'		=> 'fileTree',
	'eval'			=> array(
		'mandatory'		=> true,
		'files'			=> true,
		'fieldType'		=> 'radio',
		'extensions'	=> 'gif,jpg,jpeg,png',
		'filesOnly'		=> true,
		'tl_class'		=> 'clr',
	),
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_imageSize'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og_imageSize'],
	'exclude'		=> true,
	'inputType'		=> 'imageSize',
	'options'		=> $GLOBALS['TL_CROP'],
	'reference'		=> &$GLOBALS['TL_LANG']['MSC'],
	'eval'			=> array(
		'rgxp'			=> 'digit',
		'nospace'		=> true,
		'helpwizard'	=> true,
		'tl_class'		=> 'clr w50'
	)
);

$GLOBALS['TL_DCA']['tl_page']['fields']['bbit_og_description'] = array(
	'label'			=> &$GLOBALS['TL_LANG']['tl_page']['bbit_og_description'],
	'exclude'		=> true,
	'inputType'		=> 'textarea',
	'eval'			=> array(
		'style'			=> 'height: 60px;',
		'tl_class'		=> 'clr',
	),
);
