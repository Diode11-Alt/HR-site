<?php
/**
 * Job Card Template Part
 * Expects set_query_var('pp_job', $job)
 */
$job = get_query_var('pp_job');
if ( ! $job ) return;

$type_labels = array(
    'full-time' => 'Full Time',
    'part-time' => 'Part Time',
    'contract'  => 'Contract'
);
$type_label = isset($type_labels[$job->type]) ? $type_labels[$job->type] : $job->type;
?>

<div style="background: var(--white); padding: 24px; border-radius: var(--radius); border-left: 4px solid transparent; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; gap: 15px; transition: 0.2s;" onmouseover="this.style.borderLeftColor='var(--gold)'" onmouseout="this.style.borderLeftColor='transparent'">
    <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 15px;">
        <div>
            <h3 style="font-size: 1.4rem; color: var(--navy); margin-bottom: 5px;"><?php echo esc_html($job->title); ?></h3>
            <div style="color: var(--gray-dark); font-size: 0.95rem; display: flex; gap: 15px; flex-wrap: wrap;">
                <span>🏢 <?php echo esc_html($job->company); ?></span>
                <span>📍 <?php echo esc_html($job->location); ?></span>
                <?php if($job->salary): ?>
                    <span>💰 <?php echo esc_html($job->salary); ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div style="background: var(--white-dim); padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; color: var(--navy);">
            <?php echo esc_html($type_label); ?>
        </div>
    </div>
    
    <div style="color: var(--gray-dark); font-size: 0.95rem; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
        <?php echo wp_kses_post($job->description); ?>
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px solid #eee; padding-top: 15px; margin-top: auto;">
        <div style="font-size: 0.85rem; color: var(--gray);">
            Deadline: <span style="color: var(--danger); font-weight: 500;"><?php echo date('M d, Y', strtotime($job->deadline)); ?></span>
        </div>
        <button class="btn btn-primary btn-apply" data-id="<?php echo esc_attr($job->id); ?>" data-title="<?php echo esc_attr($job->title); ?>" style="padding: 8px 20px; font-size: 0.9rem;">Apply Now</button>
    </div>
</div>
