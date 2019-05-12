CKEDITOR.dialog.add( 'hkemojiDialog', function( editor ) {
	var config = editor.config, columns = 6, i;
	var dialog;


	var onClick = function( evt ) {
			var target = evt.data.getTarget(),
				targetName = target.getName();

			if ( targetName == 'a' )
				target = target.getChild( 0 );
			else if ( targetName != 'img' )
				return;

			var src = target.getAttribute( 'cke_src' )
			var img = editor.document.createElement( 'img', {
				attributes: {
					src: src,
					'data-cke-saved-src': src,
					width: target.$.width,
					height: target.$.height
				}
			} );

			editor.insertElement( img );
            dialog.hide();

			evt.data.preventDefault();
		};


	var onKeydown = CKEDITOR.tools.addFunction( function( ev, element ) {
		ev = new CKEDITOR.dom.event( ev );
		element = new CKEDITOR.dom.element( element );
		var relative, nodeToMove;

		var keystroke = ev.getKeystroke(),
			rtl = editor.lang.dir == 'rtl';
		switch ( keystroke ) {
			// UP-ARROW
			case 38:
				// relative is TR
				if ( ( relative = element.getParent().getParent().getPrevious() ) ) {
					nodeToMove = relative.getChild( [ element.getParent().getIndex(), 0 ] );
					nodeToMove.focus();
				}
				ev.preventDefault();
				break;
			// DOWN-ARROW
			case 40:
				// relative is TR
				if ( ( relative = element.getParent().getParent().getNext() ) ) {
					nodeToMove = relative.getChild( [ element.getParent().getIndex(), 0 ] );
					if ( nodeToMove )
						nodeToMove.focus();
				}
				ev.preventDefault();
				break;
			// ENTER
			// SPACE
			case 32:
				onClick( { data: ev } );
				ev.preventDefault();
				break;

			// RIGHT-ARROW
			case rtl ? 37 : 39:
				// relative is TD
				if ( ( relative = element.getParent().getNext() ) ) {
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					ev.preventDefault( true );
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getNext() ) ) {
					nodeToMove = relative.getChild( [ 0, 0 ] );
					if ( nodeToMove )
						nodeToMove.focus();
					ev.preventDefault( true );
				}
				break;

			// LEFT-ARROW
			case rtl ? 39 : 37:
				// relative is TD
				if ( ( relative = element.getParent().getPrevious() ) ) {
					nodeToMove = relative.getChild( 0 );
					nodeToMove.focus();
					ev.preventDefault( true );
				}
				// relative is TR
				else if ( ( relative = element.getParent().getParent().getPrevious() ) ) {
					nodeToMove = relative.getLast().getChild( 0 );
					nodeToMove.focus();
					ev.preventDefault( true );
				}
				break;
			default:
				// Do not stop not handled events.
				return;
		}
	} );

	var buildHtml = function(group) {
		var labelId = CKEDITOR.tools.getNextId() + '_smiley_emtions_label';
		var html = [
			'<div style="max-height:300px;overflow-y:scroll;"><style type="text/css">.hkemoji:hover {border:1pt solid;border-color: green;background-color:#e6ffff}</style>' +
			'<span id="' + labelId + '" class="cke_voice_label">Test</span>',
			'<table role="listbox" aria-labelledby="' + labelId + '" style="width:100%;height:100%;border-collapse:separate;" cellspacing="2" cellpadding="2"',
			CKEDITOR.env.ie && CKEDITOR.env.quirks ? ' style="position:absolute;"' : '',
			'><tbody>'
		];

		var list = {};
		var i = 0;

		for (var shortcode in config.hkemoji.emojis[group]) {
			var obj = config.hkemoji.emojis[group][shortcode];
					list[obj] = shortcode;

		}

		for (var shortcode in list) {

			if ( i % columns === 0 )
				html.push( '<tr role="presentation">' );

			if (!list.hasOwnProperty(shortcode)) continue;

			var obj = list[shortcode];
			for (var prop in obj) {
				if(!obj.hasOwnProperty(prop)) continue;
			}
            var urlimage = config.smiley_path+ group+'/'+shortcode;
			html.push(
				'<td class="cke_centered" style="vertical-align: middle;" role="presentation">' +
				'<img class="hkemoji" cke_src="'+ CKEDITOR.tools.htmlEncode(urlimage) + '" src="'+ urlimage + '" href="javascript:void(0)" onkeydown="CKEDITOR.tools.callFunction( ', onKeydown, ', event, this );"/>', '</td>'
			);

			if ( i % columns == columns - 1 )
				html.push( '</tr>' );
			i++;
		}


		if ( i < columns - 1 ) {
			for ( ; i < columns - 1; i++ )
				html.push( '<td></td>' );
			html.push( '</tr>' );
		}

		html.push( '</tbody></table></div>' );
		return html;
	};



	var emojis = function(group) {
		return {
			type: 'html',
			id: 'emojiSelector',
			html: buildHtml(group).join( '' ),
			onLoad: function( event ) {
				dialog = event.sender;
			},
			onClick: onClick,
			style: 'width: 100%; border-collapse: separate;'
		}
	};

	return {
		title: 'HK Emoji',
		minWidth: 550,
		minHeight: 200,
		contents: [
			{
				id: 'tab-onion',
				label: editor.config.hkemoji.tabs.onion,
				elements: [
					emojis('onion')
				]
			}, {
				id: 'tab-red',
				label: editor.config.hkemoji.tabs.red,
				elements: [
					emojis('red')
				]
			}, {
				id: 'tab-milkbottle',
				label: editor.config.hkemoji.tabs.milkbottle,
				elements: [
					emojis('milkbottle')
				]
			}, {
				id: 'tab-facebook',
				label: editor.config.hkemoji.tabs.facebook,
				elements: [
					emojis('facebook')
				]
			}
		],
		onShow: function() {

		}
	};
});
