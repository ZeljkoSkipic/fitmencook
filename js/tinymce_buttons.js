(function() {
    tinymce.PluginManager.add( 'highlight', function( editor, url ) {
        // Add Button to Visual Editor Toolbar
        editor.addButton('highlight', {
            title: 'Highlight Text',
            cmd: 'highlight',
            image: url + '/../assets/icons/pen-tool.svg',
        });

        editor.addCommand('highlight', function() {
            var selected_text = editor.selection.getContent({
                'format': 'html'
            });
            if ( selected_text.length === 0 ) {
                alert( 'Please select some text.' );
                return;
            }
            var open_highlight = '<em class="highlight">';
            var close_highlight = '</em>';
            var return_text = '';
            return_text = open_highlight + selected_text + close_highlight;
            editor.execCommand('mceReplaceContent', false, return_text);
            return;
        });

    });
})();
