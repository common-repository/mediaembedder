<div class="wrap">
    <h2>MediaEmbedder Settings</h2>
    <form method="post" action="options.php">
        <p><label for="mediaembedder_width" >Width:</label>
            <input type="text" id="mediaembedder_width"
                   name="mediaembedder_width" value="<?php echo $width ?>" />
            <br />
        </p>

        <p><label for="mediaembedder_height" >Height:</label>
            <input type="text" id="mediaembedder_height"
                   name="mediaembedder_height" value="<?php echo $height ?>" />
            <br />
        </p>

        <p><label for="mediaembedder_title_enabled" >Show Title Above Embedded Media:</label>
            <input type="checkbox" id="mediaembedder_title_enabled"
                   name="mediaembedder_title_enabled" value="1"
                   <?php echo $title_enabled ?>/>

            Only works with sites that support 'og:title' or 'title' meta tag.
        </p>
        <?php settings_fields('mediaembedder_settings'); ?>

        <p class="submit" >
            <input type="submit" class="button-primary" value="Save Changes" />
        </p>
    </form>
</div>