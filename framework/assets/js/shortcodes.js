// Salamander Theme Tinymce plugin
jQuery(function($)
{
    /* Register button */
    tinymce.create('tinymce.plugins.SSCButtons',
    {
        init : function(editor, url)
        {
            editor.addButton('ssc_button',
            {
                title: 'Salamander ShortCodes',
                // icon: 'gavickpro-own-icon',
                icon: false,
                text: 'Short Codes',
                onclick: function()
                {
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show('Insert Salamander ShortCodes.', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=shrtcodes-form-wrapper');
                }
            });
        },
    });
    /* Start the buttons */
    tinymce.PluginManager.add('ssc_button', tinymce.plugins.SSCButtons);

    /* get current template */
    var def = getShortCodeTemplate($('#shortcode-type').val());
    /* add ajax calback on shortcodes type change */
    $('#shortcode-type').on('change', function()
    {
        getShortCodeTemplate($(this).val());
    });
    /* parse shortcodes form */
    $('#insert').click(function()
    {
        var data = $("#shortcodes-form").find("select, textarea, input, checkbox").serializeArray();
        var shortcode = getShortcode(data);
        tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
        tb_remove();
        return false;
    });

    function getShortcode(data)
    {
        var string = '[', assoc = {};
        $.each(data, function(k, v) {
            if (typeof(assoc[v.name]) == 'undefined' && assoc[v.name] == null)
            {
                assoc[v.name] = [];
                assoc[v.name].push(v.value);
            }
            else
            {
                assoc[v.name].push(v.value);
            }
        });
        string += assoc['shortcode_type'][0];
        delete assoc['shortcode_type'];
        $.each(assoc, function(k, v) {
            v = v.join(', ');
            string += ' ' + k + '="' + v + '"';
        });
        string += ']';

        return string;
    }

    function getShortCodeTemplate(type)
    {
        $.post(
            //global var viewsDir
            viewsDir + 'admin/shortcodes/' + type + '.php',
            {},
            function(data)
            {
                $('#shortcode-data').replaceWith($(data).find('#shortcode-data'));
            },
            'html'
        );
    }
});
