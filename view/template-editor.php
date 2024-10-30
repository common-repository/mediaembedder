<div class="wrap">
    <h2>Template Editor</h2>
    <div style="float: left; width: 80%">
        <form id="mediaembedder_template_editor_file_form">
            <label for="mediaembedder_template_editor_file_content"
                   ><h3 id="mediaembedder_template_editor_file_content_title"
                 >Placeholder</h3></label>
            <span id="template">
                <textarea cols="50" rows="10"
                          id="mediaembedder_template_editor_file_content"
                          style="width: 100%; height: 35em"></textarea>
            </span>
            <p class="submit" >
                <input id="mediaembedder_template_editor_file_saved_button"
                       type="submit" class="button-primary" value="Save Changes" />
                <span id="mediaembedder_template_editor_file_saved" style="color: green"></span>
            </p>
        </form>
    </div>
    <div style="float: left; width: 19%; margin-left: 0.5em">
        <h3>Files:</h3>
        <div id="mediaembedder_template_editor_file_sidebar"></div>
    </div>
    <div style="clear: both;"></div>
</div>

<script type="text/javascript" >
    var current_file = 'youtube.php';
    
    
    function mediaembedder_get_file_content() {
        var post = {
            action: 'mediaembedder',
            node:'get_editor_file_content',
            current_file:current_file
        };
        
        jQuery.post(ajaxurl, post, function(json) {
            json = jQuery.parseJSON(json);
            jQuery('#mediaembedder_template_editor_file_content_title').text(json.filename);
            jQuery('#mediaembedder_template_editor_file_saved_button').val('Save Changes to ' + json.filename);
            jQuery('#mediaembedder_template_editor_file_content').val(json.data);
        });
    }
    
    function mediaembedder_get_filelist() {
        var post = {
            action: 'mediaembedder',
            node:'get_editor_filelist',
            current_file:current_file
        };
        
        jQuery.post(ajaxurl, post, function(output) {
            jQuery('#mediaembedder_template_editor_file_sidebar').html(output);
        });
    }
    
    mediaembedder_get_file_content();
    mediaembedder_get_filelist();
    
    function mediaembedder_change_file(file) {
        current_file = file;
        mediaembedder_get_file_content();
        mediaembedder_get_filelist();
    }
    
    jQuery(function ($) {
        $('#mediaembedder_template_editor_file_form').submit(function() {
            var data = $('#mediaembedder_template_editor_file_content').val();
            var post = {
                action: 'mediaembedder',
                node:'template_file_submit',
                current_file:current_file,
                data:data
            };
                
            $.post(ajaxurl, post, function(output) {
                $('#mediaembedder_template_editor_file_saved').empty();
                $('#mediaembedder_template_editor_file_saved').show();
                $('#mediaembedder_template_editor_file_saved').text(output);
                $('#mediaembedder_template_editor_file_saved').fadeOut(5000);
            })
            
            return false;
        });
    });
</script>