<?php
/**
 * Generic Modal Shell
 * Expects 'id', 'title', 'content' via set_query_var
 */
$id = get_query_var('id');
$title = get_query_var('title');
$content = get_query_var('content');
?>
<div id="<?php echo esc_attr($id); ?>" style="display: none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:9999;">
    <div style="background: white; padding: 30px; border-radius: var(--radius-lg); width: 100%; max-width: 600px; max-height: 90vh; overflow-y: auto; position: relative;">
        <button onclick="document.getElementById('<?php echo esc_js($id); ?>').style.display='none'" style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 1.5rem; cursor: pointer; color: var(--gray-dark);">&times;</button>
        <h3 style="margin-bottom: 20px; padding-right: 30px; border-bottom: 1px solid #eee; padding-bottom: 15px; color: var(--navy);"><?php echo esc_html($title); ?></h3>
        <div class="modal-body" style="color: var(--navy);">
            <?php echo $content; ?>
        </div>
    </div>
</div>
