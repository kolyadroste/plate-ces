<?php
defined('TYPO3') or die();

// Adds the content element to the "Type" dropdown
call_user_func(function($extension = 'plate_ces') {

	$additional_columns = [
		'media2' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.image',
			'config' => [
				'type' => 'file',
				'allowed' => 'common-image-types',
				'appearance' => [
					'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
					'showPossibleLocalizationRecords' => true,
				],
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'overrideChildTca' => [
					'types' => [
						'0' => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
							'showitem' => '
                                --palette--;;audioOverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
                                --palette--;;videoOverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
					],
				],
			],
		],
		'media3' => [
			'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.image',
			'config' => [
				'type' => 'file',
				'allowed' => 'common-image-types',
				'appearance' => [
					'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:images.addFileReference',
					'showPossibleLocalizationRecords' => true,
				],
				// custom configuration for displaying fields in the overlay/reference table
				// to use the imageoverlayPalette instead of the basicoverlayPalette
				'overrideChildTca' => [
					'types' => [
						'0' => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
							'showitem' => '
                                --palette--;;audioOverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
							'showitem' => '
                                --palette--;;videoOverlayPalette,
                                --palette--;;filePalette',
						],
						\TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
							'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
						],
					],
				],
			],
		],
	];


	\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additional_columns);
});