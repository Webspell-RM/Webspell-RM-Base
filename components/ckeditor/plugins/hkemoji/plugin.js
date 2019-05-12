/*
*    This plugin is edit from "emojione" plugin, and design for custom emoji needs.
*    Special thanks to:  braune-digital;
*    If you have any issue with this plugin, please contact me at: empty@null.net
*/
CKEDITOR.plugins.add( 'hkemoji', {
	icons: 'hkemoji',
	requires: 'dialog',
	init: function(editor) {
		var pluginDirectory = this.path;
        editor.config.smiley_path =  this.path + 'sticker/';
		editor.addCommand( 'hkemoji', new CKEDITOR.dialogCommand( 'hkemojiDialog' ) );
		editor.ui.addButton( 'HKemoji', {
			label: 'Insert emoji',
			command: 'hkemoji',
			toolbar: 'insert'
		});
		CKEDITOR.dialog.add( 'hkemojiDialog', this.path + 'dialogs/hkemoji.js' );
	}
});

// if you wanna change [tabs ID] and [tab names] , please change at file "dialogs/hkemoji.js", and folder name in "sticker/[?]"
CKEDITOR.config.hkemoji = {
	tabs: {
		onion: 'Onion',
		red: 'Red FCrab',
		milkbottle: 'Milk Bottle',
		facebook: 'Facebook'
        	},
	emojis: {
		onion: [
            'Onion--1.gif','Onion--10.gif','Onion--100.gif','Onion--101.gif','Onion--102.gif','Onion--103.gif','Onion--104.gif','Onion--105.gif','Onion--106.gif','Onion--107.gif','Onion--108.gif','Onion--109.gif','Onion--11.gif','Onion--110.gif','Onion--111.gif','Onion--112.gif','Onion--12.gif','Onion--13.gif','Onion--14.gif','Onion--15.gif','Onion--16.gif','Onion--17.gif','Onion--18.gif','Onion--19.gif','Onion--2.gif','Onion--20.gif','Onion--21.gif','Onion--22.gif','Onion--23.gif','Onion--24.gif','Onion--25.gif','Onion--26.gif','Onion--27.gif','Onion--28.gif','Onion--29.gif','Onion--3.gif','Onion--30.gif','Onion--31.gif','Onion--32.gif','Onion--33.gif','Onion--34.gif','Onion--35.gif','Onion--36.gif','Onion--37.gif','Onion--38.gif','Onion--39.gif','Onion--4.gif','Onion--40.gif','Onion--41.gif','Onion--42.gif','Onion--43.gif','Onion--44.gif','Onion--45.gif','Onion--46.gif','Onion--47.gif','Onion--48.gif','Onion--49.gif','Onion--5.gif','Onion--50.gif','Onion--51.gif','Onion--52.gif','Onion--53.gif','Onion--54.gif','Onion--55.gif','Onion--56.gif','Onion--57.gif','Onion--58.gif','Onion--59.gif','Onion--6.gif','Onion--60.gif','Onion--61.gif','Onion--62.gif','Onion--63.gif','Onion--64.gif','Onion--65.gif','Onion--66.gif','Onion--67.gif','Onion--68.gif','Onion--69.gif','Onion--7.gif','Onion--70.gif','Onion--71.gif','Onion--72.gif','Onion--73.gif','Onion--74.gif','Onion--75.gif','Onion--76.gif','Onion--77.gif','Onion--78.gif','Onion--79.gif','Onion--8.gif','Onion--80.gif','Onion--81.gif','Onion--82.gif','Onion--83.gif','Onion--84.gif','Onion--85.gif','Onion--86.gif','Onion--87.gif','Onion--88.gif','Onion--89.gif','Onion--9.gif','Onion--90.gif','Onion--91.gif','Onion--92.gif','Onion--93.gif','Onion--94.gif','Onion--95.gif','Onion--96.gif','Onion--97.gif','Onion--98.gif','Onion--99.gif'],
		red: [
            'Animaux-Crabe-1.gif','Animaux-Crabe-10.gif','Animaux-Crabe-11.gif','Animaux-Crabe-12.gif','Animaux-Crabe-2.gif','Animaux-Crabe-3.gif','Animaux-Crabe-4.gif','Animaux-Crabe-5.gif','Animaux-Crabe-6.gif','Animaux-Crabe-7.gif','Animaux-Crabe-8.gif','Animaux-Crabe-9.gif','Animaux-Renard 2-1.gif','Animaux-Renard 2-2.gif','Animaux-Renard 2-3.gif','Animaux-Renard 2-4.gif','Animaux-Renard 2-5.gif','Animaux-Renard 2-6.gif','Animaux-Renard 2-7.gif','Animaux-Renard 2-8.gif','Animaux-Renard 2-9.gif'],
		milkbottle: [
            'Milk%20Bottle--1.gif','Milk%20Bottle--10.gif','Milk%20Bottle--11.gif','Milk%20Bottle--12.gif','Milk%20Bottle--13.gif','Milk%20Bottle--14.gif','Milk%20Bottle--15.gif','Milk%20Bottle--16.gif','Milk%20Bottle--17.gif','Milk%20Bottle--18.gif','Milk%20Bottle--19.gif','Milk%20Bottle--2.gif','Milk%20Bottle--20.gif','Milk%20Bottle--21.gif','Milk%20Bottle--22.gif','Milk%20Bottle--23.gif','Milk%20Bottle--24.gif','Milk%20Bottle--25.gif','Milk%20Bottle--26.gif','Milk%20Bottle--27.gif','Milk%20Bottle--28.gif','Milk%20Bottle--29.gif','Milk%20Bottle--3.gif','Milk%20Bottle--30.gif','Milk%20Bottle--31.gif','Milk%20Bottle--32.gif','Milk%20Bottle--33.gif','Milk%20Bottle--34.gif','Milk%20Bottle--35.gif','Milk%20Bottle--36.gif','Milk%20Bottle--37.gif','Milk%20Bottle--38.gif','Milk%20Bottle--39.gif','Milk%20Bottle--4.gif','Milk%20Bottle--40.gif','Milk%20Bottle--41.gif','Milk%20Bottle--42.gif','Milk%20Bottle--43.gif','Milk%20Bottle--44.gif','Milk%20Bottle--45.gif','Milk%20Bottle--46.gif','Milk%20Bottle--47.gif','Milk%20Bottle--5.gif','Milk%20Bottle--6.gif','Milk%20Bottle--7.gif','Milk%20Bottle--8.gif','Milk%20Bottle--9.gif'],
		facebook: [
            'angry-face_1f620.png','anguished-face_1f627.png','astonished-face_1f632.png','cat-face-with-tears-of-joy_1f639.png','cat-face-with-wry-smile_1f63c.png','clown-face_1f921.png','confounded-face_1f616.png','confused-face_1f615.png','crying-cat-face_1f63f.png','crying-face_1f622.png','disappointed-but-relieved-face_1f625.png','disappointed-face_1f61e.png','dizzy-face_1f635.png','drooling-face_1f924.png','expressionless-face_1f611.png','face-savouring-delicious-food_1f60b.png','face-screaming-in-fear_1f631.png','face-throwing-a-kiss_1f618.png','face-with-cold-sweat_1f613.png','face-with-cowboy-hat_1f920.png','face-with-finger-covering-closed-lips_1f92b.png','face-with-head-bandage_1f915.png','face-with-look-of-triumph_1f624.png','face-with-medical-mask_1f637.png','face-with-monocle_1f9d0.png','face-with-one-eyebrow-raised_1f928.png','face-with-open-mouth-and-cold-sweat_1f630.png','face-with-open-mouth-vomiting_1f92e.png','face-with-open-mouth_1f62e.png','face-with-rolling-eyes_1f644.png','face-with-stuck-out-tongue-and-tightly-closed-eyes_1f61d.png','face-with-stuck-out-tongue-and-winking-eye_1f61c.png','face-with-stuck-out-tongue_1f61b.png','face-with-tears-of-joy_1f602.png','face-with-thermometer_1f912.png','face-without-mouth_1f636.png','fearful-face_1f628.png','flushed-face_1f633.png','frowning-face-with-open-mouth_1f626.png','ghost_1f47b.png','grimacing-face_1f62c.png','grinning-cat-face-with-smiling-eyes_1f638.png','grinning-face-with-one-large-and-one-small-eye_1f92a.png','grinning-face-with-smiling-eyes_1f601.png','grinning-face-with-star-eyes_1f929.png','grinning-face_1f600.png','hugging-face_1f917.png','hushed-face_1f62f.png','imp_1f47f.png','japanese-goblin_1f47a.png','japanese-ogre_1f479.png','kissing-cat-face-with-closed-eyes_1f63d.png','kissing-face-with-closed-eyes_1f61a.png','kissing-face-with-smiling-eyes_1f619.png','kissing-face_1f617.png','loudly-crying-face_1f62d.png','lying-face_1f925.png','money-mouth-face_1f911.png','nauseated-face_1f922.png','nerd-face_1f913.png','neutral-face_1f610.png','pensive-face_1f614.png','persevering-face_1f623.png','pouting-cat-face_1f63e.png','pouting-face_1f621.png','relieved-face_1f60c.png','rolling-on-the-floor-laughing_1f923.png','serious-face-with-symbols-covering-mouth_1f92c.png','shocked-face-with-exploding-head_1f92f.png','sleeping-face_1f634.png','sleepy-face_1f62a.png','slightly-frowning-face_1f641.png','slightly-smiling-face_1f642.png','smiling-cat-face-with-heart-shaped-eyes_1f63b.png','smiling-cat-face-with-open-mouth_1f63a.png','smiling-face-with-halo_1f607.png','smiling-face-with-heart-shaped-eyes_1f60d.png','smiling-face-with-horns_1f608.png','smiling-face-with-open-mouth-and-cold-sweat_1f605.png','smiling-face-with-open-mouth-and-smiling-eyes_1f604.png','smiling-face-with-open-mouth-and-tightly-closed-eyes_1f606.png','smiling-face-with-open-mouth_1f603.png','smiling-face-with-smiling-eyes-and-hand-covering-mouth_1f92d.png','smiling-face-with-smiling-eyes_1f60a.png','smiling-face-with-sunglasses_1f60e.png','smirking-face_1f60f.png','sneezing-face_1f927.png','thinking-face_1f914.png','tired-face_1f62b.png','unamused-face_1f612.png','upside-down-face_1f643.png','weary-cat-face_1f640.png','weary-face_1f629.png','white-frowning-face_2639.png','white-smiling-face_263a.png','winking-face_1f609.png','worried-face_1f61f.png','zipper-mouth-face_1f910.png']
 	}
};
