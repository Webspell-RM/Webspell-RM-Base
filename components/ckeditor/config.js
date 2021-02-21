/**
 * @license Copyright (c) 2003-2020, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.codeSnippet_theme = 'school_book';
	//   config.enterMode = 2; //disabled <p> completely
        config.enterMode = CKEDITOR.ENTER_BR; // pressing the ENTER KEY input <br/>
        config.shiftEnterMode = CKEDITOR.ENTER_P; //pressing the SHIFT + ENTER KEYS input <p>
        config.autoParagraph = false; // stops automatic insertion of <p> on focus
};
